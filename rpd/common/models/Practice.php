<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "practice".
 *
 * @property int $id
 * @property int $number
 * @property string $theme
 * @property int $time
 * @property string $target
 * @property string $task
 *
 * @property SectionPractice[] $sectionPractices
 */
class Practice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'practice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theme'], 'required', 'message'=>'Необходимо ввести тему практической работы'],
            [['number'], 'default', 'value' => null],
            [['number'], 'integer'],
            [['theme', 'target', 'task', 'description'], 'string'],
            [['theme', 'target', 'task', 'description'], 'trim'],
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
            'time' => 'Time',
            'target' => 'Target',
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

    public function getPracticeTime(){
        return $this->getPracticeSections()->sum('time');
    }

    public function getPracticeSections()
    {
        return $this->hasMany(SectionPractice::className(), ['id_practice' => 'id']);
    }

    public function getSections()
    {
        return $this->hasMany(Section::className(), ['id' => 'id_section'])
            ->via('practiceSections');
    }

    public function getCountOfSections() {
        return $this->getSections()->count();
    }
}
