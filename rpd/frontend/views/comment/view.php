<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Просмотр сообщения</h3>
            <div class="row">
                <div class="col-md-8">
                    <h4>Тема: <?=$comment->tab->tab_name?></h4><br>
                    <h4>Сообщение:</h4>
                    <p><?=$comment->comment?></p>
                    <div class="pull-right">
                        <p>От кого: <?=$comment->user->username?></p>
                        <p><?=$comment->date?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
                <?= Html::a('Назад', Url::toRoute(['site/discipline', 'id'=>$comment->id_discipline, '#'=>'comment']), ['class' => 'btn btn-primary'])?>

</div>