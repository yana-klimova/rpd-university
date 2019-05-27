<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Файлы';
$this->params['breadcrumbs'][] = ['label' => 'Информация', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $information->title, 'url' => ['view', 'id'=>$information->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
	<?=Html::a('Добавить файл', Url::toRoute(['information/file-upload', 'id'=>$information->id]), ['class'=>'btn btn-success'])?>
	<?php foreach ($files as $file): ?>	
		<h4><?=$file->title?></h4>
		<?=Html::a('Скачать', Url::toRoute(['information/file-download', 'id'=>$file->id]))?>
		<?=Html::a('Удалить', Url::toRoute(['information/file-delete', 'id'=>$file->id]), ['data' => [
                'confirm' => 'Вы уверены что хотите удалить файл?',
                'method' => 'post',
            ]])?>	
	<?php endforeach ?>
</div>
