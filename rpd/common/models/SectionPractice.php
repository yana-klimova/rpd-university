<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section_practice".
 *
 * @property int $id
 * @property int $id_section
 * @property int $id_practice
 *
 * @property Practice $practice
 * @property Section $section
 */
class SectionPractice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_practice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_section', 'id_practice'], 'required'],
            [['time'], 'default', 'value' => 0],
            [['id_section', 'id_practice', 'time'], 'integer'],
            [['id_practice'], 'exist', 'skipOnError' => true, 'targetClass' => Practice::className(), 'targetAttribute' => ['id_practice' => 'id']],
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
            'id_practice' => 'Id Practice',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practice::className(), ['id' => 'id_practice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'id_section']);
    }
}
