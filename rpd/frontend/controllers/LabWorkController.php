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
 * LabWorkController implements the CRUD actions for LabWork model.
 */
class LabWorkController extends Controller
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

 public function actionCreateLab($id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $lab = new LabWork();

        if(Yii::$app->request->isAjax && $lab->load(Yii::$app->request->post())){
            $lab->id_discipline=$discipline->id;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($lab);
        }

        if($lab->load(Yii::$app->request->post())){
            $numberLab = $discipline->getCountOfLabs()+1;
            $lab->setNumber($numberLab);
            if($lab->save()) {
                $lab->setDiscipline($discipline->id);
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'section']);
            } else {
                return $this->render('labwork', compact('lab', 'discipline'));
            }
        }

        return $this->render('labwork', compact('lab', 'discipline'));

    }

    public function actionUpdateLab($id_discipline, $id_lab) {
        $discipline = Discipline::findOne($id_discipline);

        $lab = LabWork::findOne($id_lab);
        
        if(Yii::$app->request->isAjax && $lab->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($lab);
        }
        if($lab->load(Yii::$app->request->post())){

            if($lab->save()) {
                return $this->redirect(['site/discipline', 'id' => $discipline->id, '#'=>'section']);
            } else {
                return $this->render('labwork', compact('lab', 'discipline'));
            }
        }

        return $this->render('labwork', compact('lab', 'discipline'));
    }

    public function actionCancelCreateLab($id_discipline) {
        return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'section']);
    }

    public function actionDeleteLab($id_discipline, $id_lab) {
        
            $session = Yii::$app->session;
            $discipline = Discipline::findOne($id_discipline);
            $lab = LabWork::findOne($id_lab);
            if($lab->getLabTime()){
                $discipline->updateLabRemain($lab->getLabTime(), false);
            }
            $lab->delete();           
            return $this->redirect(['site/discipline', 'id' => $id_discipline, '#'=>'section']);

}
}
