<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\ControlCan;
use common\models\TypeControl;
/**
 * This is the model class for table "can".
 *
 * @property int $id
 * @property string $can
 * @property int $id_competency_discipline
 *
 * @property CompetencyDiscipline $competencyDiscipline
 * @property ControlCan[] $controlCans
 */
class Can extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'can';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_competency_discipline'], 'required'],
            [['can'], 'string'],
            [['id_competency_discipline'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'can' => 'Уметь',
            'id_competency_discipline' => 'Компетенция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompetencyDiscipline()
    {
        return $this->hasOne(CompetencyDiscipline::className(), ['id' => 'id_competency_discipline']);
    }

    public function saveCompetencyCan($competency) {
        $this->id_competency_discipline = $competency->id;
        $this->save(false);
    }

    public function getControls() {
        return $this->hasMany(TypeControl::className(), ['id' => 'id_type_control'])->viaTable('control_can', ['id_can' => 'id']);
    }

    public function getSelectedControls() {
        return ArrayHelper::getColumn($this->getControls()->select('id')->asArray()->all(), 'id');
    }

    public function saveControls($controls) {
        if (isset($controls))
        {
            ControlCan::deleteAll(['id_can'=>$this->id]);
            foreach ($controls as $control_id) {
                $control = TypeControl::findOne($control_id);
                $this->link('controls', $control);
            }
        } else {
            ControlCan::deleteAll(['id_can'=>$this->id]);
        }
    }
}
