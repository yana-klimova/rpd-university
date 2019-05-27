<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-8">

 
    <?php 
    $action = Url::toRoute(['comment/create', 'id_discipline'=>$discipline->id]);
    $form = ActiveForm::begin([
        'action' => $action,
        'options' => [
        'data-pjax' => '1',

    ],
    'id' => 'comment-create-form',
    'class'=>'form-inline form-all'
    ]); ?>
    <div class="row form-group">
        <div class="col-md-4">
            <?= Html::activeLabel($commentModel, 'id_tab')?>
            <?= Html::activeDropDownList($commentModel, 'id_tab', $tabs, ['class'=>'form-control']) ?>
        </div>
        
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <?php echo $form->field($commentModel, 'comment')->textArea()->label('Сообщение');?>
        </div>
    </div>

    <div class="row form-group pull-right">
        <div class="col-md-12">
            <div class="pull-right">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

