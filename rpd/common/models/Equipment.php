<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property int $id
 * @property string $equipment
 *
 * @property DisciplineEquipment[] $disciplineEquipments
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment'], 'required', 'message'=>'Необходимо ввести оборудование'],
            [['equipment'], 'string'],
            [['id_discipline'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipment' => 'Equipment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    public function setDiscipline($id_discipline) {
        if($id_discipline) {
            $discipline = Discipline::findOne($id_discipline);
            $this->link('discipline', $discipline);
        }
    }
}
