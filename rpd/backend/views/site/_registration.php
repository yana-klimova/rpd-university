<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="row">
	<div class="col-md-12">

	    <?php if( Yii::$app->session->hasFlash('error') ): ?>
	         <div class="alert alert-danger alert-dismissible" role="alert">
	         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	         <?php echo Yii::$app->session->getFlash('error'); ?>
	         </div>
	         <?php endif;?>
	    <?php if( Yii::$app->session->hasFlash('success') ): ?>
	         <div class="alert alert-success alert-dismissible" role="alert">
	         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	         <?php echo Yii::$app->session->getFlash('success'); ?>
	         </div>
	    <?php endif;?>

		<h3>Регистрация преподавателей</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
			
			<?php $form = ActiveForm::begin([			
			'id' => 'form-registration',
			'action'=>Url::toRoute(['registration/create']),
			'options' => ['class' => 'form-horizontal all-form', 'data-pjax' => '1']]);?>
			<?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus'=>true])->label('ФИО');?>
			<?= $form->field($model, 'email', ['enableAjaxValidation' => true], ['enableClientValidation' => true])->textInput(['class' => 'form-control'])->label('Email');?>
			<?= $form->field($model, 'password')->textInput(['class' => 'form-control'])->label('Пароль');?>
			<?= Html::label('Роль пользователя:', 'role').'<br>' ?>
			<?= Html::activeCheckboxList($model, 'role', $roles) ?>
		
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-md-offset-9">
		<div class="form-group pull-right">
		<?= Html::submitButton('Зарегистрировать', ['class' => 'btn btn-success']) ?>
		
		</div>
	</div>
	<?php ActiveForm::end() ?>
</div>
		
