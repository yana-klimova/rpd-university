<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

use yii\grid\GridView;
?>
<div class="row">

    <?php if( Yii::$app->session->hasFlash('success') ): ?>
         <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo Yii::$app->session->getFlash('success'); ?>
         </div>
    <?php endif;?>
        <?php if( Yii::$app->session->hasFlash('error2') ): ?>
         <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo Yii::$app->session->getFlash('error2'); ?>
         </div>
         <?php endif;?>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Регистрация преподавателей</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
			
			<?php $form = ActiveForm::begin([			
			'id' => 'form-registration',

			'action'=>Url::toRoute(['registration/create']),
			'options' => ['class' => 'form-horizontal all-form']]);?>
			<?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control', 'autofocus'=>true])->label('ФИО');?>
			<?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['class' => 'form-control'])->label('Email');?>
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
<?= GridView::widget([
        'dataProvider' => $userDataProvider,
        'filterModel' => $userSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            [
                'attribute' => 'username',
                'label'=>'ФИО',
                'filter'=>ArrayHelper::map(User::find()->all(), 'username', 'username')
            ],
            [
                'attribute' => 'email',
                'label'=>'Email',
                'filter'=>ArrayHelper::map(User::find()->all(), 'email', 'email')
            ],
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],
                'label'=>'Дата регистрации'
                ],



            [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия', 
            'headerOptions' => ['width' => '80'],
            'template' => '{delete}',
            'controller'=>'user'
            ],
        ],
    ]); ?>
		
