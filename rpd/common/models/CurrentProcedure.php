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
class CurrentProcedure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'current_procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

}
