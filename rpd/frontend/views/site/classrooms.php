<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin([
    'action' => Url::toRoute(['classroom/update', 'id_discipline' => $discipline->id]),
    'options' => [
        'data-pjax' => '1'
    ],
    'id' => 'classroom-update-form all-form'
]); ?>

    <?php foreach ($discipline->classrooms as $key => $classroom): ?>
            <?= $form->field($classroom, "[$key]room") ?>
    <?php endforeach ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>