<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "information".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $material
 * @property string $date
 * @property int $status
 * @property int $for_teacher
 * @property int $for_organizer
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title', 'content', 'description'], 'trim'],
            [['description', 'content'], 'string'],
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
            'description' => 'Описание',
            'content' => 'Содержание',
            'date' => 'Дата создания',
            'status' => 'Активная',
            'for_teacher' => 'Для преподавателей',
            'for_organizer' => 'Для организатора',
        ];
    }

    public static function getActiveTeacherInfo(){
        return Information::find()->where(['status'=>1, 'for_teacher'=>1])->all();
    }

    public static function getActiveOrganizerInfo(){
        return Information::find()->where(['status'=>1, 'for_organizer'=>1])->all();
    }

    public function getInformationFiles()
    {
        return $this->hasMany(InformationFile::className(), ['information_id' => 'id']);
    }

    public function getCountFiles(){
        return $this->getInformationFiles()->count();
    }

}
