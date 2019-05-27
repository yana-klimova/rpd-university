<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\ControlCan;
use common\models\TypeControl;
use common\models\User;

class Login extends \yii\base\Model
{
    public $email;
    public $password;
    public $remember;

    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'message'=>'Обязательное поле'],
            [['email', 'password'], 'trim'], 
            [['email'], 'unique'],
            [['remember'], 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params) {
        if(!$this->hasErrors()) { //Если нет ошибок валидации
            $user = $this->getUser(); //Получаем модель пользователя по логину
            if(!$user || !$user->validatePassword($this->password)) { //Если пользователь не найден или sha от пароля не равен хранящемуся в password_hash
            $this->addError($attribute, 'Пароль или логин введены неверно');
            }
        }
    }


    public function remember(){
        return $this->remember;
    }

    public function getUser() {
        return User::findOne(['email'=>$this->email]);
    }



    
}
