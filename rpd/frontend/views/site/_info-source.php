<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Информационные источники</h3></div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">Основная литература</div>
					<div class="panel-body">
						<?php 
						$i=0;
						//debug($discipline->baseLiteratures);
						if($discipline->baseLiteratures){
							foreach ($discipline->baseLiteratures as $literature): 
							$i++; ?>							
							<div class="row">
								<div class='col-md-12'>
									<?= $i.') '.$literature->name?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Авторы: '.$literature->authors?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Издание: '.$literature->publish?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Год: '.$literature->year?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class='pull-right'>
										<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['base-literature/update', 'id_literature'=>$literature->id, 'id_discipline'=>$discipline->id]));?>
										<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['base-literature/delete', 'id_literature'=>$literature->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить литературу?'), 'id'=>'base-literature-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
									</div>
								</div>
							</div>
						<?php endforeach ;
						}
						
						// debug($classroom->id);
						if(Yii::$app->session['base-literature-update']){
							$actionBaseLiteratureForm = Url::toRoute(['base-literature/update', 'id_literature'=>$baseLiterature->id, 'id_discipline' => $discipline->id]);
						} else {
							$actionBaseLiteratureForm = Url::toRoute(['base-literature/create', 'id_discipline' => $discipline->id]);
						}?>
						<?php if($discipline->status==1) $form = ActiveForm::begin([
					    'action' => $actionBaseLiteratureForm,
					    'enableAjaxValidation' => true,
					    'options' => [
					    
					        'data-pjax' => '1'
					    ],
					    'id' => 'base-literature-update-form'
					]); ?>
					    <?php if($discipline->status==1) {
					    	echo $form->field($baseLiterature, 'name')->textArea()->label('Название');
					    	echo $form->field($baseLiterature, 'authors')->textArea()->label('Авторы');
					    	echo $form->field($baseLiterature, 'publish')->label('Издательство');
					    	echo $form->field($baseLiterature, 'year')->label('Год издания') ?>
					    <div class='pull-right'>
					    	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
					    </div>
					<?php ActiveForm::end(); }?>	
					</div>
			</div>
			<div class="panel panel-default">
					<div class="panel-heading">Дополнительная литература</div>
					<div class="panel-body">
						<?php 
						$i=0;
						//debug($discipline->baseLiteratures);
						if($discipline->addLiteratures){
							foreach ($discipline->addLiteratures as $addLiterature): 
							$i++; ?>							
							<div class="row">
								<div class='col-md-12'>
									<?= $i.') '.$addLiterature->name?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Авторы: '.$addLiterature->authors?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Издание: '.$addLiterature->publish?>
								</div>
							</div>
							<div class="row">
								<div class='col-md-12'>
									<?= 'Год: '.$addLiterature->year?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class='pull-right'>
										<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['addition-literature/update', 'id_literature'=>$addLiterature->id, 'id_discipline'=>$discipline->id]));?>
										<?php if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['addition-literature/delete', 'id_literature'=>$addLiterature->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить литературу?'), 'id'=>'addition-literature-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
									</div>
								</div>
							</div>
						<?php endforeach ;
						}
						
						// debug($classroom->id);
						if(Yii::$app->session['addition-literature-update']){
							$actionAddLiteratureForm = Url::toRoute(['addition-literature/update', 'id_literature'=>$additionLiterature->id, 'id_discipline' => $discipline->id]);
						} else {
							$actionAddLiteratureForm = Url::toRoute(['addition-literature/create', 'id_discipline' => $discipline->id]);
						}?>
						<?php if($discipline->status==1) $form = ActiveForm::begin([
					    'action' => $actionAddLiteratureForm,
					    'options' => [
					    
					        'data-pjax' => '1'
					    ],
					    'id' => 'add-literature-update-form'
					]); ?>
					    <?php if($discipline->status==1) {
					    	echo  $form->field($additionLiterature, 'name')->textArea()->label('Название');
					    	echo $form->field($additionLiterature, 'authors')->textArea()->label('Авторы');
					    	echo $form->field($additionLiterature, 'publish')->label('Издательство');
					    	echo $form->field($additionLiterature, 'year')->label('Год издания');?>
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
				<div class="panel-heading">Интернет ресурсы</div>
				<div class="panel-body">
					<?php 
					$i=0;
					//debug($discipline->baseLiteratures);
					if($discipline->sites){
						foreach ($discipline->sites as $resource): 
						$i++; ?>							
						<div class="row">
							<div class='col-md-12'>
								<?= $i.') '.$resource->site?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class='pull-right'>
									<?php if($discipline->status==1) echo Html::a('Изменить', Url::toRoute(['site-resource/update', 'id_site'=>$resource->id, 'id_discipline'=>$discipline->id]));?>
									<?php  if($discipline->status==1) echo Html::a('Удалить', Url::toRoute(['site-resource/delete', 'id_site'=>$resource->id, 'id_discipline'=>$discipline->id]), ['data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить сайт?'), 'id'=>'site-delete', 'data-pjax'=>1, 'data-method' => 'post']);?>
								</div>
							</div>
						</div>
					<?php endforeach ;
					}
					
					// debug($classroom->id);
					if(Yii::$app->session['site-update']){
						$actionSiteForm = Url::toRoute(['site-resource/update', 'id_site'=>$site->id, 'id_discipline' => $discipline->id]);
					} else {
						$actionSiteForm = Url::toRoute(['site-resource/create', 'id_discipline' => $discipline->id]);
					}?>
					<?php if($discipline->status==1) $form = ActiveForm::begin([
				    'action' => $actionSiteForm,
				    'options' => [
				    
				        'data-pjax' => '1'
				    ],
				    'id' => 'site-update-form'
				]); ?>
				    <?php if($discipline->status==1){

				    	echo $form->field($site, 'site')->label('Сайт'); ?>
				    <div class='pull-right'>
				    	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
				    </div>
				<?php ActiveForm::end(); }?>	
					
				</div>
			</div>
		</div>
	</div>
</div>