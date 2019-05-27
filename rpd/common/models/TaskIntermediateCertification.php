<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_intermediate_certification".
 *
 * @property int $id
 * @property string $tasks
 * @property int $id_discipline
 *
 * @property Discipline $discipline
 */
class TaskIntermediateCertification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_intermediate_certification';
    }

    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['title'], 'required', 'message'=>'Необходимо ввести название'],
            [['tasks'], 'required', 'message'=>'Необходимо ввести вопросы и задания'],
            [['tasks', 'title'], 'string'],
            [['id_discipline'], 'default', 'value' => null],
            [['id_discipline'], 'integer'],
            [['tasks', 'title'], 'trim'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
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
