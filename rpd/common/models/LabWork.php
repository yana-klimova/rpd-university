<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab_work".
 *
 * @property int $id
 * @property int $number
 * @property string $theme
 * @property int $time
 * @property string $task
 *
 * @property SectionLab[] $sectionLabs
 */
class LabWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theme'], 'required', 'message' => 'Необходимо ввести тему лабораторной работы'],
            [['number'], 'default', 'value' => null],
            [['number'], 'integer'],
            [['theme', 'task', 'description'], 'string'],
            [['theme', 'task', 'description'], 'trim'],
            [['id_discipline'], 'safe'],
            ['theme', 'unique', 'targetAttribute' => ['theme', 'id_discipline'], 'targetClass'=>Discipline::className(), 'targetClass'=>LabWork::className(), 'message'=>'Данная тема уже существует'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'theme' => 'Theme',
            'task' => 'Task',
            'description' => 'Description',
        ];
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    public function setDiscipline($discipline_id) {
        $discipline = Discipline::findOne($discipline_id);
        if($discipline_id != null) {
            $this->link('discipline', $discipline);
        }
    }

    public function getLabTime(){
        return $this->getLabSections()->sum('time');
    }

    public function getLabSections()
    {
        return $this->hasMany(SectionLab::className(), ['id_lab' => 'id']);
    }

    public function getSections()
    {
        return $this->hasMany(Section::className(), ['id' => 'id_section'])
            ->via('labSections');
    }

    public function getCountOfSections() {
        return $this->getSections()->count();
    }
}
