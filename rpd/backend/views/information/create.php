<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Information */

$this->title = 'Добавление информации';
$this->params['breadcrumbs'][] = ['label' => 'Информация', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
