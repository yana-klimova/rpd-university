<?php

namespace backend\controllers;

use Yii;
use common\models\Information;
use common\models\File;
use common\models\InformationFile;
use common\models\InformationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InformationController implements the CRUD actions for Information model.
 */
class InformationController extends Controller
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
     * Lists all Information models.
     * @return mixed
     */
    public function actionIndex()
    {
        $informations = Information::find()->all();
        foreach ($informations as $information) {
            foreach ($information->informationFiles as $informationFile) {
                $file = Yii::getAlias('@uploads').'/'.$informationFile->file_name;
                    if (!file_exists($file)){
                    $informationFile->delete();
                } 
            }
            
        }
        $searchModel = new InformationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Information model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Information model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Information();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionViewFiles($id){
        $information = Information::findOne($id);
        $files = $information->informationFiles;
        return $this->render('view-files', compact('files', 'information'));
    }

    public function actionFileDownload($id){
        $file = InformationFile::findOne($id);
        $fileModel = new File();
        $information = $file->information;
        if($fileModel->downloadFile($file->file_name)){
            Yii::$app->response->send();

        } else {
            $file->delete();
            Yii::$app->session->setFlash('error', "Файл не найден на сервере, вся информация о нем будет удалена из системы");
            return $this->redirect(['view-files', 'id'=>$information->id]);
        }
    }

    public function actionFileDelete($id){
        $file = InformationFile::findOne($id);
        $fileModel = new File();
        $information=$file->information;
        if($fileModel->deleteCurrentFile($file->file_name)){
            $file->delete();
            Yii::$app->session->setFlash('success', "Файл успешно удален");
        } else {
            $file->delete();
            Yii::$app->session->setFlash('success', "Файл успешно удален");
        }

        return $this->redirect(['view-files', 'id'=>$information->id]);
    }

    public function actionFileUpload($id){
        $information = Information::findOne($id);
        $fileModel = new File();
        if(yii::$app->request->isPost) {

            //Получаем объект файла,
            $file = UploadedFile::getInstance($fileModel, 'file');
            //var_dump($file);
            //Передаем объект файла на сохранение на сервер с сгенерированным именем и возвращаем новое имя
            $fileUploadedName = $fileModel->uploadedFile($file);
            //Если успешно сохранилось
            if($fileUploadedName){
                //Создаем запись в бд
                $informationFile = new InformationFile();
                //Записываем id информации
                $informationFile->setInformation($id);
                //Записываем имя файла и титул
                if($informationFile->setFile($fileUploadedName) && $informationFile->setFileTitle($_POST['File']['title'])){
                    //Если все сохранилось, 
                    Yii::$app->session->setFlash('success', "Файл успешно сохранен");
                    return $this->redirect(['view-files', 'id'=>$information->id]);
                } else {
                    Yii::$app->session->setFlash('error', "Файл не сохранен");
                }

            } else{
                Yii::$app->session->setFlash('error', "Файл не сохранен");
            }
        }
        return $this->render('file-upload', compact('fileModel', 'information'));
    }
    /**
     * Updates an existing Information model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Information model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $information = $this->findModel($id);
        $files = $information->informationFiles;
        $fileModel = new File();
        $information->delete();
        foreach ($files as $file) {
            $fileModel->deleteCurrentFile($file->file_name);
        }
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Information::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
