<?php

use yii\helpers\Html;

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\AuthAssignment;

?>
<div class="row">
    <?php if( Yii::$app->session->hasFlash('error') ): ?>
         <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo Yii::$app->session->getFlash('error'); ?>
         </div>
         <?php endif;?>
    <?php if( Yii::$app->session->hasFlash('success') ): ?>
         <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <?php echo Yii::$app->session->getFlash('success'); ?>
         </div>
    <?php endif;?>
</div>

<?php if($update){?>
    <div class="row">
        <?php echo $this->render('/auth-assignment/_form-update', ['authAssignmentModel' => $authAssignmentModel, 'users'=>$users, 'roles'=>$roles]);?>
    </div>
<?php } else {?>
    <div class="row"> 
        <?php echo $this->render('/auth-assignment/_form-create', ['authAssignmentModel' => $authAssignmentModel, 'users'=>$users, 'roles'=>$roles]);?>
    </div>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $authDataProvider,
            'filterModel' => $authSearchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                'attribute' => 'item_name',
                'value' => 'item.description',
                'label'=>'Роль',
                'filter'=>AuthAssignment::getItemsList()
                ],
                [
                'attribute' => 'user_id',
                'value' => 'user.username',
                'label'=>'Пользователь',
                'filter'=>AuthAssignment::getUsersList()
                ],
                [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.Y'],
                'options' => ['width' => '200'],
                'label'=>'Дата создания'
                ],
                //'controller'=>'auth-assignment',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Действия', 
                    'headerOptions' => ['width' => '80'],
                    'template' => '{leadUpdate} {leadDelete}',
                    // 'urlCreator'=>function($action, $model, $key, $index){
                    //      return Url::to(['auth-assignment'.$action,'item_name'=>$model->item_name]);
                    //  },
                    'buttons' => [
                        'leadDelete' => function ($url, $model) {
                            $url = Url::to(['auth-assignment/delete', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                'title'        => 'Удалить',
                                'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить этот элемент?'),
                                'data-method'  => 'post',
                                'data-pjax'=>'1'
                            ]);
                        },

                        'leadUpdate' => function ($url, $model) {
                            $url = Url::to(['auth-assignment/update', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'Редактировать', 'data-method'  => 'post']);
                        },
                    ]
                    
                ],
            ],
        ]); ?>
    </div>
<?php } ?>



