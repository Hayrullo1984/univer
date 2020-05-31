<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Preparation;

/**
 * PreparationSearch represents the model behind the search form of `common\models\Preparation`.
 */
class PreparationSearch extends Preparation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['food_id', 'thing_id'],'safe'],
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
        $query = Preparation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('food');
        $query->joinWith('thing');
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
        $query->andFilterWhere([
            'like','food.name',$this->food_id 
        ])
        ->andFilterWhere([
            'like','thing.name',$this->thing_id
        ]);


        return $dataProvider;
    }
}
