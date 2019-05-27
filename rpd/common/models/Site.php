<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discipline_software".
 *
 * @property int $id
 * @property int $id_software
 * @property int $id_discipline
 *
 * @property Discipline $discipline
 * @property Software $software
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site'], 'required', 'message'=>'Необходимо ввести сайт'],
            [['id_discipline'], 'integer'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['site'], 'string'],
            [['site'], 'trim']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_discipline' => 'Id Discipline',
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
