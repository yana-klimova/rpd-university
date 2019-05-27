<?php

use frontend\assets\AppAsset;
use common\models\Discipline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use common\widgets\Alert;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
  <div id='main-menu'>
    <nav class="navbar navbar-default navbar-fixed-top teacher-menu navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

              <ul class="nav navbar-nav">
                 <li><?=Html::a('Главная', Url::toRoute(['/organizer']))?></li>
                 <li><?=Html::a('Дисциплины', Url::toRoute(['discipline/index']))?></li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
                
                <?php
                  if (Yii::$app->user->isGuest){ ?>
                      <li><?=Html::a('Войти', Url::toRoute(['/site/login']))?></li>
                  <?php } else {?>
                      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?='  Организатор: '.Yii::$app->user->identity->username?></a></li>
                      <li><?=Html::a('Выйти', Url::toRoute(['/site/logout']))?></span></li>
                  <?php } ?>
              </ul>
          </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
</div>
  <div class="main-content">
      <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
          <div class="row">
            <div class="col-md-12">
                <h3 class="caf-name">Кафедра: Автоматизированные системы управления</h3>
              </div>             
          </div>
        <div class="row">

          <?=$content?>     
        </div>
      </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>