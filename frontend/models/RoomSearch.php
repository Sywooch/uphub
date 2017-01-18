<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Room;

/**
 * RoomSearch represents the model behind the search form about `frontend\models\Room`.
 */
class RoomSearch extends Room
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numFloor', 'room', 'cost', 'type_pay', 'insurance', 'rent_id', 'user_id','status'], 'integer'],
            [['status', 'start_date', 'end_date'], 'safe'],
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
        $query = Room::find();

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
            'numFloor' => $this->numFloor,
            'room' => $this->room,
            'cost' => $this->cost,
            'type_pay' => $this->type_pay,
            'insurance' => $this->insurance,
            'rent_id' => $this->rent_id,
            'user_id' => $this->user_id,
        	'code' => $this->code,
        	'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date]);

        return $dataProvider;
    }
}
