<?php
namespace frontend\controllers;

use Yii;

use yii\helpers\Html;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\generate\GenerateDocument;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\Discipline;
use common\models\DisciplineSearch;
use common\models\Can;
use common\models\File;
use common\models\TeacherFile;
use common\models\InformationFile;
use common\models\Know;
use common\models\Own;
use common\models\Section;
use common\models\Site;
use common\models\CommentSearch;
use common\models\Comment;
use common\models\Tab;
use common\models\Login;
use common\models\Equipment;
use common\models\Literature;
use common\models\LabWork;
use common\models\Practice;
use common\models\Program;
use common\models\Information;
use common\models\Material;
use common\models\Notification;
use common\models\TypeControl;
use common\models\FormControl;
use common\models\Classroom;
use common\models\TaskIntermediateCertification;
use common\models\CurrentCertification;
use common\models\CompetencyDiscipline;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public $lastDiscipline;

    /**
     * {@inheritdoc}

     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [

                    [
                        'allow' => true,
                        'roles'=>['?'],
                    ],

                    [
                        'allow' => true,
                        'roles'=>['@'],
                    ],

                    // [
                    //     'actions' => ['index', 'disciplines', 'discipline'],
                    //     'allow' => true,
                    //     'roles' => ['?'],
                    // ],
                    
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                 
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        $this->layout = 'main';
        $session = Yii::$app->session;
        if($session['last_discipline']){
            $lastDiscipline = Discipline::findOne($session['last_discipline']);
        }
        
        $this->view->params['name'] = $lastDiscipline->name;
        $this->view->params['direction']=$lastDiscipline->direction;
        $this->view->params['qualification']=$lastDiscipline->qualification;
        $this->view->params['course']=$lastDiscipline->course;
        $this->view->params['semester']=$lastDiscipline->semester;

        $informations = Information::getActiveTeacherInfo();
        $materials = Material::getActiveTeacherMaterials();
        $notifications = Notification::getActiveTeacherNotifications();

        foreach ($materials as $material) {
            $file = Yii::getAlias('@uploads').'/'.$material->material;
            if (!file_exists($file)){
                $material->delete();
            } 
        }

        foreach ($informations as $information) {
            foreach ($information->informationFiles as $informationFile) {
                $file = Yii::getAlias('@uploads').'/'.$informationFile->file_name;
                    if (!file_exists($file)){
                    $informationFile->delete();
                } 
            }
            
        }
        $allYears=ArrayHelper::map(Discipline::find()->orderby('year')->all(), 'year', 'current_year');
        if(isset($session['currentYear'])) {
            $selectedYear = $session['currentYear'];
        } else {
            $maxYear = Yii::$app->db->createCommand('select max(year) from discipline')->queryAll();
            $session['currentYear'] = $maxYear[0]['max'];
            $selectedYear = $session['currentYear'];
        }

        if (Yii::$app->request->isPost){
            $session['currentYear'] = Yii::$app->request->post('currentYear');
            $selectedYear = $session['currentYear'];
        }
        
        return $this->render('index', compact('allYears', 'selectedYear', 'informations', 'materials', 'notifications'));
    }



    public function actionDisciplines($direction, $qualification, $currentCourse) 
    {
        $this->layout = 'teacher';
        $selectedDirection = $direction;
        $session = Yii::$app->session;
        $allYears=ArrayHelper::map(Discipline::find()->orderby('year')->all(), 'year', 'current_year');

        if(isset($session['currentYear'])) {
            $selectedYear = $session['currentYear'];
        } else {
            $maxYear = Yii::$app->db->createCommand('select max(year) from discipline')->queryAll();
            $selectedYear = $maxYear[0]['max'];
            $session['currentYear'] = $selectedYear;
        }

        if(Yii::$app->request->post('currentYear')){
            $session['currentYear'] = Yii::$app->request->post('currentYear');
            $selectedYear = $session['currentYear'];
        }

        $session['currentCourse']=$currentCourse;
        $semestersDist = Discipline::getSemesters($currentCourse, $qualification, $selectedDirection, $selectedYear);

        $searchModel = new DisciplineSearch();

        foreach ($semestersDist as $key) {
            foreach ($key as $semester => $value) {
                $provider = $searchModel->search(Yii::$app->request->queryParams);
                $provider->query->andFilterWhere(['year'=>$selectedYear])->andFilterWhere(['qualification'=>$qualification])
                ->andFilterWhere(['direction'=>$direction])->andFilterWhere(['course'=>$currentCourse])->andFilterWhere(['semester'=>$value]);
                $provider->setSort([
                    'attributes'=>[
                        'name'=>[
                            'asc'=>['name'=>SORT_ASC, 'code_discipline'=>SORT_ASC]
                        ]
                    ]
                ]);
                $providers[$value] = $provider;
            }

        }

        return $this->render('disciplines2', compact('allYears', 'selectedYear', 'currentCourse', 'direction', 'semestersDist', 'qualification', 'searchModel', 'providers'));
    }

    public function actionDiscipline($id) {
        $session = Yii::$app->session;
        $session['last_discipline'] = $id;
        $discipline = Discipline::findOne($id);
        $session['currentDisciplineId'] = $discipline->id;
        $session['qualification']=$discipline->qualification;
        $session['direction']=$discipline->direction;
        $session['profile']=$discipline->profile;
        $session['course']=$discipline->course;
        $session['semester']=$discipline->semester;
        $session['year']=$discipline->year;
        $session['control']=$discipline->control;
        $session['status']=$discipline->status;
        $session['name']=$discipline->name;
        $session['id']=$discipline->id;
        $session['code_discipline']=$discipline->code_discipline;
        $session['code_direction']=$discipline->code_direction;
        
        foreach ($discipline->competencyDisciplines as $i => $comp) {
            $competens[$i] = $comp;
        }
        $session['competens']=$competens;
        $controls = ArrayHelper::map(TypeControl::find()->all(), 'id', 'type');
        $sections = $discipline->getSections()->orderby('number')->all();
        $labs = $discipline->getLabs()->orderby('number')->all();
        $practices = $discipline->getPractices()->orderby('number')->all();
        
        $classroom = new \common\models\Classroom;
        $session['classroom-update']=false;
        $software = new \common\models\Software;
        $session['software-update']=false;
        $baseLiterature = new \common\models\Literature;
        $session['base-literature-update']=false;
        $additionLiterature = new \common\models\Literature;
        $session['addition-literature-update']=false;
        $site = new \common\models\Site;
        $session['site-update']=false;
        $equipment = new \common\models\Equipment;
        $session['equipment-update']=false;
        $fileModel = new File();
        foreach ($discipline->teacherFiles as $teacherFile) {
            $file = Yii::getAlias('@uploads').'/'.$teacherFile->file_name;
            if (!file_exists($file)){
                $teacherFile->delete();
            } 
        }

        $commentSearchModel = new CommentSearch();
        //$query = Comment::find()->where(['id_discipline' => $discipline->id]);

        // $commentDataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ],
        //     'sort' => [
        //         'defaultOrder' => [
        //             'date' => SORT_DESC,
        //         ]
        //     ],
        // ]);
        $commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        $commentModel = new Comment();

        $tabs = ArrayHelper::map(Tab::find()->orderBy('tab_name')->all(), 'id', 'tab_name');

        return $this->render('disciplineInfo', compact('discipline', 'labs', 'competens', 'practices', 'controls', 'sections', 'classroom', 'software', 'baseLiterature', 'additionLiterature', 'site', 'equipment', 'fileModel', 'commentSearchModel', 'commentDataProvider', 'commentModel', 'tabs'));
    }

    public function actionInformationView($id) {
        $this->layout = 'teacher';
        $information = Information::findOne($id);
        return $this->render('information-view', compact('information'));
    }

    public function actionMaterialView($id) {
        $this->layout = 'teacher';
        $material = Material::findOne($id);
        return $this->render('material-view', compact('material'));
    }

    public function actionFileDownload($id_file=null, $id_material=null, $id_teacherFile=null, $id_discipline=null){
        $fileModel = new File();
        if($id_file){
            $model = InformationFile::findOne($id_file);
            $information = $model->information;
            $file_name = $model->file_name;
        } elseif ($id_material) {
            $model = Material::findOne($id_material);
            $file_name = $model->material;
        }else{
            $model = TeacherFile::findOne($id_teacherFile);
            $file_name = $model->file_name;
        }

        if($fileModel->downloadFile($file_name)){
            Yii::$app->response->send();
        } else {
            Yii::$app->session->setFlash('error', "Файл отсутствует на сервере. Вся информация о нем будет удалена из системы");
            $model->delete();
            if($id_file){
                return $this->redirect(['information-view', 'id'=>$information->id]);
            } elseif ($id_material) {
                return $this->redirect(['index']);
            }else {
               return $this->redirect(['/site/discipline', 'id'=>$id_discipline, '#'=>'material']);
            }
            
        }
    }

    public function actionDownload($id_discipline, $status, $doc=null, $pdf=null){
        $document = new GenerateDocument();
        $discipline=Discipline::findOne($id_discipline);
        if($status==1){
            $path = Yii::getAlias('@temp');
        } else{
            $path = $discipline->createDir($status);
        }

        $doc_file = $path.'/'.$discipline->doc_file;
        $pdf_file = $path.'/'.$discipline->pdf_file;

        if(!file_exists($doc_file)){
            $doc_file = $document->generateDocx($id_discipline, $status);
        }
        if(!file_exists($pdf_file)){
            $pdf_file = $document->generatePdf($id_discipline, $doc_file, $status);
        }
        if($doc){
            Yii::$app->response->sendFile($doc_file);
            Yii::$app->response->send();
        } elseif ($pdf) {
            $pdf_file = $document->generatePdf($id_discipline, $doc_file, $status);
            Yii::$app->response->sendFile($pdf_file);
            Yii::$app->response->send();
        }
        if($status==1){
            unlink($doc_file);
            unlink($pdf_file);
        } 
        return $this->redirect(['/site/disciplines2', 'direction'=>Yii::$app->session['direction'], 'qualification'=>Yii::$app->session['qualification'], 'currentCourse'=>Yii::$app->session['currentCourse']]);
    }


    public function actionChangeState($id, $currentStatus, $targetStatus){
        $discipline = Discipline::findOne($id);
        $discipline->status = $targetStatus;
        $discipline->save(false);
        $document = new GenerateDocument();
        $path = $discipline->createDir($currentStatus);
        $file_doc = $path.'/'.$discipline->doc_file;
        $file_pdf = $path.'/'.$discipline->pdf_file;
        if($targetStatus==1){
            if(!$discipline->view_org){
                if (file_exists($file_doc)) {
                    unlink($file_doc);
                }
                if (file_exists($file_pdf)) {
                    unlink($file_pdf);
                }
            }
        }
        if($targetStatus==2){

            $file_doc = $document->generateDocx($id, $targetStatus);
            $file_pdf = $document->generatePdf($id, $file_doc, $targetStatus);
        }
        return $this->redirect(['site/discipline', 'id'=>$id]);
    }


    public function actionLabTimeValidate() {

       Yii::$app->response->format = Response::FORMAT_JSON;
       $session = Yii::$app->session;
       $discipline = $session['discipline'];
        $request = Yii::$app->getRequest();
        $body = $request->getBodyParams();
       
        $time = $body['time'];
        $remain = $body['remain'];
        $value = [$time, $remain];
        
          
        $model = DynamicModel::validateData(compact('time'), [
            ['time', 'integer'],
            ['time', 'compare', 'compareValue' => $remain, 'operator' => '<=', 'type' => 'number', 'message' => 'Число должно быть в пределах допустимого'],
            ['time', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number', 'message' => 'Число должно быть больше 0'],
        ]);

        // $section->id_discipline = $discipline->id;
        // return ActiveForm::validate($section);

        return ['success' => !$model->hasErrors()];

  }

      public function actionAddProgram($id){
        $id=Html::encode($id);
        $discipline = Discipline::findOne($id);

        if(Yii::$app->request->isAjax) 
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //echo Yii::$app->request->post();
            $discipline->program = Yii::$app->request->post('program');
            if($discipline->save(false)){

                return ['success' => true];
            }

            return ['success' => false];
        }

        return $this->renderAjax('site/discipline-info');
    }

  public function actionValidateProgram($id)
    {
        $discipline = Discipline::findOne($id);

        $request = \Yii::$app->getRequest();

        if ($request->isPost && $discipline->program=$request->post('program')) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($discipline);
        }
    }


    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

public function actionLogin() {
        if(!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }
        $this->layout = 'login';
        $login_model = new Login();

        if(Yii::$app->request->post('Login')){
            $login_model->attributes = Yii::$app->request->post('Login');
            if($login_model->validate()){
                Yii::$app->user->login($login_model->getUser(), $login_model->remember() ? 3600*24*30 : 0);

                return $this->redirect(['site/index']);
            }
        }
        return $this->render('login', compact('login_model'));
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            Yii::$app->user->logout();


            return $this->redirect(['site/login']);
        }
    }
}
