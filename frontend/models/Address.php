<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $number
 * @property string $moo
 * @property integer $district_id
 *
 * @property District $district
 * @property Rent[] $rents
 */
class Address extends \yii\db\ActiveRecord
{
	public $province_id,$amphur_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id','amphur_id','province_id'], 'integer'],
            [['number'], 'string', 'max' => 10],
            [['moo'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'เลขที่'),
            'moo' => Yii::t('app', 'หมู่'),
            'district_id' => Yii::t('app', 'ตำบล'),
        	'amphur_id' => Yii::t('app', 'อำเภอ'),
        	'province_id' => Yii::t('app', 'จังหวัด'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }
    
    public function getListProvince()
    {
    	return Province::find()->all();
    }
    
    public function getListAmphur()
    {
    	return Amphur::findAll(['province_id'=>$this->district->amphur->province_id ]);
    }
    
    public function getListDistrict()
    {
    	return District::findAll(['amphur_id'=>$this->district->amphur_id ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasOne(Rent::className(), ['address_id' => 'id']);
    }
    
    public function getFull()
    {
    	$address = "";
    	$address .= empty(trim($this->number))?"":"บ้านเลขที่ ".$this->number;
    	$address .= empty(trim($this->moo))?"":" หมู่ ".$this->moo;
    	$address .= $this->district?$this->district->full:"";
    	return $address;
    }
}
