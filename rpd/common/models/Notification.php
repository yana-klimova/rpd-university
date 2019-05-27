<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property int $status
 * @property int $for_teacher
 * @property int $for_organizer
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title', 'content'], 'trim'],
            [['content'], 'string'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value'=>date('Y-m-d')],
            [['status', 'for_teacher', 'for_organizer'], 'boolean'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'date' => 'Дата создания',
            'status' => 'Активная',
            'for_teacher' => 'Для преподавателей',
            'for_organizer' => 'Для организатора',
        ];
    }

    public static function getActiveTeacherNotifications(){
        return Notification::find()->where(['status'=>1, 'for_teacher'=>1])->all();
    }

    public static function getActiveOrganizerNotifications(){
        return Notification::find()->where(['status'=>1, 'for_organizer'=>1])->all();
    }
}
