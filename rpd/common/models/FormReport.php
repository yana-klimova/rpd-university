<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_report".
 *
 * @property int $id
 * @property string $report
 *
 * @property AssessmentTool[] $assessmentTools
 */
class FormReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report'], 'required'],
            [['report'], 'string', 'max' => 255],
            [['report'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report' => 'Report',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentTools()
    {
        return $this->hasMany(AssessmentTool::className(), ['id_form_report' => 'id']);
    }
}
