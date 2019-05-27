<?php

use frontend\assets\AppAsset;
use common\models\Discipline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <nav class="navbar navbar-inverse">
  		<h4 class="navbar-text login-h">Вход в систему</h4>
	</nav>
</header>
<div class="main-content">
  <div class="container">
    
    <?=$content?>
    
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>