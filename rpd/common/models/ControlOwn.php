<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "control_own".
 *
 * @property int $id
 * @property int $id_own
 * @property int $id_type_control
 *
 * @property Own $own
 * @property TypeControl $typeControl
 */
class ControlOwn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'control_own';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_own'], 'required'],
            [['id_own', 'id_type_control'], 'default', 'value' => null],
            [['id_own', 'id_type_control'], 'integer'],
            [['id_own'], 'exist', 'skipOnError' => true, 'targetClass' => Own::className(), 'targetAttribute' => ['id_own' => 'id']],
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
            'id_own' => 'Id Own',
            'id_type_control' => 'Id Type Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwn()
    {
        return $this->hasOne(Own::className(), ['id' => 'id_own']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeControl()
    {
        return $this->hasOne(TypeControl::className(), ['id' => 'id_type_control']);
    }
}
