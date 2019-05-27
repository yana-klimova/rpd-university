<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form col-md-6">

    <h1>Изменение файла</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($fileModel, 'file')->fileInput()->label('Файл') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
