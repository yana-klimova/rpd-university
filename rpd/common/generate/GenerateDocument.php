<?php
namespace common\generate;


use Yii;
use common\models\Discipline;
use common\models\Template;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use NcJoes\OfficeConverter\OfficeConverter;

class GenerateDocument{

	public function generateDocx($id_discipline, $status){
		$discipline = Discipline::findOne($id_discipline);
		$template = Template::find()->one();
		if($template->name){
			$document= new \PhpOffice\PhpWord\TemplateProcessor(Yii::getAlias('@template').'/'.$template->name);
			$document->setValue('discipline', $discipline->name);
	        $fileName = $discipline->doc_file;
	        if($status==1){
	        	$path = Yii::getAlias('@temp');
	        } else{
	        	$path = $discipline->createDir($status);
	        }
	        
	        $file = $path.'/'.$fileName;
	        $document->saveAs($file);
	        return $file;
		} 
	}


	public function generatePdf($id_discipline, $doc_file, $status){
		$discipline = Discipline::findOne($id_discipline);
		$fileName = $discipline->pdf_file;
		if($status==1){
        	$path = Yii::getAlias('@temp');
        } else{
        	$path = $discipline->createDir($status);
        }
        $file = $path.'/'.$fileName;

		$converter = new OfficeConverter($doc_file, $path, 'soffice');

        $converter->convertTo($fileName);
        
        return $file;
	} 
		      
}
