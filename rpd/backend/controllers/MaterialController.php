<?php

namespace backend\controllers;

use Yii;
use common\models\Material;
use common\models\File;
use common\models\MaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends Controller
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
     * Lists all Material models.
     * @return mixed
     */
    public function actionIndex()
    {
        $materials = Material::find()->all();
        foreach ($materials as $material) {
            $file = Yii::getAlias('@uploads').'/'.$material->material;
            if (!file_exists($file)){
                $material->delete();
            } 
        }
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Material();
        $fileModel = new File();

        if(yii::$app->request->isPost) {
            //Получаем объект файла,
            $file = UploadedFile::getInstance($fileModel, 'file');
            //var_dump($file);
            //Передаем объект файла на сохранение на сервер с сгенерированным именем и возвращаем новое имя
            $fileUploadedName = $fileModel->uploadedFile($file);
            //Если успешно сохранилось
            if($fileUploadedName){

                $model->load(Yii::$app->request->post());
                $model->title = $_POST['File']['title'];
                $model->material = $fileUploadedName;
                if($model->save()){
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('create', [
            'model' => $model, 'fileModel'=>$fileModel]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Информация о материале успешно изменена");

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionFileDownload($id){
        $model = Material::findOne($id);
        $fileModel = new File();

        if($fileModel->downloadFile($model->material)){
            Yii::$app->response->send();

        } else {
            $model->delete();
            Yii::$app->session->setFlash('error', "Файл не найден на сервере, вся информация о нем будет удалена из системы");
            return $this->redirect(['index']);
        }
    }

    public function actionUpdateFile($id){
        $model = $this->findModel($id);

        $fileModel = new File();

        if(yii::$app->request->isPost) {
            //Получаем объект файла,
            $file = UploadedFile::getInstance($fileModel, 'file');
            //var_dump($file);
            //Передаем объект файла на сохранение на сервер с сгенерированным именем и возвращаем новое имя
            $fileUploadedName = $fileModel->uploadedFile($file);
            //Если успешно сохранилось
            if($fileUploadedName){
                if($fileModel->deleteCurrentFile($model->material)){
                    $model->material = $fileUploadedName;
                } else{
                    $model->material = $fileUploadedName;
                }
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Файл успешно изменен");

                    return $this->redirect(['index']);
                } 
            } else {
                Yii::$app->session->setFlash('error', "Файл не изменен");

            }
        }

        return $this->render('update-file', [
            'fileModel' => $fileModel,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Material::findOne($id);
        
        $fileModel = new File();
        $fileModel->deleteCurrentFile($model->material);
        $model->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Material::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
