<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use common\models\Discipline;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$this->params['breadcrumbs'][] = '20'.yii::$app->session['currentYear']." - 20".(yii::$app->session['currentYear']+1);
$this->params['breadcrumbs'][] = $qualification;
$this->params['breadcrumbs'][] = $direction;
$this->params['breadcrumbs'][] = $currentCourse;
?>
<?php Pjax::begin(['timeout' => 10000, 'enablePushState' => false, 'id'=>'pj-disciplines']); ?>

	<div class="col-md-3">
		<div class="list-group">
			
			<?=frontend\components\CourseWidget::widget(['direction' => $direction, 'qualification' => $qualification, 'course'=>$currentCourse])?>
	  	</div>


		<div class="panel panel-default">
			<div class="panel-heading">
				
				Учебные года.  Текущий: 20<?php echo yii::$app->session['currentYear']." - 20".(yii::$app->session['currentYear']+1);?>
			</div> 
		    <div class="panel-body">

		    	<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline', 'id'=>'form-year', 'data-pjax' => 1]]); ?>
			    	<?= Html::dropDownList('currentYear', $selectedYear, $allYears, ['class'=>'form-group form-control'])?>
			      	<div class="form-group ">
			        	<?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']) ?>
			      	</div>
		      	<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-9 disciplines" id='<?="$currentCourse"?>'>
		<div class="row">
			<div class="col-md-12">

        	<?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
<?php

foreach ($providers as $semester => $provider) {
	echo '<h4>'.$semester.' семестр</h4>';
	 echo GridView::widget([
	        'dataProvider' => $provider,
	        'filterModel' => $searchModel,
	        'layout'=>"{items}",
	        'tableOptions' => ['class' => 'table disciplines-view'],
	         'columns' => [

	         	[
                    'attribute'=>'code_discipline',
                    'options' => ['width' => '80'],
                    'filter'=>ArrayHelper::map(Discipline::getIndex($selectedYear, $qualification, $direction, $currentCourse, $semester), 'code_discipline', 'code_discipline')
                ],

	                [
	                'attribute' => 'status',
	                'format' => 'raw',
	                'options' => ['width' => '50'],
	                'value'=>function($data){
	                    switch ($data->status) {
	                    case 1:
	                      return '<span class="glyphicon glyphicon-edit" style="color: #e01010; font-size: 20px"></span>';
	                      break;
	                    case 2:
	                      return '<span class="glyphicon glyphicon-share" style="color: #f7a62d; font-size: 20px"></span>';
	                      break;
	                    case 3:
	                      return '<span class="glyphicon glyphicon-check" style="color: #18c721; font-size: 20px"></span>';
	                      break;
	                  }
	                },
	                
	                'label'=>'Состояние',
	                'filter'=>[1=>'Разработка', 2=>'Проверка', 3=>'Проверено']
	                ],
	                [
	                    'attribute'=>'name',
	                    'format'=>'raw',
	                    'contentOptions'=>['style'=>'white-space: normal;'],
	                    'options' => ['width' => '400'],
	                    'value'=>function($data){
	                    	if(yii::$app->session['qualification']=='Бакалавриат'){
									$specialization = 'Профиль: ';
							} elseif (yii::$app->session['qualification']=='Магистратура') {
									$specialization = 'Программа: ';
							} elseif (yii::$app->session['qualification']=='Специалитет'){
									$specialization = 'Специализация: ';
							} else { 
								$specialization = 'Профиль: ';
							}
	                    	$name = $data->name.'<br>'.$specialization.$data->profile;
		                    $url = Url::toRoute(['site/discipline', 'id'=>$data->id]);
		                    return Html::a($name, $url);
		                },

	                    'filter'=>ArrayHelper::map(Discipline::getDisciplines($selectedYear, $qualification, $direction, $currentCourse, $semester), 'name', 'name')
	                    
	                    
	                ],

	            [
                    'attribute'=>'lecture',
                    'options' => ['width' => '50'],
                    'filter'=>false,
                    'label'=>'ЛК'

                ],
	            [
                    'attribute'=>'practice',
                    'options' => ['width' => '50'],
                    'filter'=>false,
                    'label'=>'ПР'

                ],                
	            [
                    'attribute'=>'lab',
                    'options' => ['width' => '50'],
                    'filter'=>false,
                    'label'=>'ЛР'

                ],
	            [
                    'attribute'=>'selfwork',
                    'options' => ['width' => '50'],
                    'filter'=>false,
                    'label'=>'СР'

                ],

               [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Действия', 
                    'headerOptions' => ['width' => '40'],
                    'template' => '{leadDownload}',
                    'buttons' => [
                    	'leadDownload' => function ($url, $model) {
                            $docUrl = Url::to(['site/download', 'id_discipline' => $model->id, 'status'=>$model->status, 'doc'=>true]);
                            $pdfUrl = Url::to(['site/download', 'id_discipline' => $model->id, 'status'=>$model->status, 'pdf'=>true]);

                            return 
                                "<span class='glyphicon glyphicon-cloud-download active' tabindex='0' style='font-size: 30px;'
                                    data-toggle = 'popover'
                                    data-trigger='focus'
                                    data-placement='bottom'
                                    data-title='Скачать'
                                    data-content = '
                                        <a href=".$docUrl." data-pjax=0>.docx</a></br>

                                        <a href=".$pdfUrl." data-pjax=0>.pdf</a>'>
                                </span>";
                        
	                    }
	                ],
	            ],
	        ]
	        ]);
        } ?>		    
		</div>
	</div>
</div>

<?php Pjax::end(); ?>
</body>
</html>
