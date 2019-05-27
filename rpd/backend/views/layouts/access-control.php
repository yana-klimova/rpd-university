<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
  <nav class="navbar navbar-inverse admin-menu">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
          <li><?=Html::a('Главная', Url::toRoute(['site/index']))?></a></li> 
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Объявления и материалы
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><?=Html::a('Объявления', Url::toRoute(['notification/index']))?></li>
              <li><?=Html::a('Информация', Url::toRoute(['information/index']))?></li>
              <li><?=Html::a('Материалы', Url::toRoute(['material/index']))?></li>
            </ul>
          </li>
          <li><?=Html::a('Контроль доступа', Url::toRoute(['access-control/index']))?></a></li> 
          <li><?=Html::a('Загрузка шаблона', Url::toRoute(['layout-upload/index']))?></a></li>  
          <li><?=Html::a('Учебный план', Url::toRoute(['plan-upload/index']))?></a></li>    
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if (Yii::$app->user->isGuest){ ?>
              <li><?=Html::a('Войти', Url::toRoute(['site/login']))?></li>
          <?php } else {?>
              <li><a href="#"><span class="glyphicon glyphicon-user"></span><?='  Администратор: '.Yii::$app->user->identity->username?></a></li>
              <li><?=Html::a('Выйти', Url::toRoute(['site/logout']))?></li>
          <?php } ?>
      </ul>
    </div>
  </nav>
</header>
<div class="admin-portal">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
<!--  -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="caf-name">Кафедра: Автоматизированные системы управления</h3>
            </div>             
        </div>
        <div class="row">
          <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked" id='myTab'>
              <li <?php if ($this->context->activePill == 'users'){
                echo 'class="active"';
              }?>><a data-toggle="pill" href="#signup">Пользователи</a></li>

              <li <?php if ($this->context->activePill == 'access-right'){
                echo 'class="active"';
              }?>><a data-toggle="pill" href="#access-right">Права доступа</a></li>
            </ul>
          </div>
          <div class="col-md-9">
            <?=$content?>
          </div>   
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
