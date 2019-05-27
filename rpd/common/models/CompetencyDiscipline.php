<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "competency_discipline".
 *
 * @property int $id
 * @property int $id_code
 * @property int $id_discipline
 *
 * @property Can[] $cans
 * @property Competency $code
 * @property Discipline $discipline
 * @property Know[] $knows
 * @property Own[] $owns
 */
class CompetencyDiscipline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'competency_discipline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_discipline'], 'default', 'value' => null],
            [['id_discipline'], 'integer'],
            [['id_discipline', 'code', 'description'], 'required'],
            [['description'], 'string'],
            [['code'], 'string'],
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
            'code' => 'Code',
            'id_discipline' => 'Id Discipline',
            'description' => 'description'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function uploadCompetency($value, $id_discipline) {
        $this->code = $value["COMP_NAME"];
        $this->description = $value["COMP_DESCR"];
        $this->id_discipline = $id_discipline;
        $this->save(false);
    }

    public function getCan()
    {
        return $this->hasOne(Can::className(), ['id_competency_discipline' => 'id']);
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
    public function getKnow()
    {
        return $this->hasOne(Know::className(), ['id_competency_discipline' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwn()
    {
        return $this->hasOne(Own::className(), ['id_competency_discipline' => 'id']);
    }
}
