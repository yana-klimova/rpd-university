<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="news-item">
    <h2><?= Html::encode($model->name) ?></h2>    
    <?= HtmlPurifier::process($model->direction) ?>    
</div>