<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "software".
 *
 * @property int $id
 * @property string $software
 *
 * @property DisciplineSoftware[] $disciplineSoftwares
 */
class Software extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'software';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['software'], 'required', 'message'=>'Необходимо ввести программное обеспечение'],
            [['software', 'license'], 'string'],
            [['software', 'license'], 'trim'],
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
            'software' => 'Software',
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
