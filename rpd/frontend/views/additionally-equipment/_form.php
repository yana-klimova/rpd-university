<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdditionallyEquipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="additionally-equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_discipline')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
