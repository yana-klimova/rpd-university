<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tab".
 *
 * @property int $id
 * @property string $tab_name
 */
class Tab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tab_name'], 'required'],
            [['tab_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tab_name' => 'Tab Name',
        ];
    }
}
