<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Discipline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discipline-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semester')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'form_study')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lecture')->textInput() ?>

    <?= $form->field($model, 'practice')->textInput() ?>

    <?= $form->field($model, 'lab')->textInput() ?>

    <?= $form->field($model, 'selfwork')->textInput() ?>

    <?= $form->field($model, 'control_t')->textInput() ?>

    <?= $form->field($model, 'control')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fulltime_contact')->textInput() ?>

    <?= $form->field($model, 'fulltime')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput() ?>

    <?= $form->field($model, 'course')->textInput() ?>

    <?= $form->field($model, 'code_direction')->textInput() ?>

    <?= $form->field($model, 'code_discipline')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'current_year')->textInput() ?>

    <?= $form->field($model, 'lectureRemain')->textInput() ?>

    <?= $form->field($model, 'practiceRemain')->textInput() ?>

    <?= $form->field($model, 'labRemain')->textInput() ?>

    <?= $form->field($model, 'selfworkRemain')->textInput() ?>

    <?= $form->field($model, 'developers')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
