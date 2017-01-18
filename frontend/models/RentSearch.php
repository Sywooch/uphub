<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Rent;

/**
 * RentSearch represents the model behind the search form about `frontend\models\Rent`.
 */
class RentSearch extends Rent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cost_water', 'cost_elec', 'user_id', ], 'integer'],
            [['name', 'near', 'intendant', 'tel1', 'tel2', 'web', 'type_gen', 'type_rent', 'condition', 'edited'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Rent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cost_water' => $this->cost_water,
            'cost_elec' => $this->cost_elec,
            'user_id' => $this->user_id,
            
            'edited' => $this->edited,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'near', $this->near])
            ->andFilterWhere(['like', 'intendant', $this->intendant])
            ->andFilterWhere(['like', 'tel1', $this->tel1])
            ->andFilterWhere(['like', 'tel2', $this->tel2])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'type_gen', $this->type_gen])
            ->andFilterWhere(['like', 'type_rent', $this->type_rent])
            ->andFilterWhere(['like', 'condition', $this->condition]);

        return $dataProvider;
    }
}
