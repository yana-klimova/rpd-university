<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Section;

/**
 * SectionSearch represents the model behind the search form of `common\models\Section`.
 */
class SectionSearch extends Section
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number', 'lection_time', 'practice_time', 'lab_time', 'selfwork_time', 'full_time_contact', 'full_time', 'id_discipline'], 'integer'],
            [['name', 'content'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Section::find();

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
            'number' => $this->number,
            'lection_time' => $this->lection_time,
            'practice_time' => $this->practice_time,
            'lab_time' => $this->lab_time,
            'selfwork_time' => $this->selfwork_time,
            'full_time_contact' => $this->full_time_contact,
            'full_time' => $this->full_time,
            'id_discipline' => $this->id_discipline,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
