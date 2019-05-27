<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdditionallyClassroom */

$this->title = 'Update Additionally Classroom: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Additionally Classrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="additionally-classroom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
