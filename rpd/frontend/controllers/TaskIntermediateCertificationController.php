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
 * TaskIntermediateCertificationController implements the CRUD actions for TaskIntermediateCertification model.
 */
class TaskIntermediateCertificationController extends Controller
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

public function actionCancelCreateCertification($id_discipline) {
         return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'certification']);
    }

    public function actionCreateExamCertification($id_discipline) {
        $examCertification = new TaskIntermediateCertification();

        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isAjax && $examCertification->load(Yii::$app->request->post())){
            $examCertification->id_discipline = $discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($examCertification); 
            
        }
        if($examCertification->load(Yii::$app->request->post())) {
            if($examCertification->save()) {
                $examCertification->setDiscipline($discipline->id);
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
            } else {
                return $this->render('createExamCertification', compact('discipline', 'examCertification'));
            }
        }
        return $this->render('createExamCertification', compact('discipline', 'examCertification'));
    }

    public function actionUpdateExamCertification($id_certification, $id_discipline) {

        $discipline = Discipline::findOne($id_discipline);
        $examCertification = TaskIntermediateCertification::findOne($id_certification);
        if(Yii::$app->request->isAjax && $examCertification->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($examCertification); 
            
        }
        if($examCertification->load(Yii::$app->request->post())) {
            if($examCertification->save()) {
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
            } else {
                return $this->render('createExamCertification', compact('discipline', 'examCertification'));
            }
        }
        return $this->render('createExamCertification', compact('discipline', 'examCertification'));
    }

    public function actionDeleteExamCertification($id_certification, $id_discipline) {

        $discipline = Discipline::findOne($id_discipline);
        $examCertification = TaskIntermediateCertification::findOne($id_certification);
        $examCertification->delete();
        return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'certification']);
    }
}
