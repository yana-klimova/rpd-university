<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-10">
<?php //var_dump($selectedUser)?>
    <h3>Изменение роли пользователя</h3>
    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['auth-assignment/update', 'id'=>$authAssignmentModel->id]),
        'id' => 'auth-assignment-update-form',
        'class'=>'form-horizontal'
    ]); ?>
    <div class="row">
        <div class="col-md-9 form-group">
            <h4><?=$authAssignmentModel->user->username?></h4>
        </div>

        <div class="col-md-3 form-group">
            <?= Html::activeDropDownList($authAssignmentModel, 'item_name', $roles, ['class'=>'form-control']) ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-offset-9 form-group">
            <?= Html::a('Отмена', Url::toRoute(['auth-assignment/cancel']), ['class' => 'btn btn-danger']) ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

