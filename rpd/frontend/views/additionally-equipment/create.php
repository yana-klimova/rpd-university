<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdditionallyEquipment */

$this->title = 'Create Additionally Equipment';
$this->params['breadcrumbs'][] = ['label' => 'Additionally Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additionally-equipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
