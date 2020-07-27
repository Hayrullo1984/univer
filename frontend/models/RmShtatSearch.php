<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RmShtat;

/**
 * RmShtatSearch represents the model behind the search form of `common\models\RmShtat`.
 */
class RmShtatSearch extends RmShtat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'IDBUDKONT', 'IDMARKAZ', 'IDBULUM', 'IDLAVOZIM', 'IDUNVON', 'IDDARAJA', 'IDRAZRYAD', 'IDUSTAMA', 'YNL', 'IDORG', 'IDUSER'], 'integer'],
            [['BIRLIKSONI', 'JAMI'], 'number'],
            [['IZOH', 'INSDATE'], 'safe'],
            [['IDUSTAMA'],'integer'],
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
        $query = RmShtat::find();

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
            'IDBUDKONT' => $this->IDBUDKONT,
            'IDMARKAZ' => $this->IDMARKAZ,
            'IDBULUM' => $this->IDBULUM,
            'IDLAVOZIM' => $this->IDLAVOZIM,
            'IDUNVON' => $this->IDUNVON,
            'IDDARAJA' => $this->IDDARAJA,
            'BIRLIKSONI' => $this->BIRLIKSONI,
            'IDRAZRYAD' => $this->IDRAZRYAD,
            'IDUSTAMA' => $this->IDUSTAMA,
            'JAMI' => $this->JAMI,
            'YNL' => $this->YNL,
            'IDORG' => $this->IDORG,
            'IDUSER' => $this->IDUSER,
        ]);

        $query->andFilterWhere(['like', 'IZOH', $this->IZOH])
            ->andFilterWhere(['like', 'INSDATE', $this->INSDATE]);

        return $dataProvider;
    }
}
