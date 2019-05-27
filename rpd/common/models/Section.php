<?php

namespace common\models;

use Yii;
use common\models\FormControl;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "section".
 *
 * @property int $id
 * @property int $number
 * @property string $name
 * @property string $content
 * @property string $question
 * @property int $lection_time
 * @property int $practice_time
 * @property int $lab_time
 * @property int $selfwork_time
 * @property int $full_time_contact
 * @property int $full_time
 * @property int $id_discipline
 *
 * @property Discipline $discipline
 * @property SectionFormControl[] $sectionFormControls
 * @property SectionLab[] $sectionLabs
 * @property SectionPractice[] $sectionPractices
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо ввести название раздела'],
            [['number', 'lection_time', 'practice_time', 'lab_time', 'selfwork_time', 'full_time_contact', 'full_time', 'id_discipline'], 'integer', 'message' => 'Необходимо ввести число'],
            [['name', 'content', 'task', 'test'], 'trim'],
            [['name', 'content', 'task', 'test'], 'string', 'min'=>5, 'tooShort' => 'Минимальная длина 5 символов'],

            
            [['lection_time', 'practice_time', 'lab_time', 'selfwork_time', 'full_time_contact', 'full_time'], 'default', 'value' => 0],

            ['name', 'unique', 'targetAttribute' => ['name', 'id_discipline'], 'targetClass'=>Discipline::className(), 'targetClass'=>Section::className(), 'message'=>'Данное название уже существует'],
            [['task', 'test'], 'string'],
            ['lection_time', 'compare', 'compareValue' => $this->getDisciplineLectureRemain(), 'operator' => '<=', 'type' => 'number', 'message' => 'Число должно быть в пределах допустимого'],
            ['selfwork_time', 'compare', 'compareValue' => $this->getDisciplineSelfworkRemain(), 'operator' => '<=', 'type' => 'number', 'message' => 'Число должно быть в пределах допустимого'],

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
            'name' => 'Name',
            'content' => 'Content',
            'lection_time' => 'Lection Time',
            'practice_time' => 'Practice Time',
            'lab_time' => 'Lab Time',
            'selfwork_time' => 'Selfwork Time',
            'full_time_contact' => 'Full Time Contact',
            'full_time' => 'Full Time',
            'id_discipline' => 'Id Discipline',
        ];
    }

    public function getDisciplineLectureRemain() {
        $disciplineId = Yii::$app->session['currentDisciplineId'];
        $discipline = Discipline::findOne($disciplineId);
        return $discipline->getLectureRemain();
    }

    public function getDisciplineSelfworkRemain() {
        $disciplineId = Yii::$app->session['currentDisciplineId'];
        $discipline = Discipline::findOne($disciplineId);
        return $discipline->getSelfworkRemain();
    }
    

    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    public function getControls() {
        return $this->hasMany(FormControl::className(), ['id'=>'id_form_control'])->viaTable('section_form_control', ['id_section'=>'id']);
    }


    public function setDiscipline($discipline_id) {
        $discipline = Discipline::findOne($discipline_id);
        if($discipline_id != null) {
            $this->link('discipline', $discipline);
            return true;
        } else {
            return false;
        }
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function saveControls($controls) {

        if (isset($controls))

        {
            SectionFormControl::deleteAll(['id_section'=>$this->id]);
            foreach ($controls as $control_id) {
                $control = FormControl::findOne($control_id);
                $this->link('controls', $control);
            }
        } else {
            SectionFormControl::deleteAll(['id_section'=>$this->id]);
        }
    }

    public function saveLabs($labs, $time) {

        if (isset($labs) && isset($time)) 

        {
            SectionLab::deleteAll(['id_section'=>$this->id]);
            foreach ($labs as $lab_id) {
                $newSectionLab = new SectionLab();
                $newSectionLab->id_lab = $lab_id;
                $newSectionLab->id_section = $this->id;
                $newSectionLab->time = $time[$lab_id];
                $newSectionLab->save(false);
            }
        } else {
            SectionLab::deleteAll(['id_section'=>$this->id]);
        }
    }

    public function saveLabTime(){
        $timeLabSection = $this->getLabTime();
        $this->lab_time = $timeLabSection;
        $this->save(false);
        return  $timeLabSection;
    }

    public function getLabTime(){
        return $this->getLabSections()->sum('time');
    }

    public function getPracticeTime(){
        return $this->getPracticeSections()->sum('time');
    }
    public function savePracticeTime(){
        $timePracticeSection = $this->getPracticeTime();
        $this->practice_time = $timePracticeSection;
        $this->save(false);
        return  $timePracticeSection;
    }

    public function savePractices($practices, $time) {

        if (isset($practices)&&isset($time)) 

        {
            SectionPractice::deleteAll(['id_section'=>$this->id]);
            foreach ($practices as $practice_id) {
                $newSectionPractice = new SectionPractice();
                $newSectionPractice->id_practice = $practice_id;
                $newSectionPractice->id_section = $this->id;
                $newSectionPractice->time = $time[$practice_id];
                $newSectionPractice->save(false);
            }
        } else {
            SectionPractice::deleteAll(['id_section'=>$this->id]);
        }
    }

    public function getSelectedLabsId() {
        $selectedLabs = $this->getLabs()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedLabs, 'id');
    }

    public function getSelectedPracticesId() {
        $selectedPractices = $this->getPractices()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedPractices, 'id');
    }


    public function getSelectedControls() {
        $selectedControls = $this->getControls()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedControls, 'id');
    }

    public function getLabSections()
    {
        return $this->hasMany(SectionLab::className(), ['id_section' => 'id']);
    }

    public function getLabs()
    {
        return $this->hasMany(LabWork::className(), ['id' => 'id_lab'])
            ->via('labSections');
    }

    public function getLabOfSection($id_lab) {
        $sectionLab = SectionLab::findOne(['id_lab'=>$id_lab, 'id_section'=>$this->id]);
        return $sectionLab;
    }

    public function getPracticeOfSection($id_practice) {
        $sectionPractice = SectionPractice::findOne(['id_practice'=>$id_practice, 'id_section'=>$this->id]);
        return $sectionPractice;
    }

    public function getPracticeSections()
    {
        return $this->hasMany(SectionPractice::className(), ['id_section' => 'id']);
    }

    public function getPractices()
    {
        return $this->hasMany(Practice::className(), ['id' => 'id_practice'])
            ->via('practiceSections');
    }


}
