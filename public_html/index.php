<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../rpd/vendor/autoload.php';
require __DIR__ . '/../rpd/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../rpd/common/config/bootstrap.php';
require __DIR__ . '/../rpd/frontend/config/bootstrap.php';
require_once __DIR__ . '/../rpd/functions.php';



$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../rpd/common/config/main.php',
    require __DIR__ . '/../rpd/common/config/main-local.php',
    require __DIR__ . '/../rpd/frontend/config/main.php',
    require __DIR__ . '/../rpd/frontend/config/main-local.php'
    
);

(new yii\web\Application($config))->run();
