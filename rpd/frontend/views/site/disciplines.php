<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;

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
		<?php 
			if(!empty($disciplinesOfSemesters)) {
				foreach ($disciplinesOfSemesters as $sem=>$disciplines):?>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $sem.' Семестр'?></h3>
						</div>
						<div class="panel-body">
							<table class="table table-disc">
								<thead>
				  					<tr>
				    					<th></th>
				    					<th>Индекс</th>
				    					<th>Дисциплина</th>
				    					<th>ЛК</th>
				    					<th>ПР</th>
				    					<th>ЛР</th>
				    					<th>СРС</th>
				    					<th></th>
										</tr>
								</thead>
								<tbody>
									<?php foreach ($disciplines as $discipline):?>
											<tr class="table-disc">
												<td>
													<?php if($discipline['status']==1){?>
													<span class="glyphicon glyphicon-edit" style="color: #e01010"></span>
													<?php } elseif ($discipline['status']==2) {?>
														<span class="glyphicon glyphicon-share" style="color: #f7a62d"></span>
													<?php } elseif ($discipline['status']==3){?>
														<span class="glyphicon glyphicon-check" style="color: #18c721"></span>
													<?php }?>
												</td>
												<td><?=$discipline['code_discipline']?></td>
												<td>
													<?php echo Html::a($discipline['name'].'<br>Профиль: '.$discipline['profile'], Url::toRoute(['site/discipline', 'id' => $discipline['id']]));?>
												</td>
												<td>
													<?php 
														if($discipline['lecture']) {
															echo $discipline['lecture'];
														}else{
															echo "-";
														}
													?>
													</td>
												<td>
													<?php 
														if($discipline['practice']) {
															echo $discipline['practice'];
														}else{
															echo "-";
														}
													?>
													</td>
												<td><?php 
														if($discipline['lab']) {
															echo $discipline['lab'];
														}else{
															echo "-";
														}
													?></td>
												<td>
													<?php 
														if($discipline['selfwork']) {
															echo $discipline['selfwork'];
														}else{
															echo "-";
														}
													?>
												</td>
												<td><span class="glyphicon glyphicon-save" aria-hidden="true"></span></td>
											</tr>
									<?php endforeach; ?>
							    </tbody>
						  	</table>
						</div>

					</div>

			<?php endforeach; 

			?>
			<?php } else {
				echo "Дисциплины отсутствуют";
			} 
		?>
	

</div>
<?php Pjax::end(); ?>
</body>
</html>
