<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="row">
	<div class="col-md-12">
		<h3>Задания</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
			<li class='active'><a data-toggle="tab" href="#current">Текущий контроль</a></li>
			<li><a data-toggle="tab" href="#exam">Промежуточная аттестация</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tab-content">
			<div id="current" class="tab-pane fade in active">
				<div class="control-content">
					<div class="row">
						<div class="col-md-6">
							<div class="panel-group" id="accordion">
								<?php if($discipline->lab) :?>
								 	<div class="panel panel-default">
									    <div class="panel-heading">
									      <h4 class="panel-title">
									        <a data-toggle="collapse"  href="#lab-certification">
									        Задания для лабораторных работ</a>
									      </h4>
									    </div>
									    <div id="lab-certification" class="panel-collapse collapse certification-panel">
									      <?php foreach ($labs as $key => $lab):
									  			if($lab->task) {?>
													<div class="row">
														<div class="col-md-12">
															<h4><?=$lab->number.') '?>
															<?=$lab->theme?></h4>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Задание:</b><br>
															<?=$lab->task?>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Описание хода выполнения</b><br>
															<?php if($lab->description){
																echo $lab->description;
															} else {
																echo "Нет";
															}?>
														</div>
													</div>
											<?php } endforeach; ?>
									    </div>
							  		</div>
								<?php endif; ?>
								<?php if($discipline->practice) :?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse"  href="#practice-certification">
													Задания для практических работ
												</a>
											</h4>
										</div>
									  	<div id="practice-certification" class="panel-collapse collapse certification-panel">
									  		<?php foreach ($practices as $key => $practice):
									  			if($practice->task) {?>
													<div class="row">
														<div class="col-md-12">
															<h4><?=$practice->number.') '?>
															<?=$practice->theme?></h4>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Задание:</b><br>
															<?=$practice->task?>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Цель:</b><br>
															<?php if($practice->target){
																echo $practice->target;
															} else {
																echo "Нет";
															}?>
														
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Описание хода выполнения:</b><br>
															<?php if($practice->description){
																echo $practice->description;
															} else {
																echo "Нет";
															}?>
														</div>
													</div>
											<?php } endforeach; ?>
									  	</div>
									</div>
								<?php endif; ?>
									<div class="panel panel-default">
										<div class="panel-heading">

											<h4 class="panel-title">
												<a data-toggle="collapse"  href="#section-certification">Вопросы, задания, тесты по разделам дисциплины
												</a>
											</h4>
										</div>
									  	<div id="section-certification" class="panel-collapse collapse certification-panel">
									  		<?php foreach ($sections as $key => $section):
									  			if($section->task || $section->test) {?>
													<div class="row">
														<div class="col-md-12">
															<h4><?=$section->number.') '?>
															<?=$section->name?></h4>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Вопросы и задания:</b><br>
															<?php if($section->task){?>
																<?=$section->task?>
															<?php } else {
																echo "Нет";
															} ?>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<b>Тесты:</b><br>
															<?php if($section->test){?>
																<?=$section->test?>
															<?php } else {
																echo "Нет";
															} ?>
														
														</div>
													</div>
													
											<?php } endforeach; ?>
									  	</div>
								  	</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse"  href="#addition-certification">
												Прочие вопросы и задания
											</a>
										</h4>
									</div>
									<div id="addition-certification" class="panel-collapse collapse certification-panel">
										<div class="row">
											<div class="col-md-12">
								  				<?php echo yii\helpers\Html::a('Добавить', Url::toRoute(['current-certification/create-current-certification']), ['class'=>'btn btn-success']);?>
								  			</div>
								  		</div>
									  		<?php if($discipline->currentCertifications) {
							  					foreach ($discipline->currentCertifications as $certification):?>
							  						<div class="row">
														<div class="col-md-12">
															<h4>
																<?=$certification->title?>
															</h4>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															
															<b>Вопросы и задания:</b><br>
															<?php echo $certification->tasks?>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="pull-right">
																<?= Html::a('Редактировать', Url::toRoute(['current-certification/update-current-certification', 'id_certification'=>$certification->id]), ['class'=>'btn btn-primary']) ?>
																<?= Html::a('Удалить', Url::toRoute(['current-certification/delete-current-certification', 'id_certification'=>$certification->id]), ['class'=>'btn btn-danger', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить данное задание?')]) ?>
															</div>			
														</div>
													</div>
									  		<?php endforeach; }?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="exam" class="tab-pane fade">
				<div class="control-content">
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse"  href="#exam-certification">
										Вопросы и задания промежуточной аттестации
									</a>
								</h4>
							</div>
							<div id="exam-certification" class="panel-collapse collapse certification-panel">
								<div class="row">
									<div class="col-md-12">
						  				<?=Html::a('Добавить', Url::toRoute(['task-intermediate-certification/create-exam-certification']), ['class'=>'btn btn-success']);?>
						  			</div>
						  		</div>
						  		<?php if($discipline->examCertifications){
						  			foreach ($discipline->examCertifications as $certification):?>
						  			
					  					<div class="row">
											<div class="col-md-12">
												<h4>
													<?=$certification->title?>
												</h4>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												
												<b>Вопросы и задания:</b><br>
												<?php echo $certification->tasks?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="pull-right">
													<?= Html::a('Редактировать', Url::toRoute(['task-intermediate-certification/update-exam-certification', 'id_certification'=>$certification->id]), ['class'=>'btn btn-primary']) ?>
													<?= Html::a('Удалить', Url::toRoute(['task-intermediate-certification/delete-exam-certification', 'id_certification'=>$certification->id]), ['class'=>'btn btn-danger', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить данное задание?')]) ?>
												</div>	
											</div>
										</div>
							  		<?php endforeach; 
							  	}?>
							  	</div>
						  	</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>