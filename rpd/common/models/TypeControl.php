<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_control".
 *
 * @property int $id
 * @property string $type
 *
 * @property ControlCan[] $controlCans
 * @property ControlKnow[] $controlKnows
 * @property ControlOwn[] $controlOwns
 */
class TypeControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_control';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 255],
            [['type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlCans()
    {
        return $this->hasMany(ControlCan::className(), ['id_type_control' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlKnows()
    {
        return $this->hasMany(ControlKnow::className(), ['id_type_control' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlOwns()
    {
        return $this->hasMany(ControlOwn::className(), ['id_type_control' => 'id']);
    }
}
