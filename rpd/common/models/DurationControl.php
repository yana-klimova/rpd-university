<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "duration_control".
 *
 * @property int $id
 * @property string $duration
 *
 * @property AssessmentTool[] $assessmentTools
 */
class DurationControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'duration_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration'], 'required'],
            [['duration'], 'string', 'max' => 255],
            [['duration'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'duration' => 'Duration',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentTools()
    {
        return $this->hasMany(AssessmentTool::className(), ['id_duration_control' => 'id']);
    }
}
