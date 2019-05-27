<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\ControlOwn;
use common\models\TypeControl;

/**
 * This is the model class for table "own".
 *
 * @property int $id
 * @property string $own
 * @property int $id_competency_discipline
 *
 * @property ControlOwn[] $controlOwns
 * @property CompetencyDiscipline $competencyDiscipline
 */
class Own extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'own';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_competency_discipline'], 'required'],
            [['own'], 'string'],
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
            'own' => 'Владеть',
            'id_competency_discipline' => 'Id Competency Discipline',
        ];
    }



    public function saveCompetencyOwn($competency) {
        $this->id_competency_discipline = $competency->id;
        $this->save(false);
    }

    public function getControls() {
        return $this->hasMany(TypeControl::className(), ['id' => 'id_type_control'])->viaTable('control_own', ['id_own' => 'id']);
    }
    public function getSelectedControls() {
        return ArrayHelper::getColumn($this->getControls()->select('id')->asArray()->all(), 'id');
    }

    public function saveControls($controls) {

        if (isset($controls))
        {
            ControlOwn::deleteAll(['id_own'=>$this->id]);
            foreach ($controls as $control_id) {
                $control = TypeControl::findOne($control_id);
                $this->link('controls', $control);
            }
        } else {
            ControlOwn::deleteAll(['id_own'=>$this->id]);
        }
    }
}
