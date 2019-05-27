<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "discipline".
 *
 * @property int $id
 * @property string $name
 * @property int $semester
 * @property int $year
 * @property string $department
 * @property string $direction
 * @property string $profile
 * @property string $qualification
 * @property string $form_study
 * @property string $short_department
 * @property int $lecture_time
 * @property int $practice_time
 * @property int $lab_time
 * @property int $selfwork_time
 * @property int $control_time
 * @property string $control
 * @property int $fulltime_contact
 * @property int $fulltime
 * @property int $unit
 * @property int $course
 *
 * @property AdditionallyClassroom[] $additionallyClassrooms
 * @property AdditionallyEquipment[] $additionallyEquipments
 * @property AdditionallySoftware[] $additionallySoftwares
 * @property AssessmentTool[] $assessmentTools
 * @property CompetencyDiscipline[] $competencyDisciplines
 * @property CurrentCertification[] $currentCertifications
 * @property DisciplineClassroom[] $disciplineClassrooms
 * @property DisciplineEquipment[] $disciplineEquipments
 * @property DisciplineLiterature[] $disciplineLiteratures
 * @property DisciplineSoftware[] $disciplineSoftwares
 * @property QuestionIntermediateCertification[] $questionIntermediateCertifications
 * @property Section[] $sections
 * @property TaskIntermediateCertification[] $taskIntermediateCertifications
 */
class Discipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $id_discipline;
    public $id_plan;
    public $is_exam;
    public $date_start;
    public $pulpit_code;
    public $qualificationArr;

    public static function tableName()
    {
        return 'discipline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'semester', 'year', 'department', 'direction', 'profile', 'qualification', 'code_direction', 'code_discipline', 'id_discipline'], 'required'],
            [['lecture', 'practice', 'lab', 'selfwork', 'control', 'fulltime_contact', 'fulltime', 'unit', 'course', 'code_direction', 'code_discipline'], 'default', 'value' => null],
            [['semester', 'year', 'lecture', 'practice', 'lab', 'selfwork', 'control_t', 'fulltime_contact', 'fulltime', 'unit', 'course', 'lectureRemain', 'practiceRemain', 'labRemain', 'selfworkRemain', 'status', 'zet'], 'integer'],
            [['name', 'department', 'direction', 'profile', 'qualification', 'short_department', 'control', 'code_direction', 'code_discipline', 'description', 'program', 'doc_file', 'pdf_file'], 'string', 'max' => 255],
            [['id_plan', 'is_exam','date_start', 'pulpit_code', 'description', 'current_year'], 'safe'],
            [['developers'], 'string'],
            [['view_org'], 'boolean', 'default', 'value' => 0],
            [['status'], 'default', 'value'=>1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название дисциплины',
            'semester' => 'Семестр',
            'year' => 'Учебный год',
            'department' => 'Кафедра',
            'direction' => 'Направление',
            'profile' => 'Специализация',
            'qualification' => 'Квалификация',
            'short_department' => 'Код кафедры',
            'lecture' => 'Лекции',
            'practice' => 'Практика',
            'lab' => 'Лабораторные',
            'selfwork' => 'Самостоятельная работа',
            'control_t' => 'Контроль',
            'control' => 'Вид контроля',
            'fulltime_contact' => 'Всего(контакт)',
            'fulltime' => 'Всего',
            'unit' => 'Зачетные единицы',
            'course' => 'Курс',
            'code_direction'=>'Код направления',
            'code_discipline'=>'Индекс дисциплины',
            'description'=>'Тип дисциплины',
        ];
    }


    public function uploadDiscipline($disc) {
        $this->id_discipline = $disc['DISC_ID'];
        $this->id_plan = $disc["ED_PLAN_ID"];
        $this->name = $disc['DISC_NAME'];
        $this->semester = (int)$disc["HOURS_SEMESTR"];
        $this->date_start = $disc["ED_PLAN_START_DATE"];
        $this->department = $disc["DEP_NAME"];
        $this->direction = $disc["DIR_NAME"];
        $this->profile = $disc["PROF_NAME"];
        $this->status = 1;
        $this->short_department = $disc["ED_PLAN_DEPATMENT"];
        $this->lecture = (int)$disc["HOURS_LECTURES"];
        $this->practice = (int)$disc["HOURS_PRACTICE"];
        $this->lab = (int)$disc["HOURS_LAB"];
        $this->selfwork = (int)$disc["HOURS_KSR"];
        $this->lectureRemain = $this->lecture;
        $this->labRemain = $this->lab;
        $this->practiceRemain = $this->practice;
        $this->selfworkRemain = $this->selfwork;
        $this->control_t = (int)$disc["HOURS_CONTROL"];
        $this->is_exam = $disc["IS_EXAM"];
        $this->course = (int)$disc["COURSE_WORK"];
        $this->code_direction = $disc["DIR_ENCRYPTION"];
        $this->code_discipline = $disc["DISC_COMP_KEY"];
        $this->fulltime_contact = $this->lecture+$this->practice+$this->lab;
        $this->year = (int)substr($this->date_start, -2);
        $this->current_year = "20".$this->year." - "."20".($this->year+1);
        $this->fulltime = $this->fulltime_contact+$this->selfwork+$this->control_t;
        // $this->unit = $disc["IS_EXAM"];
        $this->zet = $disc['SH_WITH_ZET'];
        $this->unit = $this->zet/36;
        $this->pulpit_code = substr($this->code_discipline, 0, 4);
        if ($disc["QUALIFICATION_NAME"] == 'бакалавр') {
            $this->qualification = 'Бакалавриат';
        } elseif ($disc["QUALIFICATION_NAME"] == 'магистр') {
            $this->qualification = 'Магистратура';
        } elseif ($disc["QUALIFICATION_NAME"] == 'аспирант') {
            $this->qualification = 'Аспирантура';
        } elseif ($disc["QUALIFICATION_NAME"] == 'специалист') {
            $this->qualification = 'Специалитет';
        }

        if($this->is_exam == "0") {
            $this->control = "Зачет";
        } else {
            $this->control = "Экзамен";
        }
        $this->doc_file = $this->generateRpdName().'.docx';
        $this->pdf_file = $this->generateRpdName().'.pdf';

        $this->save(false);
        return true;
    }

    public function generateRpdName(){
        return $this->name.'_'.$this->current_year;
    }

public static function getDirections($qualification, $currentYear) {
    return Discipline::find()->select('direction')->distinct()->where(['qualification' => $qualification, 'year'=>$currentYear])->asArray()->all();
}

public function setEmploee($value, $title, $degree){
    $title = mb_strtolower($title[0]['ACD_NAME']);
    $this->developers=$degree[0]['ACD_NAME'].', '.$title.' '.$value['EMPL_FIRST_NAME'].' '.$value['EMPL_SECOND_NAME'].' '.$value['EMPL_PATRONYMIC'].'; ';

    $this->save(false);
}

public function createDir($status){
    if($status==2){
        $root = Yii::getAlias('@rpdcheck');
    } elseif ($status==3) {
        $root = Yii::getAlias('@rpdapproved');
    }

    if (!is_dir($root.'/'.$this->current_year)){
        mkdir($root.'/'.$this->current_year);
    }

    if (!is_dir($root.'/'.$this->current_year.'/'.$this->qualification)){
        mkdir($root.'/'.$this->current_year.'/'.$this->qualification);
    }

    if (!is_dir($root.'/'.$this->current_year.'/'.$this->qualification.'/'.$this->direction)){
        mkdir($root.'/'.$this->current_year.'/'.$this->qualification.'/'.$this->direction);
    }

    if (!is_dir($root.'/'.$this->current_year.'/'.$this->qualification.'/'.$this->direction.'/'.$this->course.' курс')){
        mkdir($root.'/'.$this->current_year.'/'.$this->qualification.'/'.$this->direction.'/'.$this->course.' курс');
    }

    return $root.'/'.$this->current_year.'/'.$this->qualification.'/'.$this->direction.'/'.$this->course.' курс';
}

public function isFileExist($status, $doc=null, $pdf=null){
    $path = $this->createDir($status);
    if($doc){
        $file = $path.'/'.$this->doc_file;
    } elseif ($pdf) {
        $file = $path.'/'.$this->pdf_file;
    }

    return file_exists($file);
}

public static function getDisciplines($year, $qualification, $direction, $course, $semester, $status=null) {
    if($status==4 || $status==null){
        return Discipline::find()->where(['direction'=>$direction, 'course'=>$course, 'semester'=>$semester, 'qualification' => $qualification, 'year' => $year])->asArray()->all();
    } else {
        return Discipline::find()->where(['direction'=>$direction, 'course'=>$course, 'semester'=>$semester, 'qualification' => $qualification, 'year' => $year, 'status'=>$status])->asArray()->all();
    }

}



public static function getSemesters($course, $qualification, $direction, $year, $status=null) {
    if($status==4 || $status==null){
        return Discipline::find()->select('semester')->distinct()->where(['direction'=>$direction, 'course'=>$course, 'year' =>$year, 'qualification' => $qualification])->orderby('semester')->asArray()->all();
    } else{
        return Discipline::find()->select('semester')->distinct()->where(['direction'=>$direction, 'course'=>$course, 'year' =>$year, 'qualification' => $qualification, 'status'=>$status])->orderby('semester')->asArray()->all();
    }

}


public static function getCountCourse($qualification) {
    $qualificationCourse = ["Бакалавриат" => 4, 'Магистратура' => 2, 'Специалитет' => 5, 'Аспирантура' => 4];
    foreach ($qualificationCourse as $q => $course) {
        if ($qualification === $q) {
            return $course;
        }
    }
}

public static function getDistinctDirection(){
    return ArrayHelper::map(Discipline::find()->select('direction')->distinct()->orderBy('direction')->all(), 'direction', 'direction');
}

public static function getYears(){
    return ArrayHelper::map(Discipline::find()->orderBy('year')->all(), 'year', 'current_year');
}

public static function getDistinctQualification(){
    return ArrayHelper::map(Discipline::find()->select('qualification')->distinct()->orderBy('qualification')->all(), 'qualification', 'qualification');
}

public static function getIndex($year, $qualification, $direction, $course, $semester, $status=null) {
    if($status==4 || $status==null){
        return Discipline::find()->select('code_discipline')->where(['direction'=>$direction, 'course'=>$course, 'semester'=>$semester, 'qualification' => $qualification, 'year' => $year])->all();
    } else {
        return Discipline::find()->select('code_discipline')->where(['direction'=>$direction, 'course'=>$course, 'semester'=>$semester, 'qualification' => $qualification, 'year' => $year, 'status'=>$status])->all();
    }
}

public static function getDistinctName(){
    return ArrayHelper::map(Discipline::find()->select('name')->distinct()->orderBy('name')->all(), 'name', 'name');
}


public function getCompetencyDisciplines()
    {
        return $this->hasMany(CompetencyDiscipline::className(), ['id_discipline' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['id_discipline' => 'id']);
    }


    public function getUserComments(){
         return $this->hasMany(User::className(), ['id' => 'id_user'])
            ->via('comments');
    }

public function getDistinctUser(){
    $users = $this->getUserComments();
    return ArrayHelper::map($users->all(), 'id', 'username');
}

public function getTeacherFiles()
{
    return $this->hasMany(TeacherFile::className(), ['discipline_id' => 'id']);
}

public function getSections()
{
    return $this->hasMany(Section::className(), ['id_discipline' => 'id']);
}

public function getClassrooms()
{
    return $this->hasMany(Classroom::className(), ['id_discipline' => 'id']);
}

public function getSoftwares()
{
    return $this->hasMany(Software::className(), ['id_discipline' => 'id']);
}

public function getSites()
{
    return $this->hasMany(Site::className(), ['id_discipline' => 'id']);
}

public function getEquipments()
{
    return $this->hasMany(Equipment::className(), ['id_discipline' => 'id']);
}

public function getLiteratures()
{
    return $this->hasMany(Literature::className(), ['id_discipline' => 'id']);
}

public function getBaseLiteratures(){
    return $this->getLiteratures()->where(['type'=>'base'])->all();
}

public function getAddLiteratures(){
    return $this->getLiteratures()->where(['type'=>'addition'])->all();
}


public function getExamCertifications()
{
    return $this->hasMany(TaskIntermediateCertification::className(), ['id_discipline' => 'id']);
}

public function getLabs()
{
    return $this->hasMany(LabWork::className(), ['id_discipline' => 'id']);
}

public function getCurrentCertifications()
{
    return $this->hasMany(CurrentCertification::className(), ['id_discipline' => 'id']);
}

public function getLabsThemeMapId() {
    return ArrayHelper::map($this->getLabs()->orderby('number')->all(), 'id', 'theme');
}

public function getPracticesThemeMapId() {
    return ArrayHelper::map($this->getPractices()->orderby('number')->all(), 'id', 'theme');
}

public function getPractices()
{
    return $this->hasMany(Practice::className(), ['id_discipline' => 'id']);
}

public function getCountOfSections() {
    return $this->getSections()->count();
}

public function getCountOfLabs() {
    return $this->getLabs()->count();
}

public function getCountOfPractices() {
    return $this->getPractices()->count();
}

public function updateLectureRemain($lecture_time, $action) {

    if($action) {
        $this->lectureRemain = $this->lectureRemain-$lecture_time;
    } else {
        $this->lectureRemain = $this->lectureRemain+$lecture_time;
    }

    $this->save(false);
}


public function updatePracticeRemain($practice_time, $action) {
    if($action) {
        $this->practiceRemain = $this->practiceRemain-$practice_time;
    } else {
        $this->practiceRemain = $this->practiceRemain+$practice_time;
    }
    $this->save(false);
}

public function updateLabRemain($lab_time, $action) {
    if($action){
        $this->labRemain = $this->labRemain-$lab_time;
    } else {
        $this->labRemain = $this->labRemain+$lab_time;
    }
    $this->save(false);
}

public function updateSelfworkRemain($selfwork_time, $action) {
    if($action) {
        $this->selfworkRemain = $this->selfworkRemain-$selfwork_time;
    } else {
        $this->selfworkRemain = $this->selfworkRemain+$selfwork_time;
    }
    
    $this->save(false);
}

public function getLectureRemain() {
    return $this->lectureRemain;
}

public function getPracticeRemain() {
    return $this->practiceRemain;
}

public function getLabRemain() {
    return $this->labRemain;
}

public function getSelfworkRemain() {
    return $this->selfworkRemain;
}

public function setAssessment(){
    $intermediate_assessment = new IntermediateAssessment();
    if($this->is_exam == 0){
        $intermediate_assessment->id_procedure = 1;

    } else {
        $intermediate_assessment->id_procedure = 2;
    }
    $intermediate_assessment->id_discipline = $this->id;
    $intermediate_assessment->save(false);
    $current_assessment = new CurrentAssessment();
    $current_assessment->id_discipline = $this->id;
    $current_assessment->id_procedure = 1;
    $current_assessment->save(false);
    $current_assessment = new CurrentAssessment();
    $current_assessment->id_discipline = $this->id;
    $current_assessment->id_procedure = 2;
    $current_assessment->save(false);
    $current_assessment = new CurrentAssessment();
    $current_assessment->id_discipline = $this->id;
    $current_assessment->id_procedure = 3;
    $current_assessment->save(false);
}

public function getIntermediateAssessment()
{
    return $this->hasOne(IntermediateAssessment::className(), ['id_discipline' => 'id']);
}

public function getCurrentAssessments()
{
    return $this->hasMany(CurrentAssessment::className(), ['id_discipline' => 'id']);
}

public function getCurrentProcedures() {
    return $this->hasMany(CurrentProcedure::className(), ['id'=>'id_procedure'])->via('currentAssessments');
}

public function getDurationControls() {
    return $this->hasMany(DurationControl::className(), ['id'=>'id_duration_control'])->via('currentAssessments');
    }

    public function getFormCurrentControls() {
        return $this->hasMany(FormCurrentControl::className(), ['id'=>'id_form_current_control'])->via('currentAssessments');
    }

    public function getFormIntermediateControls() {
        return $this->hasMany(FormIntermediateControl::className(), ['id'=>'id_form_intermediate_control'])->via('currentAssessments');
    }

    public function getHandouts() {
        return $this->hasMany(Handout::className(), ['id'=>'id_handout'])->via('currentAssessments');
    }

    public function getTypeVerificationTasks() {
        return $this->hasMany(TypeVerificationTask::className(), ['id'=>'id_type_verification_task'])->via('currentAssessments');
    }

    public function getFormReports() {
        return $this->hasMany(FormReport::className(), ['id'=>'id_form_report'])->via('currentAssessments');
    }

}
