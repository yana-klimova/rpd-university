<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Information */

$this->title = 'Изменение информации: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Информация', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="information-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
