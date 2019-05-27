<?php

namespace frontend\controllers;

use Yii;

use common\models\Discipline;
use common\models\TeacherFile;
use common\models\File;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * AdditionallyClassroomController implements the CRUD actions for AdditionallyClassroom model.
 */
class MaterialController extends Controller
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

    public function actionDelete($id_teacherFile, $id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        $fileModel = new File();

        if(Yii::$app->request->isPjax){
            //$discipline = Discipline::findOne($id_discipline);
            $teacherFile = TeacherFile::findOne($id_teacherFile);
            $fileModel->deleteCurrentFile($teacherFile->file_name);
            $teacherFile->delete();

             return $this->renderAjax('/site/_material', ['discipline'=>$discipline, 'fileModel'=>$fileModel]);
       } else {
            return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'material']);
       }
    }

    public function actionCreate($id_discipline)
    {
        $discipline = Discipline::findOne($id_discipline);
        $fileModel = new File();
        if(Yii::$app->request->isPjax){
            $file = UploadedFile::getInstance($fileModel, 'file');
            
            $fileUploadedName = $fileModel->uploadedFile($file);
            //Если успешно сохранилось
            if($fileUploadedName){
                $teacherFile = new TeacherFile();
                $teacherFile->discipline_id = $id_discipline;
                $teacherFile->title=$_POST['File']['title'];
                $teacherFile->file_name = $fileUploadedName;

                if($teacherFile->save()){
                     //var_dump($fileModel);
                    return $this->renderAjax('/site/_material', ['discipline'=>$discipline, 'fileModel'=>$fileModel]);
                } else {
                    $fileModel->deleteCurrentFile($fileUploadedName);
                    return $this->renderAjax('/site/_material', ['discipline'=>$discipline, 'fileModel'=>$fileModel]);
                    
                }
            } else {
                return $this->renderAjax('/site/_material', ['discipline'=>$discipline, 'fileModel'=>$fileModel]);
            }
        }
        return $this->redirect(['/site/discipline', 'id'=>$discipline->id, '#'=>'material']);
    }

}
