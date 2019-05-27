<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Template;
use common\models\TemplateFile;
use yii\web\UploadedFile;
class LayoutUploadController extends Controller
{

    public function actionIndex()
    {

    	$template = Template::find()->one();
        $file = Yii::getAlias('@template').'/'.$template->name;
            if (!file_exists($file)){
                $template->delete();
            }
        
        return $this->render('index', [
            'template' => $template]);
    }

    public function actionUpload(){
    	$pastTemplate = Template::find()->one();
    	$template = new Template();

        $fileModel = new TemplateFile(); 
        if(yii::$app->request->isPost) {
            //Получаем объект файла,
            $file = UploadedFile::getInstance($fileModel, 'file');
            //var_dump($file);

            //Передаем объект файла на сохранение на сервер с сгенерированным именем и возвращаем новое имя
            $fileUploadedName = $fileModel->uploadedFile($file);
            //Если успешно сохранилось
            if($fileUploadedName){

                $template->name = $fileUploadedName;
                if($template->save()){
                	if($pastTemplate){
                		
                		$fileModel->deleteCurrentFile($pastTemplate->name);
                		$pastTemplate->delete();
                	}
                	
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('upload', [
            'template' => $template, 'fileModel'=>$fileModel]);
    }

    public function actionDownload($id){
        $template = Template::findOne($id);
        $fileModel = new TemplateFile();

        if($fileModel->downloadFile($template->name)){
            Yii::$app->response->send();

        } else {
            $template->delete();
            Yii::$app->session->setFlash('error', "Файл не найден на сервере, вся информация о нем будет удалена из системы");
            return $this->redirect(['index']);
        }
    }


}



