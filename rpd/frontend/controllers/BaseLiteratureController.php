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
class BaseLiteratureController extends Controller
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
            
            $baseLiterature = Literature::findOne($id_literature);
            $addLiterature = new Literature();
            $site = new Site();
            $baseLiterature->delete();
            $baseLiterature = new Literature();
            $session = Yii::$app->session;
            $session['base-literature-update']=false;
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
       } else{
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $baseLiterature = new Literature();
            $addLiterature = new Literature();
            $site = new Site();
            $baseLiterature->load(Yii::$app->request->post());
            //debug(Yii::$app->request->post());
            $baseLiterature->type = 'base';
            $baseLiterature->save(false);
            $baseLiterature->setDiscipline($id_discipline);
            $baseLiterature = new Literature();
            $session = Yii::$app->session;
            $session['base-literature-update']=false;
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
        }
    }


    public function actionUpdate($id_literature, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $baseLiterature = Literature::findOne($id_literature);
        $addLiterature = new Literature();
        $site = new Site();
        $session = Yii::$app->session;
        $session['base-literature-update']=true;

        if(Yii::$app->request->isPjax && $baseLiterature->load(Yii::$app->request->post())){
            $baseLiterature->save(false);
            $session['base-literature-update']=false;
            $baseLiterature = new Literature();
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        }
        return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
    }
}
