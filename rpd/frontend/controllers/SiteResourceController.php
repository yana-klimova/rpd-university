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
class SiteResourceController extends Controller
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

    public function actionDelete($id_site, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $site = Site::findOne($id_site);
            $site->delete();
            $site = new Site();
            $baseLiterature = new Literature();
            $addLiterature = new Literature();
            $session = Yii::$app->session;
            $session['site-update']=false;
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        if(Yii::$app->request->isPjax){
            
            $site = new Site();
            $site->load(Yii::$app->request->post());
            //debug(Yii::$app->request->post());
            $site->save(false);
            $site->setDiscipline($id_discipline);
            $addLiterature = new Literature();
            $baseLiterature = new Literature();
            $site = new Site();
            $session = Yii::$app->session;
            $session['site-update']=false;
           return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'info-source']);
        }
    }


    public function actionUpdate($id_site, $id_discipline) {
        $discipline = Discipline::findOne($id_discipline);
        $site = Site::findOne($id_site);
        $baseLiterature = new Literature();
        $addLiterature = new Literature();
        $session = Yii::$app->session;
        $session['site-update']=true;

        if(Yii::$app->request->isPjax && $site->load(Yii::$app->request->post())){
            $site->save(false);
            $session['site-update']=false;
            $site = new Site();
            return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
        }
        return $this->renderAjax('/site/_info-source', ['discipline'=>$discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$addLiterature, 'site'=>$site]);
    }
}
