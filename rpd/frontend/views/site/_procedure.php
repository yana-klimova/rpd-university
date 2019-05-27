<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Процедуры и средства оценивания элементов компетенций  по дисциплине</h3></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table-bordered assessment">
				<tbody>
					<tr>
						<th rowspan='3'>Процедура проведения</th>
						<th colspan="4">Средство оценивания</th>
					</tr>
					<tr>
						<td colspan="3">Текущий контроль</td>
						<td>Промежуточный контроль</td>
					</tr>
					<tr>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->procedure->name?></td>
						<?php endforeach ?>
							<td><?=$discipline->intermediateAssessment->procedure->name?></td>

					</tr>
					<tr>
						<td>Продолжительность контроля</td>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->durationControl->duration?></td>
						<?php endforeach ?>
							<td><?=$discipline->intermediateAssessment->durationControl->duration?></td>
					</tr>
					<tr>
						<td>Форма проведения контроля</td>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->formCurrentControl->form_control?></td>
						<?php endforeach ?>
							<td><?=$discipline->intermediateAssessment->formIntermediateControl->form_control?></td>
					</tr>
					<tr>
						<td>Вид проверочного задания</td>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->typeVerificationTask->type_task?></td>
						<?php endforeach ?>
							<td><?=$discipline->intermediateAssessment->typeVerificationTask->type_task?></td>
					</tr>
					<tr>
						<td>Форма отчета</td>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->formReport->report?></td>
						<?php endforeach ?>
							<td><?=$discipline->intermediateAssessment->formReport->report?></td>
					</tr>
					<tr>
						<td>Раздаточный материал</td>
						<?php foreach ($discipline->currentAssessments as $assessment): ?>
							<td><?=$assessment->handout->material?></td>
						<?php endforeach; ?>
							<td><?=$discipline->intermediateAssessment->handout->material?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['assessment/update', 'id_discipline'=>$discipline->id]), ['class'=>'btn btn-primary']);?>
			</div>
		</div>
	</div>
</div>