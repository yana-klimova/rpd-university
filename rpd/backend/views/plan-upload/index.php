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
		<h3>Учебный план</h3>
		<?php foreach ($years as $key => $value): ?>
			<div class="col-md-12 well">
				<h4>20<?=$key?> - 20<?=($key+1)?> год</h4>
				<?php if(empty($value)){
					echo Html::a('Загрузить', Url::toRoute(['plan-upload/upload', 'year'=>$key]), ['class'=>'btn btn-success btn-space', 'data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите загрузить данный учебный план?')]);
					echo Html::a('Удалить', Url::toRoute(['plan-upload/delete', 'year'=>$key]), ['class'=>'btn btn-danger disabled', 'data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить данный учебный план?')]);
				} else {
					echo Html::a('Загрузить', Url::toRoute(['plan-upload/upload', 'year'=>$key]), ['class'=>'btn btn-success disabled btn-space', 'data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите загрузить данный учебный план?')]);
					echo Html::a('Удалить', Url::toRoute(['plan-upload/delete', 'year'=>$key]), ['class'=>'btn btn-danger', 'data-method'  => 'post', 'data-confirm' => Yii::t('yii', 'Вы действительно хотите удалить данный учебный план?')]);
				}?>
			</div>
		<?php endforeach ?>
	</div>
	
</body>
</html>