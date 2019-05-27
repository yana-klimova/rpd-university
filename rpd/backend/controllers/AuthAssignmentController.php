<?php

namespace backend\controllers;

use Yii;
use common\models\AuthAssignment;
use common\models\User;
use common\models\Registration;
use common\models\UserSearch;
use common\models\AuthAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends Controller
{
    public $activePill;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $authAssignmentModel = new AuthAssignment();
        $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $authSearchModel = new AuthAssignmentSearch();
        $authDataProvider = $authSearchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->isPjax){
            $authAssignmentModel->load(Yii::$app->request->post());

            if($authAssignmentModel->validate()){
                $auth = Yii::$app->authManager;
                 //var_dump($_POST['AuthAssignment']['item_name']);
                 $role = $auth->getRole($_POST['AuthAssignment']['item_name']);
                 $user = $_POST['AuthAssignment']['user_id'];
                 $auth->assign($role, $user);

                 Yii::$app->session->setFlash('success', "Роль добавлена пользователю!");
                 $authAssignmentModel = new AuthAssignment();

                return $this->renderAjax('/access-control/_access-right', compact('authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'roles'));
            } else {
                //var_dump($authAssignmentModel->errors);
                $errors = $authAssignmentModel->errors;
                $errorStr = '';
                foreach ($errors as $error=>$value) {
                    foreach ($value as $key => $val) {
                        $errorStr.=$val.'.<br>';
                    }
                    
                }
                Yii::$app->session->setFlash('error', $errorStr);
                return $this->renderAjax('/access-control/_access-right', compact('authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'roles'));
            }  
        } else {
                return $this->redirect(['/access-control/index']);
    }
}


    public function actionUpdate($id)
    {
        $this->layout = 'access-control';
        $model = new Registration();
        $model->generatePassword();
        $userSearchModel = new UserSearch();
        $userDataProvider = $userSearchModel->search(Yii::$app->request->queryParams);

        $authAssignmentModel = $this->findModel($id);

        $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');
        $authSearchModel = new AuthAssignmentSearch();
        $authDataProvider = $authSearchModel->search(Yii::$app->request->queryParams);
        $update = true;
        $this->activePill = 'access-right';

        if ($authAssignmentModel->load(Yii::$app->request->post())){
            if ($authAssignmentModel->save()) {
                $update = false;
                Yii::$app->session->setFlash('success', "Роль пользователя изменена!");
                Yii::$app->session->setFlash('redirect', "access-right");
                return $this->redirect(['/access-control/index']);
            } else {
                Yii::$app->session->setFlash('error', "Для данного пользователя уже существует такая роль");
                return $this->render('/access-control/index', compact('roles', 'model', 'userSearchModel', 'userDataProvider', 'authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'update'));
            }
        }

        return $this->render('/access-control/index', compact('roles', 'model', 'userSearchModel', 'userDataProvider', 'authSearchModel', 'authDataProvider', 'authAssignmentModel', 'users', 'update'));
    }

    public function actionCancel(){

        Yii::$app->session->setFlash('redirect', "access-right");
        return $this->redirect(['/access-control/index']);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

         Yii::$app->session->setFlash('redirect', "access-right");
        return $this->redirect(['/access-control/index']);

    }

    protected function findModel($id)
    {
        if (($model = AuthAssignment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
