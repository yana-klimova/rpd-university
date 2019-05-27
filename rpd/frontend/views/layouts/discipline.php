<?php

use frontend\assets\AppAsset;
use common\models\Discipline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;



AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

	<div class="panel panel-default panel-info">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-12">
					<table class="table discipline-table">
						<thead>
							<tr>
								<th>Квалификация</th>
								<th>Направление</th>
								<?php if(yii::$app->session['qualification']=='Бакалавриат'){?>
									<th>Профиль</th>
								<?php } elseif (yii::$app->session['qualification']=='Магистратура') {?>
									<th>Программа</th>
								<?php } elseif (yii::$app->session['qualification']=='Специалитет'){?>
									<th>Специализация</th>
								<?php } else { ?>
								<th>Профиль</th>
								<?php }?>
								<th>Код</th>
								<th>Курс</th>
								<th>Семестр</th>
								<th>Учебный год</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?=yii::$app->session['qualification']?></td>
								<td><?=yii::$app->session['direction']?></td>
								<td><?=yii::$app->session['profile']?></td>
								<td><?=yii::$app->session['code_direction']?></td>
								<td><?=yii::$app->session['course']?></td>
								<td><?=yii::$app->session['semester']?></td>
								<td>20<?=yii::$app->session['year']." - 20".(yii::$app->session['year']+1)?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<h4 class="discipline-h">Дисциплина: <?=yii::$app->session['name']?></h4>
					<br>
					<b>Компетенции: </b>
					<?php

					foreach (yii::$app->session['competens'] as $i => $value) {
						echo $value['code']." ";
					}
					?>
					<br>

					<b>Индекс: </b><?=yii::$app->session['code_discipline']?> <br> 
					<b>Контроль: </b><?=yii::$app->session['control']?><br>
					Дисциплина относится к 
					<?php
						if(mb_substr(yii::$app->session['code_discipline'], 0, 4)=== "Б1.Б") {
							echo " базовой части";
						} elseif (mb_substr(yii::$app->session['code_discipline'], 0, 4)=== "Б1.В") {
							echo " вариативной части";
						} elseif (mb_substr(yii::$app->session['code_discipline'], 0, 4)=== "Б2.У") {
							echo " учебно-практической части";
						} elseif (mb_substr(yii::$app->session['code_discipline'], 0, 4)=== "Б2.Н") {
							echo " научно-исследовательской части";
						} elseif (mb_substr(yii::$app->session['code_discipline'], 0, 4)=== "Б2.П") {
							echo " производственно-практической части";
						}elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Г") {
		                    echo " подготовке и сдаче государственного экзамена";
		                }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Г.1") {
		                    echo " государственному экзамену";
		                }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Д") {
		                    echo " подготовке и защите ВКР";
		                }elseif (mb_substr($discipline->code_discipline, 0, 4)=== "Б3.Д.1") {
		                    echo " выпускной квалификационной работе";
		                }
					?>
				</div>
				<div class="col-md-4">
					<div class="pull-right">
						<h4  class="text-right"><b>Состояние: </b>
						<?php if (yii::$app->session['status']==1) { 
							echo "Разработка</h4><br>";
							echo Html::a('На разработку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>1, 'currentStatus'=>2]), ['class'=>'btn btn-success disabled btn-space']);
							echo Html::a('На проверку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>2, 'currentStatus'=>1]), ['class'=>'btn btn-success active']);
						} elseif (yii::$app->session['status']==2) { 
							echo "Проверка</h4><br>";
							if (Discipline::findOne(yii::$app->session['id'])->view_org){
								$class = 'btn btn-success disabled btn-space';
							} else {
								$class = 'btn btn-success active btn-space';
							}
							echo Html::a('На разработку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>1, 'currentStatus'=>2]), ['class'=>$class]);
							echo Html::a('На проверку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>2, 'currentStatus'=>1]), ['class'=>'btn btn-success disabled']);
							# code...
						} elseif (yii::$app->session['status']==3) {
							echo "Проверено</h4><br>";
							echo Html::a('На разработку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>1, 'currentStatus'=>2]), ['class'=>'btn btn-success disabled btn-space']);
							echo Html::a('На проверку', Url::toRoute(['site/change-state', 'id'=>yii::$app->session['id'], 'targetStatus'=>2, 'currentStatus'=>1]), ['class'=>'btn btn-success disabled']);
						}?>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<?php if(yii::$app->session['status'] == 1){
						$form = ActiveForm::begin([
			    			'id' => 'form-program',
			    			'enableAjaxValidation' => true,
			    			'enableClientValidation'=>true,
			    			'validationUrl' => Url::toRoute(['site/validate-program', 'id'=>yii::$app->session['id']]),
			    			
			    			'options' => ['class' => 'form-horizontal all-form'],
			    			'action' => Url::toRoute(['site/add-program', 'id' => yii::$app->session['id']])]);?>
							<div class="form-group">
								<?php echo Html::label('Программа: ', 'program');
								echo Html::input('text', 'program', Discipline::findOne(yii::$app->session['id'])->program, ['class' => 'form-control', 'id'=>'program-input']);

								?>
								<div id='program-success'>Сохранено</div>
								<div id='program-error'>Введите программу</div>
							</div>
				
					<?php ActiveForm::end(); } else { ?>
						<p><b>Программа: </b><?=Discipline::findOne(yii::$app->session['id'])->program?></p>
					<?php } ?>
					</div>
				<div class="col-md-7">
					<div class="pull-right">
						<span class="glyphicon glyphicon-cloud-download" tabindex="0" style="font-size: 40px;"
							data-toggle = 'popover'
							data-trigger='focus'
							data-placement='bottom'
							data-title='Скачать'
							data-content = '
							<a href="<?=Url::toRoute(['site/download', 'id_discipline'=>yii::$app->session['id'], 'status'=>yii::$app->session['status'], 'doc'=>true])?>" data-method  = "post">.docx</a>

							<a href="<?=Url::toRoute(['site/download', 'id_discipline'=>yii::$app->session['id'], 'status'=>yii::$app->session['status'], 'pdf'=>true])?>" data-method  = "post">.pdf</a>'>
							
						</span>

	                </div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<?php echo Html::a('Назад', Url::toRoute(['site/disciplines', 'direction'=>yii::$app->session['direction'], 'qualification' => yii::$app->session['qualification'], 'currentCourse' => yii::$app->session['course']]), ['class' => 'btn btn-primary']);?>
			</div>
		</div>
	</div>
<div class="panel-body">
    	<?php echo $content ?>
	</div>

</div>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
