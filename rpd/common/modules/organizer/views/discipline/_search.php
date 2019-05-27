<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DisciplineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discipline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'semester') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'direction') ?>

    <?php // echo $form->field($model, 'profile') ?>

    <?php // echo $form->field($model, 'qualification') ?>

    <?php // echo $form->field($model, 'form_study') ?>

    <?php // echo $form->field($model, 'short_department') ?>

    <?php // echo $form->field($model, 'lecture') ?>

    <?php // echo $form->field($model, 'practice') ?>

    <?php // echo $form->field($model, 'lab') ?>

    <?php // echo $form->field($model, 'selfwork') ?>

    <?php // echo $form->field($model, 'control_t') ?>

    <?php // echo $form->field($model, 'control') ?>

    <?php // echo $form->field($model, 'fulltime_contact') ?>

    <?php // echo $form->field($model, 'fulltime') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'course') ?>

    <?php // echo $form->field($model, 'code_direction') ?>

    <?php // echo $form->field($model, 'code_discipline') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'teacher') ?>

    <?php // echo $form->field($model, 'current_year') ?>

    <?php // echo $form->field($model, 'lectureRemain') ?>

    <?php // echo $form->field($model, 'practiceRemain') ?>

    <?php // echo $form->field($model, 'labRemain') ?>

    <?php // echo $form->field($model, 'selfworkRemain') ?>

    <?php // echo $form->field($model, 'developers') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
