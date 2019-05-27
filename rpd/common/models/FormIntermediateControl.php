<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_intermediate_control".
 *
 * @property int $id
 * @property string $form_control
 *
 * @property AssessmentTool[] $assessmentTools
 */
class FormIntermediateControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_intermediate_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_control'], 'required'],
            [['form_control'], 'string', 'max' => 255],
            [['form_control'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_control' => 'Form Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentTools()
    {
        return $this->hasMany(AssessmentTool::className(), ['id_form_intermediate_control' => 'id']);
    }
}
