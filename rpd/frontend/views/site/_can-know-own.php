<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Знать, уметь, владеть</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<?php foreach ($competens as $i => $comp): ?>
					<li <?php if($i == 0) echo "class='active'";?>><a data-toggle="tab" href="#<?=$comp->id?>"><?=$comp->code?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="tab-content">
				
				<?php foreach ($competens as $i => $comp): ?>
					<div id="<?=$comp->id?>" 
						<?php if ($i == 0) echo "class = 'tab-pane fade in active'"; else echo " class = 'tab-pane fade'"; ?>>
						<h4>Характеризуется:</h4><br>
			    		<p><?=ucfirst($comp->description)?></p>
			    		<div class="row">

					    	<div class="col-md-8">

					    		<?php $form = ActiveForm::begin([
					    			'id' => 'form-can_know_own',
					    			'enableAjaxValidation' => true,
					    			'enableClientValidation'=>true,
					    			'validationUrl' => Url::toRoute(['can-know-own/validate', 'id'=>$comp->id]),
					    			
					    			'options' => ['class' => 'form-horizontal form-comp'],
					    			'action' => Url::toRoute(['can-know-own/create', 'id' => $comp->id, 'discipline_id' => $discipline->id])]);

									echo $form->field($comp->can, 'can')->textArea(['class' => 'form-control']);
									echo Html::label('Средства оценивания:', 'controls');?>
									<div class="row">
										<div class="col-md-6">
											<?php echo Html::checkboxList('controlsCan', $comp->can->selectedControls, $controls);?>
										</div>
									</div>
									<?php echo $form->field($comp->know, 'know')->textArea(['class' => 'form-control']);
									echo Html::label('Средства оценивания:', 'controls');?>
									<div class="row">
										<div class="col-md-6">
											<?php echo Html::checkboxList('controlsKnow', $comp->know->selectedControls, $controls);?>
										</div>
									</div>
									<?php echo $form->field($comp->own, 'own')->textArea(['class' => 'form-control']);
									echo Html::label('Средства оценивания:', 'controls');?>
									<div class="row">
										<div class="col-md-6">
											<?php echo Html::checkboxList('controlsOwn', $comp->own->selectedControls, $controls);?>
										</div>
									</div>
							</div>
						</div>
						<div class="row">
							 <div class="alert alert-success alert-dismissible" role="alert" id="toast-success">
							 	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									Сохранено!
							 </div>
							<div class="col-md-2 col-md-offset-10">
								<div class="form-group pull-right">
									<?php if($discipline->status==1) echo Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'id'=>'submit-can']) ?>
					        	</div>
				        	</div>
						</div>
						<?php ActiveForm::end() ?>
<!-- 
						 <div id = "toast-success" class="success">
							Сохранено!
						 </div> -->
						
					
					</div>
				<?php endforeach ?>
					
			</div>
		</div>
	</div>
</div>