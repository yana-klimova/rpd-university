<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Материально-техническое обеспечение</h3></div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">Аудитории</div>
					
					<div class="panel-body">

						<?php 
						$i=0;
						foreach ($discipline->classrooms as $room): 
							$i++; ?>							
							<div class="row">
								<div class='col-md-12'>
									<?= $i.') '.$room->room?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class='pull-right'>
										<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['classroom/update', 'id_classroom'=>$room->id, 'id_discipline'=>$discipline->id]), ['class'=>'classroom-update']);?>
										<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['classroom/delete', 'id_classroom'=>$room->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить аудиторию?'), 'id'=>'classroom-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
									</div>
								</div>
							</div>
						<?php endforeach ;
						// debug($classroom->id);
						if(Yii::$app->session['classroom-update']){
							$actionClassroomForm = Url::toRoute(['classroom/update', 'id_classroom'=>$classroom->id, 'id_discipline' => $discipline->id]);
						} else {
							$actionClassroomForm = Url::toRoute(['classroom/create', 'id_discipline' => $discipline->id]);
						}?>
						<?php if($discipline->status==1) $form = ActiveForm::begin([
					    'action' => $actionClassroomForm,
					    'options' => [

					        'data-pjax' => '1'
					    ],
					    'id' => 'classroom-update-form']); ?>
					    <?php if($discipline->status==1) {
					    	echo $form->field($classroom, 'room')->textArea(['class' => 'form-control'])->label('Аудитория'); ?>
					    <div class="pull-right">
					    	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
					    </div>
						<?php ActiveForm::end(); }?>	
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Оборудование</div>						
					<div class="panel-body">
						<?php 
						$i=0;
						foreach ($discipline->equipments as $equip): 
							$i++; ?>							
							<div class="row">
								<div class='col-md-12'>
									<?= $i.') '.$equip->equipment?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class='pull-right'>
										<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['equipment/update', 'id_equipment'=>$equip->id, 'id_discipline'=>$discipline->id]));?>
										<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['equipment/delete', 'id_equipment'=>$equip->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить оборудование?'), 'id'=>'equipment-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
									</div>
								</div>
							</div>
						<?php endforeach ;
						// debug($classroom->id);
						if(Yii::$app->session['equipment-update']){
							$actionEquipmentForm = Url::toRoute(['equipment/update', 'id_equipment'=>$equipment->id, 'id_discipline' => $discipline->id]);
						} else {
							$actionEquipmentForm = Url::toRoute(['equipment/create', 'id_discipline' => $discipline->id]);
						}?>
						<?php if($discipline->status==1) $form = ActiveForm::begin([
					    'action' => $actionEquipmentForm,
					    'options' => [
					    
					        'data-pjax' => '1'
					    ],
					    'id' => 'equipment-update-form']); ?>
					    <?php if($discipline->status==1){
					    	echo $form->field($equipment, 'equipment')->textArea(['class' => 'form-control'])->label('Оборудование') ?>
					    <div class='pull-right'>
					    	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
					    </div>
						<?php ActiveForm::end(); }?>	
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Программное обеспечение</div>
				<div class="panel-body">
					<?php 
					$i=0;
					foreach ($discipline->softwares as $soft): 
						$i++; ?>							
						<div class="row">
							<div class='col-md-12'>
								<?= $i.') '.$soft->software?>
							</div>
						</div>
						<?php if($soft->license):?>
							<div class="row">
								<div class='col-md-12'>
									<?= '<b>Лицензия: </b>'.$soft->license?>
								</div>
							</div>
						<?php endif;?>
						<div class="row">
							<div class="col-md-12">
								<div class='pull-right'>
									<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['software/update', 'id_software'=>$soft->id, 'id_discipline'=>$discipline->id]), ['class'=>'classroom-update']);?>
									<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['software/delete', 'id_software'=>$soft->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить программное обеспечение?'), 'id'=>'software-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
								</div>
							</div>
						</div>
					<?php endforeach ;
					// debug($classroom->id);
					if(Yii::$app->session['software-update']){
						$actionSoftwareForm = Url::toRoute(['software/update', 'id_software'=>$software->id, 'id_discipline' => $discipline->id]);
					} else {
						$actionSoftwareForm = Url::toRoute(['software/create', 'id_discipline' => $discipline->id]);
					}?>
					<?php if($discipline->status==1) $form = ActiveForm::begin([
				    'action' => $actionSoftwareForm,
				    'options' => [
				    
				        'data-pjax' => '1'
				    ],
				    'id' => 'software-update-form']); ?>
				    <?php if($discipline->status==1){
				    	echo $form->field($software, 'software')->textArea(['class' => 'form-control'])->label('Программное обеспечение');
				    	echo $form->field($software, 'license')->textInput(['class' => 'form-control'])->label('Лицензия') ?>
				    <div class='pull-right'>
				    	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
				    </div>
					<?php ActiveForm::end(); }?>	
				</div>
			</div>
		</div>
	</div>
</div>