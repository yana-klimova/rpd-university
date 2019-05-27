<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section_form_control".
 *
 * @property int $id
 * @property int $id_section
 * @property int $id_form_control
 *
 * @property FormControl $formControl
 * @property Section $section
 */
class SectionFormControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_form_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_section'], 'required'],
            [['id_section', 'id_form_control'], 'default', 'value' => null],
            [['id_section', 'id_form_control'], 'integer'],
            [['control'], 'string'],
            [['id_form_control'], 'exist', 'skipOnError' => true, 'targetClass' => FormControl::className(), 'targetAttribute' => ['id_form_control' => 'id']],
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
            'id_form_control' => 'Id Form Control',
            'control' => 'Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormControl()
    {
        return $this->hasOne(FormControl::className(), ['id' => 'id_form_control']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'id_section']);
    }
}
