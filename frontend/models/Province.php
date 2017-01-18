<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%province}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $geoid
 *
 * @property Amphur[] $amphurs
 * @property Geography $geo
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%province}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['geoid'], 'integer'],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'geoid' => 'Geoid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmphurs()
    {
    	$datas = Amphur::find()->where(['province_id'=>$id])->all();
    	return $this->MapData($datas,'id','name');
        //return $this->hasMany(Amphur::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeo()
    {
        return $this->hasOne(Geography::className(), ['id' => 'geoid']);
    }
    
    public function getFull()
    {
    	$address = "";
    	$address .= " จังหวัด ".$this->name;
    	return $address;
    }

    /**
     * @inheritdoc
     * @return ProvinceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProvinceQuery(get_called_class());
    }
}
