<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>

<div class="col-md-3">
<ul class="nav nav-pills nav-stacked" id='myTab'>
  <li class="active"><a data-toggle="pill" href="#users">Пользователи</a></li>
  <li><a data-toggle="pill" href="#signup">Регистрация</a></li>
  <li><a data-toggle="pill" href="#signup">Права</a></li>
</ul>
</div>
<div class="col-md-9">
<div class="tab-content">
  <div id="users" class="tab-pane fade in active">
    <h3>HOME</h3>
    <p>Some content.</p>
  </div>
  
  <div id="signup" class="tab-pane fade">
  	<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-registration', 'timeout'=>600000]); ?>
	<div class="row">
		<div class="col-md-12">
			<h3>Регистрация преподавателей</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
  			
				<?php $form = ActiveForm::begin([			
				'id' => 'form-registration',
				'options' => ['class' => 'form-horizontal all-form', 'data-pjax' => '1', 'id'=>'registration-form']]);?>
				<?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus'=>true])->label('ФИО');?>
				<?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label('Email');?>
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
	</div>
			<?php ActiveForm::end() ?>
			  <?php Pjax::end();?>
  </div>

</div>
</div>