<?php

namespace common\models;
use yii\base\Model;
use Yii;

class File extends Model {
	public $file;
	public $title;



	public function rules()
    {
        return [

            [['title'], 'required', 'message'=>'Необходимо заполнить название'],
            [['file'], 'required', 'message'=>'Необходимо выбрать файл']
        ];
    }

	public function uploadedFile($file){
		$fileName = strtolower(md5(uniqid($file->baseName)).'.'.$file->extension);
		if($file->saveAs(Yii::getAlias('@uploads').'/'.$fileName)){
			//var_dump(self::PATH.$fileName);
			return $fileName;
		}
	}



	public function downloadFile($file_name){

        $file = Yii::getAlias('@uploads').'/'.$file_name;
 
       if (file_exists($file)) {

			Yii::$app->response->sendFile($file);
           	return true;
       } else{

       		return false;
       }

	}

	public function deleteCurrentFile($file_name){
		$file = Yii::getAlias('@uploads').'/'.$file_name;
		if (file_exists($file)) {
			return unlink($file);
		} else {
			return false;
		}
	}


}