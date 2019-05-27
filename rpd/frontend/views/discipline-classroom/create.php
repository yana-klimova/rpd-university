<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DisciplineClassroom */

$this->title = 'Create Discipline Classroom';
$this->params['breadcrumbs'][] = ['label' => 'Discipline Classrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-classroom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
