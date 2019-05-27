<?php

namespace common\models;
use yii\base\Model;
use Yii;

class TemplateFile extends Model {
	public $file;

	public function rules()
    {
        return [

            ['file', 'required', 'message'=>'Загрузите файл'],
        ];
    }
//application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword
	public function uploadedFile($file){
	
			$fileName = $file->baseName.'.'.$file->extension;
			if($file->saveAs(Yii::getAlias('@template').'/'.$fileName)){
			//var_dump(self::PATH.$fileName);
				return $fileName;
			} else {
				return false;
			}
		} 

	public function deleteCurrentFile($file_name){
		$file = Yii::getAlias('@template').'/'.$file_name;
		if (file_exists($file)) {
			return unlink($file);
		} else {
			return false;
		}
	}



	public function downloadFile($file_name){
		
	        $file = Yii::getAlias('@template').'/'.$file_name;
	 
	       if (file_exists($file)) {

				Yii::$app->response->sendFile($file);
	           	return true;
	       } else{

	       		return false;
	       }
	}


}