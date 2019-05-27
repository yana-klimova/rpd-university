<?php

namespace frontend\controllers;

use Yii;
use common\models\Software;
use common\models\Classroom;
use common\models\Discipline;
use common\models\Equipment;
use common\models\DisciplineSoftwareSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplineSoftwareController implements the CRUD actions for DisciplineSoftware model.
 */
class SoftwareController extends Controller
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

                ],
            ],
        ];
    }

    public function actionDelete($id_software, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $software = Software::findOne($id_software);
            $software->delete();
            $software = new Software();
            $classroom = new Classroom();
            $equipment = new Equipment();
            $session = Yii::$app->session;
            $session['software-update']=false;
            return $this->renderAjax('/site/_tech', ['software' => $software, 'discipline'=>$discipline, 'classroom'=>$classroom, 'equipment'=>$equipment]);
        
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $software = new Software();
            $software->load(Yii::$app->request->post());
            $software->save(false);
            $software->setDiscipline($id_discipline);
            $software = new Software();
            $classroom = new Classroom();
            $equipment = new Equipment();
            $session = Yii::$app->session;
            $session['software-update']=false;
            return $this->renderAjax('/site/_tech', ['software' => $software, 'discipline'=>$discipline, 'classroom'=>$classroom, 'equipment'=>$equipment]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'tech']);
        }
    }


    public function actionUpdate($id_software, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $software = Software::findOne($id_software);
        $session = Yii::$app->session;
        $session['software-update']=true;
        $classroom = new Classroom();
        $equipment = new Equipment();
        if(Yii::$app->request->isPjax && $software->load(Yii::$app->request->post())){
            $software->save(false);
            $session['software-update']=false;
            $software = new Software();
            return $this->renderAjax('/site/_tech', ['software' => $software, 'discipline'=>$discipline, 'classroom'=>$classroom, 'equipment'=>$equipment]);
        }
        return $this->renderAjax('/site/_tech', ['software' => $software, 'discipline'=>$discipline, 'classroom'=>$classroom, 'equipment'=>$equipment]);
    }

}
