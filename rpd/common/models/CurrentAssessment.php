<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assessment_tool".
 *
 * @property int $id
 * @property int $id_discipline
 * @property int $id_procedure
 * @property int $id_duration_control
 * @property int $id_form_current_control
 * @property int $id_form_intermediate_control
 * @property int $id_handout
 * @property int $id_type_verification_task
 * @property int $id_form_report
 *
 * @property Discipline $discipline
 * @property DurationControl $durationControl
 * @property FormCurrentControl $formCurrentControl
 * @property FormIntermediateControl $formIntermediateControl
 * @property FormReport $formReport
 * @property Handout $handout
 * @property Procedure $procedure
 * @property TypeVerificationTask $typeVerificationTask
 */
class CurrentAssessment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'current_assessment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['id_discipline', 'id_procedure', 'id_duration_control', 'id_form_current_control', 'id_handout', 'id_type_verification_task', 'id_form_report'], 'integer'],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::className(), 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_duration_control'], 'exist', 'skipOnError' => true, 'targetClass' => DurationControl::className(), 'targetAttribute' => ['id_duration_control' => 'id']],
            [['id_form_current_control'], 'exist', 'skipOnError' => true, 'targetClass' => FormCurrentControl::className(), 'targetAttribute' => ['id_form_current_control' => 'id']],
            [['id_form_report'], 'exist', 'skipOnError' => true, 'targetClass' => FormReport::className(), 'targetAttribute' => ['id_form_report' => 'id']],
            [['id_handout'], 'exist', 'skipOnError' => true, 'targetClass' => Handout::className(), 'targetAttribute' => ['id_handout' => 'id']],
            [['id_procedure'], 'exist', 'skipOnError' => true, 'targetClass' => CurrentProcedure::className(), 'targetAttribute' => ['id_procedure' => 'id']],
            [['id_type_verification_task'], 'exist', 'skipOnError' => true, 'targetClass' => TypeVerificationTask::className(), 'targetAttribute' => ['id_type_verification_task' => 'id']],
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
            'id_procedure' => 'Процедура проведения',
            'id_duration_control' => 'Продолжительность контроля',
            'id_form_current_control' => 'Форма проведения контроля',
            'id_handout' => 'Раздаточный материал',
            'id_type_verification_task' => 'Вид проверочного задания',
            'id_form_report' => 'Форма отчета',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::className(), ['id' => 'id_discipline']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDurationControl()
    {
        return $this->hasOne(DurationControl::className(), ['id' => 'id_duration_control']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormCurrentControl()
    {
        return $this->hasOne(FormCurrentControl::className(), ['id' => 'id_form_current_control']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormReport()
    {
        return $this->hasOne(FormReport::className(), ['id' => 'id_form_report']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHandout()
    {
        return $this->hasOne(Handout::className(), ['id' => 'id_handout']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcedure()
    {
        return $this->hasOne(CurrentProcedure::className(), ['id' => 'id_procedure']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeVerificationTask()
    {
        return $this->hasOne(TypeVerificationTask::className(), ['id' => 'id_type_verification_task']);
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
}
