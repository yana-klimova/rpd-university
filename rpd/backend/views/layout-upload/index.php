<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<div class="col-md-12">
		<h3>Шаблон</h3>


        	<?php if($template){
        		echo Html::a($template->name, Url::toRoute(['layout-upload/download', 'id'=>$template->id]), ['title'=>'Скачать']);
        	} else{
        		echo '<h4>Необходимо загрузить шаблон</h4>';
        	}?>
        	<div class="row">
        		<div class="col-md-12">
					<?php echo Html::a('Загрузить новый шаблон', Url::toRoute(['layout-upload/upload']), ['class'=>'btn btn-success']);?>
				</div>
			</div>
	</div>
	
</body>
</html>