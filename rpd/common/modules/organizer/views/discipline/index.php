<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Discipline;
use yii\widgets\Breadcrumbs;
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<?php $this->beginBlock('direct'); ?>
<h3 class="direct-name"><?=$direction?></h3>
<?php $this->endBlock();?>
<?php Pjax::begin(['timeout' => 10000, 'enablePushState' => false, 'id'=>'pj-disciplines']); ?>

 <div class="col-md-12">
    <?= GridView::widget([
        'dataProvider' => $provider,
        'filterModel' => $searchModel,
         'columns' => [

                [
                'attribute' => 'status',
                'format' => 'raw',
                'options' => ['width' => '50'],
                'value'=>function($data){
                    switch ($data->status) {
                    case 1:
                      return '<span class="glyphicon glyphicon-edit" style="color: #e01010"></span>';
                      break;
                    case 2:
                      return '<span class="glyphicon glyphicon-share" style="color: #f7a62d"></span>';
                      break;
                    case 3:
                      return '<span class="glyphicon glyphicon-check" style="color: #18c721"></span>';
                      break;
                  }
                },
                
                'label'=>'Состояние',
                'filter'=>[1=>'Разработка', 2=>'Проверка', 3=>'Проверено']
                ],
                [
                    'attribute'=>'name',
                    'contentOptions'=>['style'=>'white-space: normal;'],
                    'options' => ['width' => '400'],

                    'filter'=>Discipline::getDistinctName()
                ],

                [
                'attribute' => 'semester',
                'options' => ['width' => '50'],               
                'label'=>'Семестр',

                ],

                [
                'attribute' => 'direction',             
                'label'=>'Направление',
                'filter'=>Discipline::getDistinctDirection()
                ],
                [
                'attribute' => 'qualification',             
                'options' => ['width' => '100'],
                'filter'=>Discipline::getDistinctQualification()
                ],

                [
                'attribute' => 'year',             
                'options' => ['width' => '100'],
                'format'=>'raw',
                'value'=>'current_year',
                'filter'=>Discipline::getYears()
                ],

               [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Действия', 
                    'headerOptions' => ['width' => '80'],
                    'template' => '{leadView} {leadUpload} {leadDownload}',
                    // 'urlCreator'=>function($action, $model, $key, $index){
                    //      return Url::to(['auth-assignment'.$action,'item_name'=>$model->item_name]);
                    //  },
                    'buttons' => [
                        'leadView' => function ($url, $model) {
                            $url = Url::to(['discipline/view', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-eye-open" style="font-size: 20px;"></span>', $url, [
                                'title'        => 'Посмотреть',
                                'data-method'  => 'post',
                                'data-pjax'=>0
                            ]);
                        },

                        'leadUpload' => function ($url, $model) {
                            $docUrl = Url::to(['discipline/upload', 'id' => $model->id, 'status'=>$model->status, 'doc'=>true]);
                            $pdfUrl = Url::to(['discipline/upload', 'id' => $model->id, 'status'=>$model->status, 'pdf'=>true]);

                            if($model->status == 2 || $model->status == 3){
                                return 
                                    "<span class='glyphicon glyphicon-cloud-upload active' tabindex='0' style='font-size: 20px;'
                                        data-toggle = 'popover'
                                        data-trigger='focus'
                                        data-placement='bottom'
                                        data-title='Загрузить'
                                        data-content = '
                                            <a href=".$docUrl." data-pjax=0>.docx</a></br>

                                            <a href=".$pdfUrl." data-pjax=0>.pdf</a>'>
                                    </span>";
                                }
                            else {
                                return Html::a('<span class="glyphicon glyphicon-cloud-upload disabled" style="font-size: 20px; color: #19c910"></span>', $url, ['title' => 'Загрузить в хранилище', 'data-method'  => 'post', 'data-pjax'=>0, 'class'=>'disabled-download']);
                            }
                        },

                        'leadDownload' => function ($url, $model) {
                            $docUrl = Url::to(['discipline/download', 'id' => $model->id, 'status'=>$model->status, 'doc'=>true]);
                            $pdfUrl = Url::to(['discipline/download', 'id' => $model->id, 'status'=>$model->status, 'pdf'=>true]);

                            if($model->status==3 || $model->status==2){
                                return 
                                    "<span class='glyphicon glyphicon-cloud-download active' tabindex='0' style='font-size: 20px;'
                                        data-toggle = 'popover'
                                        data-trigger='focus'
                                        data-placement='bottom'
                                        data-title='Скачать'
                                        data-content = '
                                            <a href=".$docUrl." data-pjax=0>.docx</a>

                                            <a href=".$pdfUrl." data-pjax=0>.pdf</a>'>
                                    </span>";
                            } else {
                                return Html::a('<span class="glyphicon glyphicon-cloud-download disabled" style="font-size: 20px; color: #19c910"></span>', $url, ['title' => 'Скачать себе', 'data-method'  => 'post', 'data-pjax'=>0, 'class'=>'disabled-download']);
                            }
                        },
                    ]
                    
                ],
            ],
        ]); 
    ?>    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({html:true});
    });
</script>
<?php Pjax::end(); ?>
</body>
</html>
