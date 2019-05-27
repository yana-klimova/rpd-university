<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "control_can".
 *
 * @property int $id
 * @property int $id_can
 * @property int $id_type_control
 *
 * @property Can $can
 * @property TypeControl $typeControl
 */
class ControlCan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_can';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_can'], 'required'],
            [['id_can', 'id_type_control'], 'integer'],
            [['id_can'], 'exist', 'skipOnError' => true, 'targetClass' => Can::className(), 'targetAttribute' => ['id_can' => 'id']],
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
            'id_can' => 'Id Can',
            'id_type_control' => 'Id Type Control',
        ];
    }
}
