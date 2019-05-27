<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h3>Создание раздела дисциплины</h3>
					<?php $form = ActiveForm::begin([
					
					'id' => 'form-section-create',
					'options' => ['class' => 'form-horizontal all-form']]);?>
					<?= $form->field($section, 'name', ['enableAjaxValidation' => true, 'enableClientValidation'=>true])->textInput(['class' => 'form-control'])->label('Название раздела');?>
					<?= $form->field($section, 'content')->textArea(['class' => 'form-control'])->label('Содержание раздела');?>
					<?php if($discipline->lecture) {?>

						<?php echo $form->field($section, 'lection_time', ['enableAjaxValidation' => true, 'enableClientValidation'=>true,])->input('number', ['class' => 'form-control', 'id'=>'lecture-time'])->label("Кол-во часов на лекцию. Можно ввести до <span>$lectureRemainTime</span> часов");?>

					<?php } else { 
						echo "Лекций не предусмотрено";
					}?>
					<?php echo $form->field($section, 'selfwork_time')->input('number', ['class' => 'form-control'])->label("Кол-во часов на самостоятельную работу. Можно ввести до <span>$selfworkRemainTime</span> часов");?>
					<div class="form-group">
					<?php echo Html::label('Средства оценивания:', 'checkboxControls');?>

					<?php echo Html::checkboxList('sectionControls', $selectedControls, $controls, ['class' => 'checkboxControls', 'id'=>'checkboxControls', 'onchange'=>'showForm()']);?>
					</div>

					<?php echo $form->field($section, 'task', ['options'=>['id'=>"task-form", 'class'=>'form-group']])->textArea(['id'=>'section-task'])->label('Вопросы') ?>
					<?php echo $form->field($section, 'test', ['options'=>['id'=>"test-form", 'class'=>'form-group']])->textArea(['id'=>'section-test'])->label('Тесты') ?>
				<?php if($discipline->practice):?>
					<div id='checkboxPractices' class="form-group">
						<?php echo Html::label('Практические работы:', 'practice');?>
						<div id='practice'>
							<div>Всего выделено <span id="all-time-practice"><?=$discipline->practice?></span> часов</div>
							<div>Осталось распределить <span id='practice-remain'><?=$practiceRemainTime?></span> часов</div>
							<?php if($practicesThemeMapId){
								foreach ($practicesThemeMapId as $id => $theme) {
								$check = in_array($id, $selectedPractices)?>
								<div class="row">
									<div class="col-md-9">
										<?= Html::checkbox('sectionPractices[]', $check, ['label' => $theme, 'value'=>$id, 'class'=>'sectionPractices']);?>
									</div>
									<div class="col-md-3">
										<?php echo "<div id='time-practice-$id' class='hide-input-time-practice'>"?>
											<div class="input-group">												
												<span class="input-group-addon">Кол-во часов</span>
												<?php if(in_array($id, $selectedPractices)){
														echo Html::input('text', "time-p-$id", $section->getPracticeOfSection($id)->time, ['class'=>'time-practice-input form-control', 'id'=>"time-p-$id"]);
													} else {
														echo Html::input('text', "time-p-$id", 1, ['class'=>'time-practice-input form-control', 'id'=>"time-p-$id"]);
													}?>
												
											</div>
											
										<?php echo '</div>'?>
									</div>

									</div>
								</div>
							<?php }
							} else {
								echo "<p><b>Для выбора практических работ, необходимо создать практические работы.</b></p>";
							}?>
							
						</div>
					</div>
				<?php endif; ?>
				<?php if($discipline->lab):?>
					<div id='checkboxLabs' class="form-group">
						<?php echo Html::label('Лабораторные работы:', 'lab');?>
						<div id='lab'>
							<div>Всего выделено <span id="all-time-lab"><?=$discipline->lab?></span> часов</div>
							<div>Осталось распределить <span id='lab-remain'><?=$labRemainTime?></span> часов</div>
							<?php if($labsThemeMapId) {
								foreach ($labsThemeMapId as $id => $theme) {
								$check = in_array($id, $selectedLabs)?>
								<div class="row">
									<div class="col-md-9">
										<?= Html::checkbox('sectionLabs[]', $check, ['label' => $theme, 'value'=>$id, 'class'=>'sectionLabs']);?>
									</div>
									<div class="col-md-3">
										<?php echo "<div id='time-lab-$id' class='hide-input-time-lab'>"?>
											<div class="input-group">												
												<span class="input-group-addon">Кол-во часов</span>
												<?php if(in_array($id, $selectedLabs)){
														echo Html::input('text', "time-l-$id", $section->getLabOfSection($id)->time, ['class'=>'time-lab-input form-control', 'id'=>"time-l-$id"]);
													} else {
														echo Html::input('text', "time-l-$id", 1, ['class'=>'time-lab-input form-control', 'id'=>"time-l-$id"]);
													}?>
												
											</div>
											
										<?php echo '</div>'?>
									</div>

									</div>
								</div>
							<?php }
							} else {
								echo "<p><b>Для выбора лабораторных работ, необходимо создать лабораторные работы.</b></p>";
							}?>
							
						</div>
					</div>
				<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<div class="form-group pull-right">
					<?= Html::a('Отмена', Url::toRoute(['site/cancel-create-section', 'id_discipline'=> $discipline->id, 'id_section'=>$section->id]), ['class'=>'btn btn-primary']) ?>

					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
					
        			</div>
        		</div>
	    	</div>
	    </div>
		<?php ActiveForm::end() ?>
	</div>

</body>
</html>