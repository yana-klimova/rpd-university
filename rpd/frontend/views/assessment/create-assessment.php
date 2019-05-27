<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Процедуры и средства оценивания элементов компетенций  по дисциплине</h3></div>
	</div>
	<div class="row">
		<div class="col-md-12">

			<?php $form = ActiveForm::begin([

		    'id' => 'assessment-update-form all-form', 'class'=>'form-horizontal']); ?>

			<h4 class="text-center">Текущий контроль</h4>
			<div class="panel-group">
			    <?php foreach ($currentAssessments as $assessment) :
			    	$assessmentProcedure = $assessment->procedure->id;
			    	?>
	    			<div class="panel panel-default">
  						<div class="panel-heading">Процедура проведения: <?=$assessment->procedure->name?></div>
						<div class="panel-body">
					    	<div class="form-group row">
								<?= Html::label('Продолжительность контроля','currentassessment-id_duration_control', ['class'=>'col-md-2']);?>
								<div class="col-md-10">
					    			<?= Html::dropDownList("duration-$assessmentProcedure", $selectedDurationControl[$assessmentProcedure], ArrayHelper::map($durationControls, 'id', 'duration'), ['class'=>'form-control']); ?>
					    		</div>
					    	</div>
					    	<div class="form-group row">
					    		<?= Html::label('Форма проведения контроля','currentassessment-id_form_current_control', ['class'=>'col-md-2']);?>
					    		<div class="col-md-10">
					    			<?= Html::dropDownList("form-control-$assessmentProcedure", $selectedControlForm[$assessmentProcedure], ArrayHelper::map($currentControlForms, 'id', 'form_control'), ['class'=>'form-control']); ?>
					    		</div>
					    	</div>
					    	<div class="form-group row">
					    		<?= Html::label('Вид проверочного задания','currentassessment-id_type_verification_task', ['class'=>'col-md-2']);?>
					    		<div class="col-md-10">
					    			<?= Html::dropDownList("type-verification-task-$assessmentProcedure", $selectedTypeOfTask[$assessmentProcedure], ArrayHelper::map($typesOfTask, 'id', 'type_task'), ['class'=>'form-control']); ?>
					    		</div>
					    	</div>
					    	<div class="form-group row">
					    		<?= Html::label('Форма отчета' ,'currentassessment-id_form-report', ['class'=>'col-md-2']);?>
					    		<div class="col-md-10">
					    			<?= Html::dropDownList("form-report-$assessmentProcedure", $selectedformOfReport
					    			[$assessmentProcedure], ArrayHelper::map($formsOfReport, 'id', 'report'), ['class'=>'form-control']); ?>
					    		</div>
					    	</div>
					    	<div class="form-group row">
					    		<?= Html::label('Раздаточный материал', "currentassessment-handout", ['class'=>'col-md-2']);?>
					    		<div class="col-md-10">
					    			<?= Html::dropDownList("handout-$assessmentProcedure", $selectedHandout[$assessmentProcedure], ArrayHelper::map($handouts, 'id', 'material'), ['class'=>'form-control']); ?>
					    		</div>
					    	</div>
					    </div>
					</div>
			    <?php endforeach; ?>
			</div>
    			<h4 class="text-center">Промежуточный контроль</h4>
    			<div class="panel panel-default">
  					<div class="panel-heading">Процедура проведения: <?=$intermediateAssessment->procedure->name?></div>
					<div class="panel-body">
				    	<div class="form-group row">
							<?= Html::label('Продолжительность контроля','intermediateassessment-id_duration_control', ['class'=>'col-md-2']);?>
							<div class="col-md-10">
				    			<?= Html::activeDropDownList($intermediateAssessment, 'id_duration_control', ArrayHelper::map($durationControls, 'id', 'duration'), ['class'=>'form-control']); ?>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<?= Html::label('Форма проведения контроля','intermediateassessment-id_form_current_control', ['class'=>'col-md-2']);?>
				    		<div class="col-md-10">
				    			<?= Html::activeDropDownList($intermediateAssessment, 'id_form_intermediate_control', ArrayHelper::map($intermediateControlForms, 'id', 'form_control'), ['class'=>'form-control']); ?>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<?= Html::label('Вид проверочного задания','intermediateassessment-id_type_verification_task', ['class'=>'col-md-2']);?>
				    		<div class="col-md-10">
				    			<?= Html::activeDropDownList($intermediateAssessment, 'id_type_verification_task', ArrayHelper::map($typesOfTask, 'id', 'type_task'), ['class'=>'form-control']); ?>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<?= Html::label('Форма отчета','intermediateassessment-id_form_report', ['class'=>'col-md-2']);?>
				    		<div class="col-md-10">
				    			<?= Html::activeDropDownList($intermediateAssessment, 'id_form_report', ArrayHelper::map($formsOfReport, 'id', 'report'), ['class'=>'form-control']); ?>
				    		</div>
				    	</div>
				    	<div class="form-group row">
				    		<?= Html::label('Раздаточный материал','intermediateassessment-id_handout', ['class'=>'col-md-2']);?>
				    		<div class="col-md-10">
				    			<?= Html::activeDropDownList($intermediateAssessment, 'id_handout', ArrayHelper::map($handouts, 'id', 'material'), ['class'=>'form-control']); ?>
				    		</div>
				    	</div>
				    </div>
				</div>
				<div class="form-group pull-right">
					<?= Html::a('Отмена', Url::toRoute(['assessment/cancel-update', 'id_discipline'=> $discipline->id]), ['class' => 'btn btn-primary']) ?>
		    		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
				</div>
			<?php ActiveForm::end(); ?>	
				</div>
			</div>
		</div>
	</div>
</div>