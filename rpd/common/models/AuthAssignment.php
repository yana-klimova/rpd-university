<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 *
 * @property AuthItem $itemName
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'default', 'value' => null],
            [['created_at', 'user_id'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id'], 'message'=>'Для данного пользователя уже существует такая роль'],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Роль',
            'user_id' => 'Пользователь',
            'created_at' => 'Создано',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    public function getItem() {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getUserEmail() {
        return $this->user->email;
    }

    public static function getAllUsers() {
        return ArrayHelper::map(User::find()->all(), 'id', 'username');
    }

    public function getNameOfItem(){
        $item = $this->getItem();
        return $item ? $item->name : '';
    }

    

    public static function getItemsList(){
        return ArrayHelper::map(AuthItem::find()->where(['type'=>1])->all(), 'name', 'description');
    }

    public static function getUsersList(){
        return ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username');
    }

    public static function getEmailList(){
        return ArrayHelper::map(User::find()->orderBy('email')->all(), 'email', 'email');
    }
}
