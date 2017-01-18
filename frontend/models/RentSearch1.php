<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Rent;

/**
 * RentSearch represents the model behind the search form about `frontend\models\Rent`.
 */
class RentSearch1 extends Rent
{
	public $q;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cost_water', 'cost_elec', 'user_id', ], 'integer'],
            [['name', 'near', 'intendant', 'tel1', 'tel2', 'web', 'type_gen', 'type_rent', 'condition', 'edited','q'], 'safe'],
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
    	
    	
    	$query = Rent::find()->joinWith(['rooms'])->distinct();
    	
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
        	
            return $dataProvider;
        }
        
        
        
       if ( !empty($this->name)) 
       	$query->andFilterWhere(['like', 'rent.name', $this->name]);
       
        	if ( !empty($this->type_gen)) 
       	$query->andFilterWhere(['like', 'rent.type_gen', $this->type_gen]);
        	
            if ( !empty($this->near)) 
       	$query->andFilterWhere(['like', 'rent.near', $this->near]); 
            
       	if ( !empty($this->q)){
       		//$query->andFilterWhere(['>=', 'room.cost', $this->q]);
       	
       		
       		$cost=$this->q;
       		if ($cost==0) {
       			$query->andFilterWhere(['between', 'room.cost', "0", "1000"/* , $this->q */]);
       		}
       		if ($cost==1) {
       			$query->andFilterWhere(['between', 'room.cost', "1001", "2000"/* , $this->q */]);
       		}
       		if ($cost==2) {
       			$query->andFilterWhere(['between', 'room.cost', "2001", "3000"/* , $this->q */]);
       		}
       		if ($cost==3) {
       			$query->andFilterWhere(['between', 'room.cost', "3001", "4000"/* , $this->q */]);
       		}
       		if ($cost==4) {
       			$query->andFilterWhere(['>', 'room.cost', "4001"/* , $this->q */]);
       		}
       	}

        return $dataProvider;
    }
}
