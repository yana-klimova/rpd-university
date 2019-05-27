<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_control".
 *
 * @property int $id
 * @property string $name
 *
 * @property SectionFormControl[] $sectionFormControls
 */
class FormControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionFormControls()
    {
        return $this->hasMany(SectionFormControl::className(), ['id_form_control' => 'id']);
    }
}
