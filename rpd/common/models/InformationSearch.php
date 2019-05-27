<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Information;

/**
 * InformationSearch represents the model behind the search form of `common\models\Information`.
 */
class InformationSearch extends Information
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'for_teacher', 'for_organizer'], 'boolean'],
            [['title', 'description', 'content', 'date'], 'safe'],
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
        $query = Information::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'date'=>[
                    'asc'=>['date'=>SORT_ASC],
                    'desc'=>['date'=>SORT_DESC]
                ]
            ]
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
            // 'date' => $this->date,
            // 'status' => $this->status,
            // 'for_teacher' => $this->for_teacher,
            // 'for_organizer' => $this->for_organizer,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'content', $this->content])
            ->andFilterWhere(['=', 'status', $this->status])
            ->andFilterWhere(['=', 'for_teacher', $this->for_teacher])
            ->andFilterWhere(['=', 'for_organizer', $this->for_organizer]);

        return $dataProvider;
    }
}
