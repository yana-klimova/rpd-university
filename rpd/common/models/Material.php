<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $material
 * @property string $date
 * @property int $status
 * @property int $for_teacher
 * @property int $for_organizer
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'trim'],
            [['description'], 'string'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value'=>date('Y-m-d')],
            [['status', 'for_teacher', 'for_organizer'], 'boolean'],
            [['title', 'material'], 'string', 'max' => 255],
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
            'material' => 'Материал',
            'date' => 'Дата создания',
            'status' => 'Активная',
            'for_teacher' => 'Для преподавателей',
            'for_organizer' => 'Для организатора',
        ];
    }

    public static function getActiveTeacherMaterials(){
        return Material::find()->where(['status'=>1, 'for_teacher'=>1])->all();
    }

    public static function getActiveOrganizerMaterials(){
        return Material::find()->where(['status'=>1, 'for_organizer'=>1])->all();
    }
}
