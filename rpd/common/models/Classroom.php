<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classroom".
 *
 * @property int $id
 * @property string $room
 *
 * @property DisciplineClassroom[] $disciplineClassrooms
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

   const DEFAULT_ROOM = 'Учебная аудитория';

    public static function tableName()
    {
        return 'classroom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room'], 'required', 'message'=>'Необходимо ввести аудиторию'],
            [['room'], 'string'],
            [['room'], 'trim'],
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
            'room' => 'Room',
        ];
    }

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
