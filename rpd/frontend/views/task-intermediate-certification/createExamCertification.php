<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h3>Создание задания промежуточной аттестации</h3>
				<?php $form = ActiveForm::begin([
	    			'id' => 'form-exam-certification',
	    			'options' => ['class' => 'form-horizontal all-form']]);

					echo $form->field($examCertification, 'title', ['enableAjaxValidation' => true, 'enableClientValidation'=>true])->textInput(['class' => 'form-control'])->label('Название');
					echo $form->field($examCertification, 'tasks')->textArea(['class' => 'form-control'])->label('Задания');?>			
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<div class="form-group pull-right">
					<?= Html::a('Отмена', Url::toRoute(['task-intermediate-certification/cancel-create-certification', 'id_discipline'=> $discipline->id]), ['class'=>'btn btn-primary']) ?>
					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	        	</div>

	    	</div>
		</div>
		<?php ActiveForm::end() ?>
			</div>
		</div>
	</div>
</body>
</html>