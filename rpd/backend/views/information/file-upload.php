<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Information */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Добавление файлов';
$this->params['breadcrumbs'][] = ['label' => 'Информация', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $information->title, 'url' => ['view', 'id'=>$information->id]];
$this->params['breadcrumbs'][] = ['label'=>'Файлы', 'url' => ['information/view-files', 'id'=>$information->id]];
$this->params['breadcrumbs'][] = $this->title = 'Добавление файлов';
?>

<div class="information-form col-md-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($fileModel, 'file')->fileInput()->label('Файл') ?>

    <?= $form->field($fileModel, 'title')->label('Название') ?>

    <div class="form-group pull-right">
    	<?= Html::a('Отмена', Url::toRoute(['information/view', 'id'=>$information->id]), ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
