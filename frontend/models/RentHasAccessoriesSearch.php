<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RentHasAccessories;

/**
 * RentHasAccessoriesSearch represents the model behind the search form about `frontend\models\RentHasAccessories`.
 */
class RentHasAccessoriesSearch extends RentHasAccessories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rent_id', 'accessories_id'], 'integer'],
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
        $query = RentHasAccessories::find();

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
            'rent_id' => $this->rent_id,
            'accessories_id' => $this->accessories_id,
        ]);

        return $dataProvider;
    }
}
