<?php

namespace frontend\models;

use Yii;
use yii\helpers\Url;
use frontend\models\Province;


/**
 * This is the model class for table "albumn".
 *
 * @property integer $id
 * @property string $ref
 * @property string $event_name
 * @property string $detail
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property string $customer_name
 * @property string $customer_mobile_phone
 * @property integer $province_id
 *
 * @property Rent[] $rents
 * @property Uploads[] $uploads
 */
class Albumn extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER ='photoDorm';
    /**
     * @inheritdoc
     */
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
    
    public function getProvince()
    {
    	return $this->hasOne(Province::className(),['PROVINCE_ID'=>'province_id']);
    }
    public static function tableName()
    {
        return 'albumn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],            [['start_date', 'end_date'], 'safe'],

            [['province_id'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['event_name', 'location'], 'string', 'max' => 255],
            [['customer_name'], 'string', 'max' => 150],
            [['customer_mobile_phone'], 'string', 'max' => 20],            [['ref'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'เลข fk กับ upload ใช้กับ upload ajax',
            'event_name' => 'ชื่องาน',
            'detail' => 'รายละเอียด',
            'start_date' => 'วันที่เริ่มถ่ายภาพ',
            'end_date' => 'วันที่ถ่ายภาพเสร็จ',
            'location' => 'สถานที่',
            'customer_name' => 'ชื่อลูกค้า',
            'customer_mobile_phone' => 'เบอร์โทร',
            'province_id' => 'Province ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRents()
    {
        return $this->hasMany(Rent::className(), ['albumn_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploads()
    {
        return $this->hasMany(Uploads::className(), ['albumn_id' => 'id']);
    }
}
