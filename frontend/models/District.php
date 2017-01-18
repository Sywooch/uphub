<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%district}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $amphur_id
 *
 * @property Amphur $amphur
 * @property Zipcode[] $zipcodes
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['amphur_id'], 'integer'],
            [['code'], 'string', 'max' => 6],
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
            'code' => 'Code',
            'name' => 'Name',
            'amphur_id' => 'Amphur ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmphur()
    {
        return $this->hasOne(Amphur::className(), ['id' => 'amphur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZipcodes()
    {
        return $this->hasMany(Zipcode::className(), ['district_id' => 'id']);
    }
    
    public function getFull()
    {
    	$address = "";
    	$address .= " ตำบล ".$this->name;
    	$address .= $this->amphur->full;
    	return $address;
    }
}
