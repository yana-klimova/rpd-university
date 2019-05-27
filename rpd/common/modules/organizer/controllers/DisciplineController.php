<?php

namespace common\modules\organizer\controllers;

use Yii;
use common\models\Discipline;
use common\models\Comment;
use common\models\Tab;
use common\models\CommentSearch;
use common\models\DisciplineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\generate\GenerateDocument;
/**
 * DisciplineController implements the CRUD actions for Discipline model.
 */
class DisciplineController extends Controller
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


    public function actionIndex() 
    {
        $this->layout = 'organizer';
        
        $session = Yii::$app->session;
       
        $searchModel = new DisciplineSearch();

        $provider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', compact('provider', 'searchModel'));
    }

    
    public function actionDownload($id, $status, $doc=null, $pdf=null){
        $id_discipline = $id;
        $discipline = Discipline::findOne($id);
        $document = new GenerateDocument();
        $path = $discipline->createDir($status);
        $doc_file = $path.'/'.$discipline->doc_file;
        $pdf_file = $path.'/'.$discipline->pdf_file;
        $discipline->view_org = true;
        $discipline->save(false);
        if (!file_exists($doc_file)) {
            $doc_file = $document->generateDocx($id_discipline, $status);
        } 

        if($doc){
            Yii::$app->response->sendFile($doc_file);
            Yii::$app->response->send();

        } elseif ($pdf) {
            if (!file_exists($pdf_file)) {
                $pdf_file = $document->generatePdf($id_discipline, $doc_file, $status);
            } 
            Yii::$app->response->sendFile($pdf_file);
            Yii::$app->response->send();
            
        }
        return $this->redirect(['view', 'id'=>$id]);
    }

    public function actionUpload($id, $status, $doc=null, $pdf=null){
        $discipline = Discipline::findOne($id);
        $document = new GenerateDocument();
        $path = $discipline->createDir($status);
        $doc_file = $path.'/'.$discipline->doc_file;
        $pdf_file = $path.'/'.$discipline->pdf_file;

        if($doc && !file_exists($doc_file)){
            $doc_file = $document->generateDocx($id, $status);
            Yii::$app->session->setFlash('success', "Документ загружен");
        } elseif($doc && file_exists($doc_file))
        {
            Yii::$app->session->setFlash('success', "Документ уже находится в хранилище");
        }
        if($pdf && !file_exists($pdf_file)){
            if(!file_exists($doc_file)){
                $doc_file = $document->generateDocx($id, $status);
                $pdf_file = $document->generatePdf($id, $doc_file, $status);
                Yii::$app->session->setFlash('success', "Документ загружен");
            } else{
                $pdf_file = $document->generatePdf($id, $doc_file, $status);
                Yii::$app->session->setFlash('success', "Документ загружен");
            }
        } elseif($pdf && file_exists($pdf_file)){
            Yii::$app->session->setFlash('success', "Документ уже находится в хранилище");
        }

        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $discipline = Discipline::findOne($id);
        $document = new GenerateDocument();
        $path = $discipline->createDir($discipline->status);
        $doc_file = $path.'/'.$discipline->doc_file;
        $pdf_file = $path.'/'.$discipline->pdf_file;
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

        $commentModel = new Comment();

        $tabs = ArrayHelper::map(Tab::find()->orderBy('tab_name')->all(), 'id', 'tab_name');
        if($discipline->status==2||$discipline->status==3){
            
            if(!file_exists($doc_file)){

                $doc_file = $document->generateDocx($id, $discipline->status);
            }
            if(!file_exists($pdf_file)){
                $pdf_file = $document->generatePdf($id, $doc_file, $discipline->status);
            }
        }
        return $this->render('view', compact('discipline', 'commentSearchModel', 'commentDataProvider', 'commentModel', 'tabs'));
    }

    public function actionChangeStatus($id, $currentStatus, $targetStatus){
        $discipline = Discipline::findOne($id);
        $document = new GenerateDocument();
        $discipline->view_org = false;
        $discipline->status = $targetStatus;
        $discipline->save(false);
        $path = $discipline->createDir($currentStatus);
        $doc_file = $path.'/'.$discipline->doc_file;
        $pdf_file = $path.'/'.$discipline->pdf_file;
        if(($currentStatus==2 && $targetStatus==1) || ($currentStatus==3 && $targetStatus==1)){
            if(file_exists($doc_file)){
                unlink($doc_file);
            }
            if(file_exists($pdf_file)){
                unlink($pdf_file);
            }
            Yii::$app->session->setFlash('success', "РПД отправлена на разработку");
            return $this->redirect(['view', 'id'=>$discipline->id]);
        }
        if($currentStatus==2 && $targetStatus==3){
            $targetPath = $discipline->createDir($targetStatus);
            $target_file_doc_name = $targetPath.'/'.$discipline->doc_file;
            $target_file_pdf_name = $targetPath.'/'.$discipline->pdf_file;
            if(!file_exists($doc_file)){
                $doc_file = $document->generateDocx($id, $discipline->status);
            }
            if(!file_exists($pdf_file)){
                $pdf_file = $document->generatePdf($id, $doc_file, $discipline->status);
            }
            rename($doc_file, $target_file_doc_name);
            rename($pdf_file, $target_file_pdf_name);
            Yii::$app->session->setFlash('success', "РПД утверждена");
        }

        return $this->redirect(['view', 'id'=>$discipline->id]);
    }

   
}
