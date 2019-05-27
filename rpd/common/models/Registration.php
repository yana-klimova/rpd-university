<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\ControlCan;
use common\models\TypeControl;
use common\models\User;

class Registration extends \yii\base\Model
{

    public $password;
    public $username;
    public $role;
    public $email;

    public function rules()
    {
        return [
            [['password', 'username', 'email'], 'required', 'message'=>'Обязательное поле'],
            [['password'], 'string', 'min'=>8, 'max'=>10, 'tooShort' => 'Минимальная длина 8 символов', 'tooLong' => 'Максимальная длина 10 символов'],
            [['password', 'username', 'email'], 'trim'],
            [['email'], 'unique', 'targetClass'=>'common\models\User', 'message'=>'Такой email уже зарегистрирован'],
            [['username'], 'unique', 'targetClass'=>'common\models\User', 'message'=>'Такое ФИО пользователя уже существует'], 
            [['role'], 'safe'], 
            [['email'], 'email']
        ];
    }

    public function registration()
    {
        $user = new User();
        $user->email = $this->email;

        $user->setPassword($this->password);
        $user->username = $this->username;
        $roles = $this->role;
        //print_r($roles);
        if($user->save()){
            if($roles) {
                foreach ($roles as $role) {
                    $user->createAssignRole($role);
                }
            }
            return $user->getId();
        }
    }


    public function generatePassword() {
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
        $max=10; 
        $size=StrLen($chars)-1; 
        $password=null; 
        while($max--)   
        $password.=$chars[rand(0,$size)];
        $this->password = $password; 
    }

    public function attributeLabels()
    {
        return [
            'role' => 'Роль пользователя',
        ];
    }

}
