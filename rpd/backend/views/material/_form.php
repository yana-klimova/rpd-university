<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($fileModel, 'title')->label('Название') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($fileModel, 'file')->fileInput()->label('Файл') ?>

    <?= Html::activeCheckbox($model, 'status').'<br>';?>

    <?= Html::label('Предназначение информации:', 'target').'<br>' ?>

    <?= Html::activeCheckbox($model, 'for_teacher').'<br>';?>

    <?= Html::activeCheckbox($model, 'for_organizer').'<br>';?>

    <div class="form-group">
        <div class="pull-right">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
