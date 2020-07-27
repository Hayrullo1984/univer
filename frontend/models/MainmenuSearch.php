<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mainmenu;

/**
 * MainmenuSearch represents the model behind the search form of `common\models\Mainmenu`.
 */
class MainmenuSearch extends Mainmenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'POSITION', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEMMENU','URL'], 'safe'],
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
        $query = Mainmenu::find();

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
            'POSITION' => $this->POSITION,
            'IDLANG' => $this->IDLANG,
            'IDALIFBO' => $this->IDALIFBO,
        ]);

        $query->andFilterWhere(['like', 'NAMEMMENU', $this->NAMEMMENU]);

        return $dataProvider;
    }
}
