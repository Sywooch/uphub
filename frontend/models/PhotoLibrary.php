<?php

namespace frontend\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "photo_library".
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
 */
class PhotoLibrary extends \yii\db\ActiveRecord
{
	public $rent_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_library';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['event_name', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rent_id' => 'หอพัก',
            'event_name' => 'Event Name',
            'detail' => 'Detail',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'location' => 'Location',

        ];
    }
    const UPLOAD_FOLDER='photoDorm';
    
    // ..........
    
    public static function getUploadPath(){
    	return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    
    public static function getUploadUrl(){
    	/* print_r(Url::base(true).'/'.self::UPLOAD_FOLDER.'/');
    	die(); */
    	return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    	
    }
    
    public function getThumbnails($id,$event_name){
    	$uploadFiles   = Uploads::find()->where(['rent_id'=>$id])->all();
    	$preview = [];
    	foreach ($uploadFiles as $file) {
    		$preview[] = [
    				'url'=>self::getUploadUrl(true).$id.'/'.$file->real_filename,
    				'src'=>self::getUploadUrl(true).$id.'/thumbnail/'.$file->real_filename,
    				'options' => ['title' => $event_name]
    		];
    	}
    	return $preview;
    }
}
