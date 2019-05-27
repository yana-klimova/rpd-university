<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\InformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Информация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавление информации', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            // 'content:ntext',
            [
                'attribute'=>'countFiles',
                'label'=>'Файлы',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function($data){
                    $url = Url::toRoute(['information/view-files', 'id'=>$data->id]);
                    return Html::a($data->countFiles.' шт.', $url);
                }
            ],
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],

            ],
            [
            'attribute' => 'status',
             'header' => 'Статус',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
