<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Материалы</h3></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php if( Yii::$app->session->hasFlash('error') ): ?>
			 <div class="alert alert-error alert-dismissible" role="alert">
			 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <?php echo Yii::$app->session->getFlash('error'); ?>
			 </div>
			<?php endif;?>
			<?php 
				$actionMaterialForm = Url::toRoute(['material/create', 'id_discipline' => $discipline->id]);
				$form = ActiveForm::begin([
				    'action' => $actionMaterialForm,
				    'options' => [
				    
				        'data-pjax' => '1'
				    ],
				    'id' => 'material-create-form'
				]); 
				echo $form->field($fileModel, 'title')->label('Название');
		    	echo $form->field($fileModel, 'file')->fileInput()->label('Файл');?>
		    	<div class='pull-right'>
		    		<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);?>
	    		</div>
				<?php ActiveForm::end(); 
			?>	
		</div>
	</div>	
	<div class="row">
		<div class="col-md-12">
			
			<?php if($discipline->teacherFiles){
				$i=0;
				foreach ($discipline->teacherFiles as $file) { 
					
					$i++?>
					<div class="row">
						<div class="col-md-12">
							<?php echo $i.') '.Html::a($file->title, Url::toRoute(['site/file-download', 'id_teacherFile'=>$file->id, 'id_discipline'=>$discipline->id]), ['title'=>'Скачать', 'data-pjax'=>0]);?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo Html::a('Удалить', Url::toRoute(['material/delete', 'id_teacherFile'=>$file->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить файл?'), 'id'=>'file-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
						</div>
					</div>
				<?php }?>

			<?php }?>
		</div>
	</div>			
</div>