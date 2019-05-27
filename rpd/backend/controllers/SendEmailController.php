<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Login;
use common\models\User;
use yii\helpers\ArrayHelper;
/**
 * Site controller
 */
class SendEmailController{


    public function send($user_id) {
        $user = User::findIdentity($user_id);
        Yii::$app->mailer->useFileTransport = false;
        $message = Yii::$app->mailer->compose()
        ->setFrom('rtu.rpd@gmail.com')
        ->setTo($user->email)
        ->setSubject('Логин от системы')
        ->setHtmlBody('<b>Логин: <?=$user->email?></b><br><b>Система: rpd.com</b>');
        $message->send();
    }
  
}
