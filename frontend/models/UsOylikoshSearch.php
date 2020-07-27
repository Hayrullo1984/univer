<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsOylikosh;

/**
 * UsOylikoshSearch represents the model behind the search form of `common\models\UsOylikosh`.
 */
class UsOylikoshSearch extends UsOylikosh
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'IDRAZRYAD','YNL'], 'integer'],
            [['OKLAD', 'FOIZ', 'NEWOKLAD'], 'number'],
            [['SANA'], 'safe'],
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
        $query = UsOylikosh::find();

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
            'ID' => $this->ID,
            'IDRAZRYAD' => $this->IDRAZRYAD,
            'OKLAD' => $this->OKLAD,
            'FOIZ' => $this->FOIZ,
            'NEWOKLAD' => $this->NEWOKLAD,
        ]);

        $query->andFilterWhere(['like', 'SANA', $this->SANA]);

        return $dataProvider;
    }
}
