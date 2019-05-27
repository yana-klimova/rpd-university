<?php

namespace frontend\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use common\models\Discipline;
use common\models\Can;
use common\models\Know;
use common\models\Own;
use common\models\Section;
use common\models\LabWork;
use common\models\Practice;
use common\models\TypeControl;
use common\models\FormControl;
use common\models\TaskIntermediateCertification;
use common\models\CurrentCertification;
use common\models\CompetencyDiscipline;
use yii\helpers\ArrayHelper;

/**
 * SectionController implements the CRUD actions for Section model.
 */
class SectionController extends Controller
{
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

public function actionCreateSection($id_discipline) {

        $session = Yii::$app->session;
        $discipline = Discipline::findOne($id_discipline);

        $lectureRemainTime = $discipline->getLectureRemain();
        $labRemainTime = $discipline->getLabRemain();
        $practiceRemainTime=$discipline->getPracticeRemain();
        $selfworkRemainTime = $discipline->getSelfworkRemain();

        $section = new Section();
        //Все виды контроля
        $controls = ArrayHelper::map(FormControl::find()->all(), 'id', 'name');
        //Еще ничего не выбрано
        $selectedControls = [];

        if(!$discipline->practice) {
            unset($controls[4]);
        } else {
            $practicesThemeMapId = $discipline->getPracticesThemeMapId();
            $selectedPractices = [];
        }

        if(!$discipline->lab) {
            unset($controls[5]);
        } else {
            $labsThemeMapId = $discipline->getLabsThemeMapId();
            $selectedLabs = [];

        }

        if(Yii::$app->request->isAjax && $section->load(Yii::$app->request->post())){
            $section->id_discipline = $discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;            
            return ActiveForm::validate($section); 
        }

        if($section->load(Yii::$app->request->post())){
            //debug(Yii::$app->request->post());
            $numberSection = $discipline->getCountOfSections()+1;
            $section->setNumber($numberSection);
            if($section->save()) {
                if($section->setDiscipline($discipline->id)){
                    $discipline->updateLectureRemain($section->lection_time, true);
                    $discipline->updateSelfworkRemain($section->selfwork_time, true);
                    $section->saveControls(Yii::$app->request->post('sectionControls'));
                    $timeOfLabs = [];
                    $timeOfPractices = [];
                    if(Yii::$app->request->post('sectionLabs')) {
                    
                        foreach (Yii::$app->request->post('sectionLabs') as $key => $value) {
                            $timeOfLabs[$value] = Yii::$app->request->post("time-l-$value");
                        }
                    $section->saveLabs(Yii::$app->request->post('sectionLabs'), $timeOfLabs);
                    
                    $discipline->updateLabRemain($section->saveLabTime(), true);
                    }

                    if(Yii::$app->request->post('sectionPractices')) {
                    
                        foreach (Yii::$app->request->post('sectionPractices') as $key => $value) {
                            $timeOfPractices[$value] = Yii::$app->request->post("time-p-$value");
                        }
                    $section->savePractices(Yii::$app->request->post('sectionPractices'), $timeOfPractices);
                    
                    $discipline->updatePracticeRemain($section->savePracticeTime(), true);
                    }
                }
                
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'section']);
            } else {
                // return $this->redirect(['discipline', 'id' => $discipline->id]);
                return $this->render('section', compact('section', 'controls', 'discipline', 'selectedControls', 'labsThemeMapId', 'practicesThemeMapId', 'selectedPractices', 'selectedLabs', 'lectureRemainTime', 'practiceRemainTime', 'labRemainTime', 'selfworkRemainTime'));
            }
        }

        return $this->render('section', compact('section', 'controls', 'discipline', 'selectedControls', 'labsThemeMapId', 'practicesThemeMapId', 'selectedPractices', 'selectedLabs', 'lectureRemainTime', 'practiceRemainTime', 'labRemainTime', 'selfworkRemainTime'));

    }

    public function actionUpdateSection($id_discipline, $id_section) {
        $session = Yii::$app->session;
        $discipline = Discipline::findOne($id_discipline);
        $section = Section::findOne($id_section);
        
        $controls = ArrayHelper::map(FormControl::find()->all(), 'id', 'name');
        $selectedControls = $section->getSelectedControls();
        if(!$discipline->practice) {
             unset($controls[4]);
        } else {
            $practicesThemeMapId = $discipline->getPracticesThemeMapId();
            $selectedPractices = $section->getSelectedPracticesId();
        }

        if(!$discipline->lab) {
            unset($controls[5]);
        } else {
            $labsThemeMapId = $discipline->getLabsThemeMapId();
            $selectedLabs = $section->getSelectedLabsId();
        }
        
        if(Yii::$app->request->isAjax && $section->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($section);
        }
        if($section->load(Yii::$app->request->post())){
            if(Yii::$app->request->post('sectionLabs')){
                $discipline->updateLabRemain($section->getLabTime(), false);
            }
            if(Yii::$app->request->post('sectionPractices')){
                $discipline->updatePracticeRemain($section->getPracticeTime(), false);
            }
            if($section->save()) {
                if($section->setDiscipline($discipline->id)){
                    $discipline->updateLectureRemain($section->lection_time, true);
                    $discipline->updateSelfworkRemain($section->selfwork_time, true);
                    $section->saveControls(Yii::$app->request->post('sectionControls'));
                    $timeOfLabs = [];
                    $timeOfPractices = [];
                    if(Yii::$app->request->post('sectionLabs')) {
                    
                        foreach (Yii::$app->request->post('sectionLabs') as $key => $value) {
                            $timeOfLabs[$value] = Yii::$app->request->post("time-l-$value");
                        }
                    $section->saveLabs(Yii::$app->request->post('sectionLabs'), $timeOfLabs);
                    
                    $discipline->updateLabRemain($section->saveLabTime(), true);
                    }

                    if(Yii::$app->request->post('sectionPractices')) {
                    
                        foreach (Yii::$app->request->post('sectionPractices') as $key => $value) {
                            $timeOfPractices[$value] = Yii::$app->request->post("time-p-$value");
                        }
                    $section->savePractices(Yii::$app->request->post('sectionPractices'), $timeOfPractices);
                    
                    $discipline->updatePracticeRemain($section->savePracticeTime(), true);
                    }
                }
                
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'section']);
            } else {
                // return $this->redirect(['discipline', 'id' => $discipline->id]);
                return $this->render('section', compact('section', 'controls', 'discipline', 'selectedControls', 'labsThemeMapId', 'practicesThemeMapId', 'selectedPractices', 'selectedLabs', 'lectureRemainTime', 'practiceRemainTime', 'labRemainTime', 'selfworkRemainTime'));
            }
        }

        $discipline->updateLectureRemain($section->lection_time, false);
        $discipline->updateSelfworkRemain($section->selfwork_time, false);

        $lectureRemainTime = $discipline->getLectureRemain();
        $labRemainTime = $discipline->getLabRemain();
        $practiceRemainTime=$discipline->getPracticeRemain();
        $selfworkRemainTime = $discipline->getSelfworkRemain();

        return $this->render('section', compact('section', 'controls', 'discipline', 'selectedControls', 'labsThemeMapId', 'practicesThemeMapId', 'selectedPractices', 'selectedLabs', 'lectureRemainTime', 'practiceRemainTime', 'labRemainTime', 'selfworkRemainTime'));
    }

    public function actionDeleteSection($id_section, $id_discipline) {

        // if(Yii::$app->request->isPjax){

            $session = Yii::$app->session;
            $discipline = Discipline::findOne($id_discipline);
            $section = Section::findOne($id_section);
            $discipline->updateLectureRemain($section->lection_time, false);
            $discipline->updateSelfworkRemain($section->selfwork_time, false);
            $discipline->updateLabRemain($section->getLabTime(), false);
            $discipline->updatePracticeRemain($section->getPracticeTime(), false);
            $section->delete();

            return $this->redirect(['site/discipline', 'id'=>$discipline->id, '#'=>'section']);
 

    }

    public function actionCancelCreateSection($id_discipline, $id_section=null) {
        if($id_section) {
            $section = Section::findOne($id_section);
            $discipline = Discipline::findOne($id_discipline);
            $discipline->updateLectureRemain($section->lection_time, true);
            $discipline->updateSelfworkRemain($section->selfwork_time, true);
        }
        return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'section']);
    }
}
