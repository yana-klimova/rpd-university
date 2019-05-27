<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section_lab".
 *
 * @property int $id
 * @property int $id_section
 * @property int $id_lab
 *
 * @property LabWork $lab
 * @property Section $section
 */
class SectionLab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_section', 'id_lab'], 'required'],
            [['time'], 'default', 'value' => 0],
            [['id_section', 'id_lab', 'time'], 'integer'],
            [['id_lab'], 'exist', 'skipOnError' => true, 'targetClass' => LabWork::className(), 'targetAttribute' => ['id_lab' => 'id']],
            [['id_section'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['id_section' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_section' => 'Id Section',
            'id_lab' => 'Id Lab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(LabWork::className(), ['id' => 'id_lab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'id_section']);
    }
}
