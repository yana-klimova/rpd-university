<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12"><h3>Разработчики</h3></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php 
				echo $discipline->developers;
			?>	
		</div>
	</div>				
</div>