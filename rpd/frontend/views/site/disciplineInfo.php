<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
?>

<div class="discipline-info">

	<div class="panel-body">
		<ul class="nav nav-tabs">
		  <li><a  href="#comp">Компетенции</a></li>
		  <li><a  href="#know-can-own">Знать, уметь, владеть и критерия их оценивания</a></li>
		  <li><a  href="#section">Разделы дисциплины. Тематический план практических и/или лабораторных работ</a></li>
		  <li><a  href="#certification">Задания</a></li>
		  <li><a href="#tech">Материально-техническое обеспечение</a></li>
		  <li><a href="#info-source">Информационные источники</a></li>
		  <li><a href="#procedure">Процедуры и средства оценивания</a></li>
		  <li><a href="#material">Материалы</a></li>
		  <li><a href="#developer">Разработчики</a></li>
		  <li><a href="#comment">Связь с организатором</a></li>
		</ul>

		<div class="tab-content">
	  		<div id="comp" class="tab-pane fade in active">
		  		<?= $this->render('_competency', ['competens' => $competens]) ?>
	  		</div>

	  		<div id="know-can-own" class="tab-pane fade">
  				<?= $this->render('_can-know-own', ['competens' => $competens, 'controls'=>$controls, 'discipline' => $discipline]) ?>
		  	</div>

	  		<div id="section" name="section" class="tab-pane fade">
		  		<?= $this->render('_sections', ['discipline' => $discipline, 'labs'=>$labs, 'practices'=>$practices, 'sections'=>$sections]) ?>
	  		</div>
		  
	  		<div id="certification" class="tab-pane fade">
	  			<?= $this->render('_certifications', ['discipline' => $discipline, 'labs'=>$labs, 'practices'=>$practices, 'sections'=>$sections]) ?>
	  		</div>

	  		<div id="tech" class="tab-pane fade">
	  			<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-tech', 'timeout'=>600000]); ?>
		  		<?= $this->render('_tech', ['discipline' => $discipline, 'classroom'=>$classroom, 'software'=>$software, 'equipment'=>$equipment]); ?>
		  		<?php Pjax::end();?>
			</div>
			<div id="info-source" class="tab-pane fade">
				<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-info-source', 'timeout'=>600000]); ?>
			  	<?= $this->render('_info-source', ['discipline' => $discipline, 'baseLiterature'=>$baseLiterature, 'additionLiterature'=>$additionLiterature, 'site'=>$site]) ?>
			  	<?php Pjax::end();?>
			</div>
			<div id="procedure" class="tab-pane fade">
			  	<?= $this->render('_procedure', ['discipline' => $discipline]) ?>
			</div>
			<div id="developer" class="tab-pane fade">
			  	<?= $this->render('_developer', ['discipline' => $discipline]) ?>
			</div>
			<div id="comment" class="tab-pane fade">
			  	<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-comment', 'timeout'=>600000]); ?>
			  		<?= $this->render('_comment', compact('commentSearchModel', 'commentDataProvider', 'discipline', 'tabs', 'commentModel', 'updateComment')); ?>
			  	<?php Pjax::end();?>
			</div>

			<div id="material" class="tab-pane fade">
				<?php Pjax::begin(['enablePushState' => false, 'id'=>'pj-material', 'timeout'=>600000]); ?>
					<?= $this->render('_material', ['fileModel' => $fileModel, 'discipline'=>$discipline]) ?>
			  	<?php Pjax::end();?>
			</div>
		</div>
	</div>
</div>
