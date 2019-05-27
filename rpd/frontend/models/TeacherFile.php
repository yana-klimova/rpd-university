<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_file".
 *
 * @property int $id
 * @property int $discipline_id
 * @property string $title
 * @property string $file_name
 */
class TeacherFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discipline_id'], 'default', 'value' => null],
            [['discipline_id'], 'integer'],
            [['title', 'file_name'], 'required'],
            [['title', 'file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discipline_id' => 'Discipline ID',
            'title' => 'Title',
            'file_name' => 'File Name',
        ];
    }
}
