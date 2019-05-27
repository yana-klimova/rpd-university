<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form col-md-6">

    <h3><?= 'Загрузка шаблона'?></h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($fileModel, 'file')->fileInput()->label('Файл') ?>

    <div class="form-group">
        <?= Html::a('Отмена', Url::toRoute('layout-upload/index'), ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
