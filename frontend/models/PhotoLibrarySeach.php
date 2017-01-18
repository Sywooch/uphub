<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PhotoLibrary;

/**
 * PhotoLibary represents the model behind the search form about `frontend\models\PhotoLibrary`.
 */
class PhotoLibrarySeach extends PhotoLibrary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ref', 'event_name', 'detail', 'start_date', 'end_date', 'location', ], 'safe'],
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
        $query = PhotoLibrary::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,

        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'location', $this->location])


       return $dataProvider;
    }


    const UPLOAD_FOLDER='photolibrarys';
    
    // ..........
    
    public static function getUploadPath(){
    	return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    
    public static function getUploadUrl(){
    	return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    
    public function getThumbnails($ref,$event_name){
    	$uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
    	$preview = [];
    	foreach ($uploadFiles as $file) {
    		$preview[] = [
    				'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
    				'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
    				'options' => ['title' => $event_name]
    		];
    	}
    	return $preview;
    }
    
    
}
