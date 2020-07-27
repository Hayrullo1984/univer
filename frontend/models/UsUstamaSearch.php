<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsUstama;

/**
 * UsUstamaSearch represents the model behind the search form of `common\models\UsUstama`.
 */
class UsUstamaSearch extends UsUstama
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'IDLAVOZIM', 'USTAMA'], 'integer'],
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
        $query = UsUstama::find();

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
            'IDLAVOZIM' => $this->IDLAVOZIM,
            'SANA' => $this->SANA,
            'USTAMA' => $this->USTAMA,
        ]);

        return $dataProvider;
    }
}
