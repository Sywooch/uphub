<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Albumn;

/**
 * AlbumnSearch represents the model behind the search form about `frontend\models\Albumn`.
 */
class AlbumnSearch extends Albumn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ref', 'event_name', 'detail', 'start_date', 'end_date', 'location', 'province', 'customer_name', 'customer_mobile_phone'], 'safe'],
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
        $query = Albumn::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'customer_mobile_phone', $this->customer_mobile_phone]);
        return $dataProvider;
    }
}