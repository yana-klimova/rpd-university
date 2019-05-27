<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-12">
	<div class="panel panel-info">
	  <div class="panel-heading"><?=$material->title?></div>
	  <div class="panel-body">

	  	<div class="row">
			<div class='col-md-12'>
				<?=$material->description?>
			</div>
		</div>

      	<div class="row">
      		<div class='col-md-12'>
            	<?php echo Html::a($material->title, Url::toRoute(['site/file-download', 'id_material'=>$material->id]), ['title'=>'Скачать']);?>
        	</div>
      	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<?=$material->date?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

