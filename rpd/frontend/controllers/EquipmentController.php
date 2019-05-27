<?php

namespace frontend\controllers;

use Yii;
use common\models\Classroom;
use common\models\Software;
use common\models\Discipline;
use common\models\Equipment;
use common\models\ClassroomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdditionallyClassroomController implements the CRUD actions for AdditionallyClassroom model.
 */
class EquipmentController extends Controller
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

    public function actionDelete($id_equipment, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $equipment = Equipment::findOne($id_equipment);
            $equipment->delete();
            $equipment = new Equipment();
            $classroom = new Classroom();
            $software = new Software();
            $session = Yii::$app->session;
            $session['equipment-update']=false;
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $equipment = new Equipment();
            $equipment->load(Yii::$app->request->post());
            $equipment->save(false);
            $equipment->setDiscipline($id_discipline);
            $equipment = new Equipment();
            $software = new Software();
            $classroom = new Classroom();
            $session = Yii::$app->session;
            $session['equipment-update']=false;
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
        }

    }


    public function actionUpdate($id_equipment, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $equipment = Equipment::findOne($id_equipment);
        $software = new Software();
        $classroom = new Classroom();
        $session = Yii::$app->session;
        $session['equipment-update']=true;
        if(Yii::$app->request->isPjax && $equipment->load(Yii::$app->request->post())){
            $equipment->save(false);
            $session['equipment-update']=false;
            $equipment = new Equipment();
            
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
        }
        return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline,'software'=>$software, 'equipment'=>$equipment]);
    }


}
