<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Discipline;

/**
 * DisciplineSearch represents the model behind the search form of `common\models\Discipline`.
 */
class DisciplineSearch extends Discipline
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'semester', 'year', 'lecture', 'practice', 'lab', 'selfwork', 'control_t', 'fulltime_contact', 'fulltime', 'unit', 'course', 'status'], 'integer'],
            [['name', 'department', 'direction', 'profile', 'qualification', 'form_study', 'short_department', 'control', 'code_direction', 'code_discipline', 'description', 'current_year', 'program', 'zet'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Discipline::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'department', $this->department])
            ->andFilterWhere(['ilike', 'direction', $this->direction])
            ->andFilterWhere(['ilike', 'profile', $this->profile])
            ->andFilterWhere(['ilike', 'qualification', $this->qualification])
            ->andFilterWhere(['ilike', 'code_discipline', $this->code_discipline])
            ->andFilterWhere(['=', 'semester', $this->semester])
            ->andFilterWhere(['=', 'status', $this->status])
            ->andFilterWhere(['=', 'year', $this->year])
            ->andFilterWhere(['ilike', 'control', $this->control]);

        return $dataProvider;
    }
}
