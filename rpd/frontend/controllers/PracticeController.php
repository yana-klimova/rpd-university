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
 * PracticeController implements the CRUD actions for Practice model.
 */
class PracticeController extends Controller
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

    public function actionCreatePractice($id_discipline) {

        $discipline = Discipline::findOne($id_discipline);
        $practice = new Practice();

        if(Yii::$app->request->isAjax && $practice->load(Yii::$app->request->post())){
            $practice->id_discipline=$discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($practice);
        }

        if($practice->load(Yii::$app->request->post())){
            $numberPractice = $discipline->getCountOfPractices()+1;
            $practice->setNumber($numberPractice);
            if($practice->save()) {
                $practice->setDiscipline($discipline->id);
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'section']);
            } else {
                return $this->render('practice', compact('practice', 'discipline'));
            }
        }

        return $this->render('practice', compact('practice', 'discipline'));

    }

    public function actionUpdatePractice($id_discipline, $id_practice) {
        $discipline = Discipline::findOne($id_discipline);

        $practice = Practice::findOne($id_practice);
        
        if(Yii::$app->request->isAjax && $practice->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($practice);
        }
        if($practice->load(Yii::$app->request->post())){

            if($practice->save()) {
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'practice']);
            } else {
                return $this->render('practice', compact('practice', 'discipline'));
            }
        }

        return $this->render('practice', compact('practice', 'discipline'));
    }

    public function actionCancelCreatePractice($id_discipline) {
        return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'section']);
    }

    public function actionDeletePractice($id_discipline, $id_practice) {
       
            $session = Yii::$app->session;
            $discipline = Discipline::findOne($id_discipline);
            $practice = Practice::findOne($id_practice);
            if($practice->getPracticeTime()){
                $discipline->updatePracticeRemain($practice->getPracticeTime(), false);
            }
            $practice->delete();

            return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'section']);
        
    }
}
