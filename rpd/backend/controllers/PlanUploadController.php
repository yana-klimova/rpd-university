<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Discipline;
use common\models\Know;
use common\models\Own;
use common\models\Can;
use common\models\CompetencyDiscipline;
use common\db\Connection;
use common\models\AssessmentTool;


class PlanUploadController extends Controller
{

    public function actionIndex()
    {
        $years[14] = Discipline::find()->select('year')->where(['year'=>14])->limit(1)->one();
        $years[16]= Discipline::find()->select('year')->where(['year'=>16])->limit(1)->one();
        krsort($years);
        return $this->render('index', compact('years'));
    }

    public function actionUpload($year){
        
        $connection = new Connection();
        $educationPlan = $connection->uploadEdicationPlan($year);
        //Yii::$app->cache->flush();
        // $degree = $connection->uploadDegree();
        // echo "<pre>";
        // print_r($degree);
        // echo "</pre>";
        foreach ($educationPlan as $plan => $disc) {
            $discipline = new Discipline();
            $discipline->uploadDiscipline($disc);
            $discipline->setAssessment();
            $competensions = $connection->uploadCompetency($discipline->id_discipline, $discipline->id_plan);
            $emploee = $connection->uploadEmploee($discipline->id_discipline, $discipline->id_plan);
            foreach ($emploee as $emp => $value) {
                $title = $connection->uploadTitle($value['EMPL_ACADEMIC_TITLE_ID']);
                $degree = $connection->uploadDegree($value['EMPL_ACADEMIC_DEGREE_ID']);

                $discipline->setEmploee($value, $title, $degree);
            }
            foreach ($competensions as $comp => $value) {
                $compDisc = new CompetencyDiscipline();
                $compDisc->uploadCompetency($value, $discipline->id);
                $know = new Know();
                $know->saveCompetencyKnow($compDisc);
                $own = new Own();
                $own->saveCompetencyOwn($compDisc);
                $can = new Can();
                $can->saveCompetencyCan($compDisc);
            }
        }
        $session = Yii::$app->session;
        $session->close();
        Yii::$app->session->setFlash('success', "Учебный план загружен!");
        return $this->redirect(['index']);
    }

    public function actionDelete($year){

        Discipline::deleteAll('year=:year', [':year'=>$year]);
        Yii::$app->session->setFlash('success', "Учебный план удален");
        return $this->redirect(['index']);

    }


}



