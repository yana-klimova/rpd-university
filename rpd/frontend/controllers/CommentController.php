<?php

namespace frontend\controllers;

use Yii;
use common\models\Comment;
use common\models\Discipline;
use common\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
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


    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_discipline)
    {
        $commentModel = new Comment();
        $tabs = Comment::getTabsList();
        $discipline = Discipline::findOne($id_discipline);
        $commentSearchModel = new CommentSearch();
        $query = Comment::find()->where(['id_discipline' => $discipline->id]);

        $commentDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],
        ]);


        if(Yii::$app->request->isPjax){

            $commentModel->load(Yii::$app->request->post());
            $commentModel->id_user = Yii::$app->user->id;
            $commentModel->id_discipline = $id_discipline;
            if($commentModel->save()) {
                $commentModel = new Comment();
                return $this->renderAjax('/site/_comment', compact('commentSearchModel', 'commentDataProvider', 'discipline', 'tabs', 'commentModel')); 
            } else {
                return $this->renderAjax('/site/_comment', compact('commentSearchModel', 'commentDataProvider', 'discipline', 'tabs', 'commentModel'));
            }
        } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'comment']);
        }
    }

    public function actionUpdate($id_comment, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        $commentModel = Comment::findOne($id_comment);
        
        $tabs = Comment::getTabsList();

        if($commentModel->load(Yii::$app->request->post()) && $commentModel->save()){
           return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'comment']);
        } else {
            return $this->render('/comment/update', compact('commentModel', 'tabs', 'discipline'));
    }
}

public function actionView($id_comment){
    $comment = Comment::findOne($id_comment);
    return $this->render('view', compact('comment'));
}

    public function actionDelete($id_comment, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        $commentModel = Comment::findOne($id_comment);
        $commentSearchModel = new CommentSearch();
        $query = Comment::find()->where(['id_discipline' => $discipline->id]);

        $commentDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],
        ]);
        //$commentDataProvider = $commentSearchModel->search(Yii::$app->request->queryParams);
        $commentModel->delete();
        $tabs = Comment::getTabsList();
        if(Yii::$app->request->isPjax){
            $commentModel=new Comment();
            return $this->renderAjax('/site/_comment', compact('commentSearchModel', 'commentDataProvider', 'discipline', 'tabs', 'commentModel'));
        }
        
        return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'comment']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
