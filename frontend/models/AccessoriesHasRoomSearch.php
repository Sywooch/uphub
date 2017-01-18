<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AccessoriesHasRoom;

/**
 * AccessoriesHasRoomSearch represents the model behind the search form about `frontend\models\AccessoriesHasRoom`.
 */
class AccessoriesHasRoomSearch extends AccessoriesHasRoom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'accessories_id', 'room_id'], 'integer'],
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
        $query = AccessoriesHasRoom::find();

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
            'accessories_id' => $this->accessories_id,
            'room_id' => $this->room_id,
        ]);

        return $dataProvider;
    }
}
