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
class ClassroomController extends Controller
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

    public function actionDelete($id_classroom, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            //$discipline = Discipline::findOne($id_discipline);
            $classroom = Classroom::findOne($id_classroom);
            $classroom->delete();
            $classroom = new Classroom();
            $software = new Software();
            $equipment = new Equipment();
            $session = Yii::$app->session;
            $session['classroom-update']=false;
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
        
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $classroom = new Classroom();
            $classroom->load(Yii::$app->request->post());
            $classroom->save(false);
            $classroom->setDiscipline($id_discipline);
            $classroom = new Classroom();
            $software = new Software();
            $equipment = new Equipment();
            $session = Yii::$app->session;
            $session['classroom-update']=false;
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
        }

    }


    public function actionUpdate($id_classroom, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $classroom = Classroom::findOne($id_classroom);
        $software = new Software();
        $equipment = new Equipment();
        $session = Yii::$app->session;
        $session['classroom-update']=true;
        if(Yii::$app->request->isPjax && $classroom->load(Yii::$app->request->post())){
            $classroom->save(false);
            $session['classroom-update']=false;
            $classroom = new Classroom();
            return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline, 'software'=>$software, 'equipment'=>$equipment]);
        }
        return $this->renderAjax('/site/_tech', ['classroom' => $classroom, 'discipline'=>$discipline,'software'=>$software, 'equipment'=>$equipment]);
    }


}
