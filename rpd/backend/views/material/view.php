<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Material */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="col-md-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Измененить информацию о материале', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Измененить файл', ['update-file', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить материал?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'description:ntext',
            [
                'attribute'=>'material',
                'label'=>'Файл',
                'format'=>'raw',
                'filter'=>false,
                'value'=>function($data){
                    $url = Url::toRoute(['material/file-download', 'id'=>$data->id]);
                    return Html::a('Скачать', $url);
                }
            ],
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],
                'label'=>'Дата создания'
            ],
            [
            'attribute' => 'status',
             'label' => 'Статус',
             
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
