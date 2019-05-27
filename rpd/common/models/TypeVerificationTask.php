<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_verification_task".
 *
 * @property int $id
 * @property string $type_task
 *
 * @property AssessmentTool[] $assessmentTools
 */
class TypeVerificationTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_verification_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_task'], 'required'],
            [['type_task'], 'string', 'max' => 255],
            [['type_task'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_task' => 'Type Task',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentTools()
    {
        return $this->hasMany(AssessmentTool::className(), ['id_type_verification_task' => 'id']);
    }
}
