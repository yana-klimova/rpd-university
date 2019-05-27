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
					<h3>Создание лабораторной работы</h3>
					<?php $form = ActiveForm::begin([
					
					'id' => 'form-lab-create',
					'options' => ['class' => 'form-horizontal all-form']]);?>
					<?= $form->field($lab, 'theme', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control'])->label('Тема лабораторной работы');?>
					<?= $form->field($lab, 'task')->textArea(['class' => 'form-control'])->label('Задание');?>
					<?= $form->field($lab, 'description')->textArea(['class' => 'form-control'])->label('Описание хода выполнения, дополнительная информация');?>

				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<div class="form-group pull-right">
					<?= Html::a('Отмена', Url::toRoute(['lab-work/cancel-create-lab', 'id_discipline'=> $discipline->id]), ['class'=>'btn btn-primary']) ?>

					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
					
        			</div>
        		</div>
	    	</div>
	    </div>
		<?php ActiveForm::end() ?>
	</div>
</body>
</html>