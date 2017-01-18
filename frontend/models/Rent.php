<?php

namespace frontend\models;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "rent".
 *
 * @property integer $id
 * @property string $name
 * @property string $near
 * @property string $intendant
 * @property integer $cost_water
 * @property integer $cost_elec
 * @property string $tel1
 * @property string $tel2
 * @property string $web
 * @property string $type_gen
 * @property string $type_rent
 * @property integer $user_id
 * @property string $condition
 * @property string $edited
 * @property Fav[] $favs
 * @property User $user
 * @property Address $address
 * @property Room[] $rooms
  * @property double $lat
 * @property double $long
 */
class Rent extends \yii\db\ActiveRecord
{
	
	public $province,$amphur_id,$district_id;
	public $upload_ajax;
	
	const UPLOAD_FOLDER ='photoDorm';
	public static function itemAlias($key){
		$item = [
				'accessories'=>[
						1=>'เตียง',
						2=>'ตู้เสื้อผ้า',
						3=>'ทีวี',
						4=>'เครื่องทำน้ำอุ่น',
						5=>'พัดลม',
						6=>'แอร์',
						7=>'โต๊ะทำงาน',
						9=>'ระเบียง',
						10=>'ที่จอดรถจักรยานยนต์',
						11=>'ที่จอดรถยนต์'
				]
				
		];
	}
	/**
	 * @inheritdoc
	 */
	public static function getUploadPath(){
		return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
	}
	
	public static function getUploadUrl(){
		return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
	}
		
	public function getThumbnails($id){
		$uploadFiles   = Uploads::find()->where(['rent_id'=>$id])->all();
		$preview = [];
		foreach ($uploadFiles as $file) {
			$preview[] = [
					'url'=>self::getUploadUrl(true).$id.'/'.$file->real_filename,
					'src'=>self::getUploadUrl(true).$id.'/thumbnail/'.$file->real_filename,
					
			];
		}
		
		/* print_r($preview);
		die(); */
		return $preview;
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cost_water', 'cost_elec', 'user_id', 'province','address_id' ], 'integer'],
            [['condition'], 'string'],
            [['edited'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['near', 'web'], 'string', 'max' => 150],
            [['lat', 'long'], 'number'],
            [['intendant'], 'string', 'max' => 250],
            [['tel1', 'tel2'], 'string', 'max' => 11],
            [['type_gen', 'type_rent'], 'string', 'max' => 50],
        	[['upload_ajax'], 'safe'],
        	[['upload_ajax'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อหอพัก',
            'near' => 'ใกล้เคียงจุดสำคัญ',
            'intendant' => 'ผู้ดูแล',
            'cost_water' => 'ค่าน้ำ',
            'cost_elec' => 'ค่าไฟ',
            'tel1' => 'เบอร์โทร',
            'tel2' => 'เบอร์โทร',
            'web' => 'เว็บไซต์',
            'type_gen' => 'ประเภทหอพัก',
            'type_rent' => 'ประเภทการเช่าพัก',
            'user_id' => 'User ID',         
            'condition' => 'Condition',
            'edited' => 'Edited',
        	'province'=>'จังหวัด',
        	'amphur'=>'อำเภอ',
        	'district'=>'ตำบล',
        	'q'=>'ช่วงราคา'
        ];
    }





    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavs()
    {
        return $this->hasMany(Fav::className(), ['rent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['rent_id' => 'id']);
    }
    
    public function getRoomsByPrice($price)
    {
    	return $this->hasMany(Room::className(), ['rent_id' => 'id'])
    	->andOnCondition(['cost'=>$price]);
    }
    
    public function getNumrooms()
    {
    	return $this->hasMany(Room::className(), ['rent_id' => 'id'])->count();
    }
    
    public function getNumroomsavailable()
    {
    	return $this->hasMany(Room::className(), ['rent_id' => 'id'])
    	->andOnCondition(['status' => [1,2] ])
    	
    	->count();
    }
    
    


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentHasAccessories()
    {
    	return $this->hasMany(RentHasAccessories::className(), ['rent_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentHasAccessory()
    {
    	return $this->hasOne(RentHasAccessories::className(), ['rent_id' => 'id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploads()
    {
    	return $this->hasMany(Uploads::className(), ['rent_id' => 'id']);
    }
    
    public function getImage()
    {
    	$uploads = $this->uploads;
    	if ($uploads){
    	foreach ($uploads as $upload){
    		$img = $upload->real_filename;
    		break;
    	}
    	return $img;
    	}else return null;
    	
    }
    public function getAccessories()
    {
    	return self::itemAlias('accessories');
    }
    
    
    /**
     * @inheritdoc
     * @return RentQuery the active query used by this AR class.
     */
    public static function find()
    {
    	return new RentQuery(get_called_class());
    }
}
