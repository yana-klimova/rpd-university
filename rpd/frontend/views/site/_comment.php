<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\Comment;
use yii\widgets\Pjax;
?>
<div class="container">

    <h3>Связь с организатором</h3>
<?php //Pjax::begin(['enablePushState' => false, 'id'=>'pj-comment-create', 'timeout'=>600000]); 
    if($discipline->status==1) {?>
        <div class="row"> 
            <?php echo $this->render('/comment/_form-create', compact('commentModel', 'tabs', 'discipline', 'updateComment'));?>
        </div>

<?php }?>


    <?= GridView::widget([
        'dataProvider' => $commentDataProvider,
        'filterModel' => $commentSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_tab',
                //'value' => 'tab.tab_name',
                'value' => function($model) {
                     return $model->tab->tab_name; //здесь по идее можно писать любой код для подготовки вывода данных в колонке
                },
                'label'=>'Тема',
                'options' => ['width' => '400'],
                'filter'=>Comment::getTabsList()
            ],
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],
                'label'=>'Дата создания'
            ],

            [
                'attribute' => 'id_user',
                'value' => function($model) {
                     return $model->user->username; //здесь по идее можно писать любой код для подготовки вывода данных в колонке
                },
                'label'=>'От кого',
                'options' => ['width' => '200'],
                'filter'=>$discipline->getDistinctUser()
            ],
            //'comment:ntext',
            [
            'attribute' => 'status',
             'header' => 'Статус',
             'format' => 'raw',
             'options' => ['width' => '200'],
             'filter' => [0=>'Не прочитано', 1=>'Прочитано'],
             'value' => function($data){
                return $data->status ? '<span class="text-success">Прочитано</span>' : '<span class="text-danger">Не прочитано</span>';
            }

            ],

             [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Действия', 
                    'headerOptions' => ['width' => '80'],
                    'template' => '{leadView} {leadUpdate} {leadDelete}',

                    'buttons' => [
                        'leadDelete' => function ($url, $model) {
                            $url = Url::to(['comment/delete', 'id_comment'=>$model->id, 'id_discipline'=>$model->id_discipline]);
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                'title'        => 'Удалить',
                                'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить этот элемент?'),
                                'data-method'  => 'post',
                                'data-pjax'=>'1'
                            ]);
                        },

                        'leadUpdate' => function ($url, $model) {
                            $url = Url::to(['comment/update', 'id_comment'=>$model->id, 'id_discipline'=>$model->id_discipline]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'Редактировать', 'data-method'  => 'post', 'data-pjax'=>0, 'id'=>'comment-update']);
                        },

                        'leadView' => function($url, $model){
                            $url = Url::to(['comment/view', 'id_comment'=>$model->id]);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => 'Посмотреть', 'data-method'  => 'post', 'data-pjax'=>0, 'id'=>'comment-view']);
                        }
                    ]
                    
                ],
        ],
    ]); ?>
</div>
