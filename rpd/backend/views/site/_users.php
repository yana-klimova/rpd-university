<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\User;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="row" id='user-list'>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $userDataProvider,
        'filterModel' => $userSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            [
                'attribute' => 'username',
                'label'=>'ФИО',
                'filter'=>ArrayHelper::map(User::find()->all(), 'username', 'username')
            ],
            [
                'attribute' => 'email',
                'label'=>'Email',
                'filter'=>ArrayHelper::map(User::find()->all(), 'email', 'email')
            ],

            'password:text:Пароль',

            [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия', 
            'headerOptions' => ['width' => '80'],
            'template' => '{delete}',
            'controller'=>'user'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
