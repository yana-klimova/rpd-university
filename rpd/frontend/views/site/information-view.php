<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-12">
	<div class="panel panel-info">
	  <div class="panel-heading"><?=$information->title?></div>
	  <div class="panel-body">
	  	<div class="row">
			<div class='col-md-12'>
				<?=$information->content?>
			</div>
		</div>
		<?php if($information->informationFiles){?>
			<div class='col-md-12'>
            <?php foreach ($information->informationFiles as $file) {?>
              <div class="row">
                <?php echo Html::a($file->title, Url::toRoute(['site/file-download', 'id_file'=>$file->id]), ['title'=>'Скачать']);?>
              </div>
            <?php } ?>
        	</div>
      	<?php }?>
		<div class="row">
			<div class='col-md-12'>
				<div class="pull-right">
					<?=$information->date?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

