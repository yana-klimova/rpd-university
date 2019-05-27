<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered total-table">
				<thead>
				<tr>
					<th></th>
					<th>ЛК</th>
					<th>ПР</th>
					<th>ЛР</th>
					<th>СР</th>
				</tr>
			</thead>
				<tr>
					<td>Итого по семестру <?=$discipline->semester?></td>
					<td><?php if(!$discipline->lecture) {echo "-";} else { echo $discipline->lecture;} ?></td>
					<td><?php if(!$discipline->practice) {echo "-";} else { echo $discipline->practice;}?></td>
					<td><?php if(!$discipline->lab) {echo "-";} else { echo $discipline->lab;}?></td>
					<td><?php if(!$discipline->selfwork) {echo "-";} else { echo $discipline->selfwork;}?></td>
				</tr>
				<tr>
					<td>Осталось</td>
					<td><?php if (!$discipline->lectureRemain) {echo "-";} else { echo $discipline->lectureRemain;} ?></td>
					<td><?php if (!$discipline->practiceRemain) {echo "-";} else { echo $discipline->practiceRemain;}?></td>
					<td><?php if (!$discipline->labRemain) {echo "-";} else { echo $discipline->labRemain;}?></td>
					<td><?php if (!$discipline->selfworkRemain) {echo "-";} else { echo $discipline->selfworkRemain;}?></td>
				</tr>
		</table>
		</div>
	</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Разделы дисциплины</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if($discipline->status==1) echo Html::a("Добавить раздел", Url::toRoute(['section/create-section', 'id_discipline' => $discipline->id]), ['class' => 'btn btn-success']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<table class="table section-table section-t">
				<thead>
					<tr>
						<!-- <th>Номер</th> -->
						<th width="70%">Название</th>
						<th width="5%">ЛК</th>
						<th width="5%">ПР</th>
						<th width="5%">ЛР</th>
						<th width="5%">СР</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
					<?php foreach ($sections as $section) :?>
						<tr data-id-section='<?=$section->id?>'>
							<!-- <td><?=$section->number?></td> -->
							<td><?=$section->name?></td>
							<td><?php if(!$discipline->lecture) {echo "-";} else { echo $section->lection_time;}?></td>
							<td><?php if(!$discipline->practice) {echo "-";} else { echo($section->practiceTime) ? $section->practiceTime : 0;}?></td>
							<td><?php if(!$discipline->lab) {echo "-";} else { echo($section->labTime) ? $section->labTime : 0;}?></td>
							<td><?php if(!$discipline->selfwork) {echo "-";} else { echo $section->selfwork_time;}?></td>
							<td class="pull-right">

								<?php if($discipline->status==1) echo Html::a('Редактировать', Url::toRoute(['section/update-section', 'id_discipline'=> $discipline->id, 'id_section' => $section->id])) ?><br>

								<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['section/delete-section', 'id_section'=>$section->id, 'id_discipline'=>$discipline->id]), ['class'=>'delete-section', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить раздел?')]) ?>

							</td>
						</tr>
					<?php endforeach; ?>
					
				</tbody>
			</table>
			
			</div>
		</div>

	<?php if ($discipline->practice):?>
		<div class="row">
			<div class="col-md-12">
				<h3>Тематический план практических работ</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if($discipline->status==1) echo Html::a("Добавить практическую работу", Url::toRoute(['practice/create-practice', 'id_discipline' => $discipline->id]), ['class' => 'btn btn-success']); ?>
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-12">

				<table class="table section-table section-t">
				<thead>
					<tr>
				<!-- 		<th>Номер</th> -->
						<th width="40%">Название</th>
						<th width="40%">Разделы</th>
						<th width="10%">Трудоемкость</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($practices as $practice) :

						if ($practice->practiceSections) {
							$countOfSection = $practice->getCountOfSections();
							foreach ($practice->practiceSections as $key => $value) : ?>
								<tr>
									<?php if($key === 0) {?>
									
									<!-- <td rowspan="<?=$countOfSection?>"><?=$practice->number?></td> -->
									<td rowspan="<?=$countOfSection?>"><?=$practice->theme?></td>
								<?php }?>
								<td><?=$value->section->name?></td>
								<!-- <td><?=$value->time?></td> -->
								<td><?=$value->time?></td>
								<?php if($key === 0) {?>
									<td rowspan="<?=$countOfSection?>" class='pull-right'>
									<?php if($discipline->status==1) echo Html::a('Редактировать', Url::toRoute(['practice/update-practice', 'id_discipline'=> $discipline->id, 'id_practice' => $lab->id])) ?><br>

									<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['practice/delete-practice', 'id_discipline'=> $discipline->id, 'id_practice'=> $practice->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить практическую работу?'), 'data-pjax' => 0]) ?>
									</td>
								<?php }
							endforeach; 
						} else { ?>
							<tr>
		<!-- 						<td><?=$practice->number?></td> -->
								<td><?=$practice->theme?></td>
								<td>-</td>
								<td>-</td>
								<td class="pull-right">
									<?php if($discipline->status==1) echo Html::a('Редактировать', Url::toRoute(['practice/update-practice', 'id_discipline'=> $discipline->id, 'id_practice' => $practice->id])) ?><br>

									<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['practice/delete-practice', 'id_discipline'=> $discipline->id, 'id_practice'=> $practice->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить практическую работу?'), 'data-pjax' => 0]) ?>
								</td>
						<?php } ?>
							</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			</div>
		</div>

	<?php endif; ?>

	<?php if ($discipline->lab):?>
		<div class="row" id="lab">
			<div class="col-md-12">
				<h3>Тематический план лабораторных работ</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if($discipline->status==1) echo Html::a("Добавить лабораторную работу", Url::toRoute(['lab-work/create-lab', 'id_discipline' => $discipline->id]), ['class' => 'btn btn-success']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<table class="table section-table section-t">
				<thead>
					<tr>
<!-- 						<th>Номер</th> -->
						<th width="40%">Название</th>
						<th width="40%">Разделы</th>
						<th width="10%">Трудоемкость</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($labs as $lab) : 
						// Перебираем все лабы

						if($lab->labSections) {

							
							$countOfSection = $lab->getCountOfSections();
							// Перебираем все разделы
							foreach ($lab->labSections as $key => $value) : ?>
								<tr>
									<?php if($key === 0) {?>
									
			<!-- 						<td rowspan="<?=$countOfSection?>"><?=$lab->number?></td> -->
									<td rowspan="<?=$countOfSection?>"><?=$lab->theme?></td>
								<?php }?>
								<td><?=$value->section->name?></td>
								<td><?=$value->time?></td>

								<?php if($key === 0) {?>
									<td rowspan="<?=$countOfSection?>" class='pull-right'>
									<?php if($discipline->status==1) echo Html::a('Редактировать', Url::toRoute(['lab-work/update-lab', 'id_discipline'=> $discipline->id, 'id_lab' => $lab->id])) ?><br>

									<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['lab-work/delete-lab', 'id_discipline'=> $discipline->id, 'id_lab'=> $lab->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить лабораторную работу?'), 'data-pjax' => 0]) ?>
									</td>
								<?php }
							endforeach; 
						} else { ?>
							<tr>
<!-- 								<td><?=$lab->number?></td> -->
								<td><?=$lab->theme?></td>
								<td>-</td>
								<td>-</td>
								<td class="pull-right">
									<?php if($discipline->status==1) echo Html::a('Редактировать', Url::toRoute(['lab-work/update-lab', 'id_discipline'=> $discipline->id, 'id_lab' => $lab->id])) ?><br>

									<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['lab-work/delete-lab', 'id_discipline'=> $discipline->id, 'id_lab'=> $lab->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить лабораторную работу?'), 'data-pjax' => 0]) ?>
								</td>
						<?php } ?>
						</tr>
					<?php endforeach; ?>

				</tbody>

			</table>
			
			</div>
		</div>

	<?php endif; ?>
</div>