<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "control_know".
 *
 * @property int $id
 * @property int $id_know
 * @property int $id_type_control
 *
 * @property Know $know
 * @property TypeControl $typeControl
 */
class ControlKnow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_know';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_know'], 'required'],
            [['id_know', 'id_type_control'], 'default', 'value' => null],
            [['id_know', 'id_type_control'], 'integer'],
            [['id_know'], 'exist', 'skipOnError' => true, 'targetClass' => Know::className(), 'targetAttribute' => ['id_know' => 'id']],
            [['id_type_control'], 'exist', 'skipOnError' => true, 'targetClass' => TypeControl::className(), 'targetAttribute' => ['id_type_control' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_know' => 'Id Know',
            'id_type_control' => 'Id Type Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnow()
    {
        return $this->hasOne(Know::className(), ['id' => 'id_know']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeControl()
    {
        return $this->hasOne(TypeControl::className(), ['id' => 'id_type_control']);
    }
}
