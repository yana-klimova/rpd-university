<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaskIntermediateCertification;

/**
 * TaskIntermediateCertificationSearch represents the model behind the search form of `common\models\TaskIntermediateCertification`.
 */
class TaskIntermediateCertificationSearch extends TaskIntermediateCertification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_discipline'], 'integer'],
            [['tasks'], 'safe'],
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
        $query = TaskIntermediateCertification::find();

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
            'id_discipline' => $this->id_discipline,
        ]);

        $query->andFilterWhere(['ilike', 'tasks', $this->tasks]);

        return $dataProvider;
    }
}
