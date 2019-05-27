<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DisciplineSoftware */

$this->title = 'Update Discipline Software: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Discipline Softwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discipline-software-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
