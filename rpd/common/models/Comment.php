<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $id_discipline
 * @property int $id_tab
 * @property string $date
 * @property int $from
 * @property string $comment
 * @property bool $status
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_discipline', 'id_tab', 'id_user'], 'integer'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value'=>date('Y-m-d')],
            [['comment'], 'required', 'message'=>'Необходимо заполнить текст комментария'],
            [['comment'], 'string'],
            [['status'], 'boolean'],
            [['status'],'default', 'value'=>false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_discipline' => 'Id Discipline',
            'id_tab' => 'Тема',
            'date' => 'Date',
            'from' => 'From',
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }

    public function getTab()
    {
        return $this->hasOne(Tab::className(), ['id' => 'id_tab']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public static function getTabsList(){
        return ArrayHelper::map(Tab::find()->orderBy('tab_name')->all(), 'id', 'tab_name');
    }
}
