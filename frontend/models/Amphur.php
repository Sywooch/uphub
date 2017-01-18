<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%amphur}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province_id
 *
 * @property Province $province
 * @property District[] $districts
 */
class Amphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%amphur}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['province_id'], 'integer'],
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
            'province_id' => 'Province ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
    	$datas = District::find()->where(['amphur_id'=>$id])->all();
    	return $this->MapData($datas,'id','name');
        //return $this->hasMany(District::className(), ['amphur_id' => 'id']);
    }
    
    public function getFull()
    {
    	$address = "";
    	$address .= " อำเภอ ".$this->name;
    	$address .= $this->province->full;
    	return $address;
    }
}
