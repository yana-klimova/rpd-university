<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form of `common\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
    /**
     * {@inheritdoc}
     */
    public $userEmail;
    public function rules()
    {

        return [
            [['item_name'], 'safe'],
            [['userEmail'], 'string'],
            [['created_at'], 'safe'],
            [['user_id'], 'safe']
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
        $query = AuthAssignment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

        ]);

        $query->andFilterWhere(['ilike', 'item_name', $this->item_name])
            ->andFilterWhere(['=', 'user_id', $this->user_id])
            ->andFilterWhere(['ilike', 'created_at', $this->created_at]);

        $query->joinWith(['user' => function ($q) {
        $q->andFilterWhere(['ilike', 'user.email', $this->userEmail]);
    }]);
 

        return $dataProvider;
    }
}
