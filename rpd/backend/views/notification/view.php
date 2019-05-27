<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-view col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Измененить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить объявление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'content:ntext',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],
                'label'=>'Дата создания'
            ],
            [
            'attribute' => 'status',
             'header' => 'Статус',
             'label'=>'Статус',
             'format' => 'raw',
             'filter' => [0=>'Не активно', 1=>'Активно'],
             'value' => function($data){
                return $data->status ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>';
            }

            ],
            [
            'attribute' => 'for_teacher',
             'header' => 'Для преподавателей',
             'format' => 'raw',
             'filter' => [0=>'Нет', 1=>'Да'],
             'value' => function($data){
                return $data->for_teacher ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>';
            }
            ],
            [
            'attribute'=>'for_organizer',
             'header' => 'Для организаторов',
             'format' => 'raw',
             'filter' => [0=>'Нет', 1=>'Да'],
            'value' => function($data){
                return $data->for_organizer ? '<span class="text-success">Да</span>' : '<span class="text-danger">Нет</span>';
                }
            ],
        ],
    ]) ?>

</div>
