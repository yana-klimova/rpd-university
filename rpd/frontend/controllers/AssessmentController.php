<?php

namespace frontend\controllers;

use Yii;

use common\models\Discipline;
use common\models\TypeVerificationTask;
use common\models\Handout;
use common\models\FormCurrentControl;
use common\models\FormIntermediateControl;
use common\models\FormReport;
use common\models\DurationControl;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdditionallyClassroomController implements the CRUD actions for AdditionallyClassroom model.
 */
class AssessmentController extends Controller
{
    public $update;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }


    public function actionUpdate($id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $intermediateAssessment= $discipline->intermediateAssessment;

        $currentAssessments = $discipline->currentAssessments;
        foreach ($currentAssessments as $assessment) {
            $selectedDurationControl[$assessment->procedure->id] = $assessment->durationControl->id;
            $selectedControlForm[$assessment->procedure->id] = $assessment->formCurrentControl->id;
            $selectedTypeOfTask[$assessment->procedure->id] = $assessment->typeVerificationTask->id;
            $selectedformOfReport[$assessment->procedure->id] = $assessment->formReport->id;
            $selectedHandout[$assessment->procedure->id] = $assessment->handout->id;
        }
        $durationControls = DurationControl::find()->all();
        $currentControlForms = FormCurrentControl::find()->all();
        $intermediateControlForms = FormIntermediateControl::find()->all();
        $typesOfTask = TypeVerificationTask::find()->all();
        $formsOfReport = FormReport::find()->all();
        $handouts = Handout::find()->all();

        if(Yii::$app->request->isPost){
            foreach ($currentAssessments as $assessment) {
                $assessmentProcedure = $assessment->procedure->id;
                $assessment->id_duration_control = Yii::$app->request->post("duration-$assessmentProcedure");
                $assessment->id_form_current_control = Yii::$app->request->post("form-control-$assessmentProcedure");
                $assessment->id_type_verification_task = Yii::$app->request->post("type-verification-task-$assessmentProcedure");
                $assessment->id_form_report = Yii::$app->request->post("form-report-$assessmentProcedure");
                $assessment->id_handout = Yii::$app->request->post("handout-$assessmentProcedure");
                $assessment->save(false);
            }
            if($intermediateAssessment->load(Yii::$app->request->post()) && $intermediateAssessment->save()){
                return $this->redirect(['site/discipline', 'id'=>$id_discipline, '#'=>'procedure']);
            }

        }

        return $this->render('create-assessment', compact('discipline', 'intermediateAssessment', 'currentAssessments', 'durationControls', 'currentControlForms', 'intermediateControlForms', 'typesOfTask', 'formsOfReport', 'handouts', 'selectedDurationControl', 'selectedControlForm', 'selectedTypeOfTask', 'selectedformOfReport', 'selectedHandout'));
    }

    public function actionCancelUpdate($id_discipline) {
        return $this->redirect(['site/discipline', 'id'=>$id_discipline, '#'=>'procedure']);
    }


}
