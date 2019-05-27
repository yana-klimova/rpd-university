<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "handout".
 *
 * @property int $id
 * @property string $material
 *
 * @property AssessmentTool[] $assessmentTools
 */
class Handout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'handout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material'], 'required'],
            [['material'], 'string', 'max' => 255],
            [['material'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material' => 'Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentTools()
    {
        return $this->hasMany(AssessmentTool::className(), ['id_handout' => 'id']);
    }
}
