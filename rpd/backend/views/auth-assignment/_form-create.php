<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-4 col-md-offset-4 text-center">

    <h3>Добавление роли пользователю</h3>
    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['auth-assignment/create']),
        'options' => [
        'data-pjax' => '1',

    ],
    'id' => 'auth-assignment-form',
    'class'=>'form-inline'
    ]); ?>
    <div class="row form-group">
        <?= Html::activeLabel($authAssignmentModel, 'item_name')?>
        <?= Html::activeDropDownList($authAssignmentModel, 'item_name', $roles, ['class'=>'form-control']) ?>
    </div>
    <div class="row form-group">
        <?= Html::activeLabel($authAssignmentModel, 'user_id')?>
        <?= Html::activeDropDownList($authAssignmentModel, 'user_id', $users, ['class'=>'form-control']) ?>
    </div>

    <div class="row form-group pull-right">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

