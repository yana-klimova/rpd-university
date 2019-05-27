<?php

namespace frontend\controllers;

use Yii;
use common\models\Literature;
use common\models\Discipline;
use common\models\Site;
use common\models\DisciplineLiteratureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DisciplineLiteratureController implements the CRUD actions for DisciplineLiterature model.
 */
class AdditionLiteratureController extends Controller
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

    public function actionDelete($id_literature, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $addLiterature = Literature::findOne($id_literature);
            $addLiterature->delete();
            $baseLiterature = new Literature();
            $addLiterature = new Literature();
            $site = new Site();
            $session = Yii::$app->session;
            $session['addition-literature-update']=false;
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $addLiterature = new Literature();
            $addLiterature->load(Yii::$app->request->post());
            //debug(Yii::$app->request->post());
            $addLiterature->type = 'addition';
            $addLiterature->save(false);
            $addLiterature->setDiscipline($id_discipline);
            $addLiterature = new Literature();
            $baseLiterature = new Literature();
            $site = new Site();
            $session = Yii::$app->session;
            $session['addition-literature-update']=false;
           return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
        }
    }


    public function actionUpdate($id_literature, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $addLiterature = Literature::findOne($id_literature);
        $baseLiterature = new Literature();
        $site = new Site();
        $session = Yii::$app->session;
        $session['addition-literature-update']=true;

        if(Yii::$app->request->isPjax && $addLiterature->load(Yii::$app->request->post())){
            $addLiterature->save(false);
            $session['addition-literature-update']=false;
            $addLiterature = new Literature();
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        }
        return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
    }
}
