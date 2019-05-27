<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "current_certification".
 *
 * @property int $id
 * @property string $tasks
 * @property string $title
 * @property int $id_discipline
 *
 * @property Discipline $discipline
 */
class CurrentCertification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'current_certification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tasks'], 'required', 'message'=>'Необходимо ввести название'],
            [['title'], 'required', 'message'=>'Необходимо ввести задания промежуточного контроля'],
            [['tasks'], 'string'],
            ['title', 'unique', 'targetAttribute' => ['title', 'id_discipline'], 'targetClass'=>Discipline::className(), 'targetClass'=>CurrentCertification::className(), 'message'=>'Данное название уже существует'],
            [['id_discipline'], 'default', 'value' => null],
            [['id_discipline'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['tasks', 'title'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tasks' => 'Tasks',
            'title' => 'Title',
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
        $discipline = Discipline::findOne($id_discipline);
        $this->link('discipline', $discipline);
    }
}
