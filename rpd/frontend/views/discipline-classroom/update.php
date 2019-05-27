<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DisciplineClassroom */

$this->title = 'Update Discipline Classroom: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Discipline Classrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discipline-classroom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
