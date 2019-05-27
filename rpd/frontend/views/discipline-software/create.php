<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DisciplineSoftware */

$this->title = 'Create Discipline Software';
$this->params['breadcrumbs'][] = ['label' => 'Discipline Softwares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discipline-software-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
