<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h3>Создание практической работы</h3>
					<?php $form = ActiveForm::begin([
					
					'id' => 'form-practice-create',
					'options' => ['class' => 'form-horizontal all-form']]);?>
					<?= $form->field($practice, 'theme', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control'])->label('Тема практической работы');?>
					<?= $form->field($practice, 'target')->textArea(['class' => 'form-control'])->label('Цель практической работы');?>
					<?= $form->field($practice, 'task')->textArea(['class' => 'form-control'])->label('Задание');?>
					<?= $form->field($practice, 'description')->textArea(['class' => 'form-control'])->label('Описание хода выполнения, дополнительная информация');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<div class="form-group pull-right">
					<?= Html::a('Отмена', Url::toRoute(['practice/cancel-create-practice', 'id_discipline'=> $discipline->id]), ['class'=>'btn btn-primary']) ?>

					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
					
        			</div>
        		</div>
	    	</div>
	    </div>
		<?php ActiveForm::end() ?>
	</div>
</body>
</html>