<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\ControlKnow;
use common\models\TypeControl;

/**
 * This is the model class for table "know".
 *
 * @property int $id
 * @property string $know
 * @property int $id_competency_discipline
 *
 * @property ControlKnow[] $controlKnows
 * @property CompetencyDiscipline $competencyDiscipline
 */
class Know extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'know';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_competency_discipline'], 'required'],
            [['know'], 'string'],
            [['id_competency_discipline'], 'default', 'value' => null],
            [['id_competency_discipline'], 'integer'],
            [['id_competency_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => CompetencyDiscipline::className(), 'targetAttribute' => ['id_competency_discipline' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'know' => 'Знать',
            'id_competency_discipline' => 'Id Competency Discipline',
        ];
    }


    public function saveCompetencyKnow($competency) {
        $this->id_competency_discipline = $competency->id;
        $this->save(false);
    }

    public function getControls() {
        return $this->hasMany(TypeControl::className(), ['id' => 'id_type_control'])->viaTable('control_know', ['id_know' => 'id']);
    }

    public function getSelectedControls() {
        return ArrayHelper::getColumn($this->getControls()->select('id')->asArray()->all(), 'id');
    }

     public function saveControls($controls) {
        if (isset($controls))
        {
            ControlKnow::deleteAll(['id_know'=>$this->id]);
            foreach ($controls as $control_id) {
                $control = TypeControl::findOne($control_id);
                $this->link('controls', $control);
            }
        } else {
            ControlKnow::deleteAll(['id_know'=>$this->id]);
        }
    }
}
