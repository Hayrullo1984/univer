<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsIlmunvon;

/**
 * UsIlmunvonSearch represents the model behind the search form of `common\models\UsIlmunvon`.
 */
class UsIlmunvonSearch extends UsIlmunvon
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEUNVON', 'SHORTNAMEUNVON'], 'safe'],
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
        $query = UsIlmunvon::find();

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
            'IDLANG' => $this->IDLANG,
            'IDALIFBO' => $this->IDALIFBO,
        ]);

        $query->andFilterWhere(['like', 'NAMEUNVON', $this->NAMEUNVON])
            ->andFilterWhere(['like', 'SHORTNAMEUNVON', $this->SHORTNAMEUNVON]);

        return $dataProvider;
    }
}
