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
 * CurrentCertificationController implements the CRUD actions for CurrentCertification model.
 */
class CurrentCertificationController extends Controller
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

   public function actionCreateCurrentCertification($id_discipline) {
        $currentCertification = new CurrentCertification();
        $session = Yii::$app->session;
        $discipline = Discipline::findOne($id_discipline);

        if(Yii::$app->request->isAjax && $currentCertification->load(Yii::$app->request->post())){
            $currentCertification->id_discipline = $discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($currentCertification); 
            
        }
        if($currentCertification->load(Yii::$app->request->post())) {
            if($currentCertification->save()) {
                $currentCertification->setDiscipline($discipline->id);
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
            } else {
                return $this->render('createCurrentCertification', compact('discipline', 'currentCertification'));
            }
        }
        return $this->render('createCurrentCertification', compact('discipline', 'currentCertification'));
    }

    public function actionUpdateCurrentCertification($id_certification, $id_discipline) {
        $session = Yii::$app->session;
        $discipline = Discipline::findOne($id_discipline);
        $currentCertification = CurrentCertification::findOne($id_certification);
        if(Yii::$app->request->isAjax && $currentCertification->load(Yii::$app->request->post())){
            $currentCertification->id_discipline = $discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($currentCertification); 
            
        }
        if($currentCertification->load(Yii::$app->request->post())) {
            if($currentCertification->save()) {
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
            } else {
                return $this->render('createCurrentCertification', compact('discipline','currentCertification'));
            }
        }
        return $this->render('createCurrentCertification', compact('discipline','currentCertification'));
    }

    public function actionDeleteCurrentCertification($id_certification, $id_discipline) {
        $session = Yii::$app->session;
        $discipline = Discipline::findOne($id_discipline);
        $currentCertification = CurrentCertification::findOne($id_certification);
        $currentCertification->delete();
        return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
    }

        public function actionCancelCreateCertification($id_discipline) {
         return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'certification']);
    }
}
