<?php

namespace frontend\models;
use yii\base\Model;
use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property integer $numFloor
 * @property integer $room
 * @property string $status
 * @property integer $cost
 * @property integer $type_pay
 * @property integer $insurance
 * @property string $start_date
 * @property string $end_date
 * @property integer $rent_id
 * @property integer $user_id
 *
 * @property AccessoriesHasRoom[] $accessoriesHasRooms
 * @property User $user
 * @property Rent $rent
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numFloor', 'room', 'cost', 'type_pay', 'insurance', 'rent_id', 'user_id','status',], 'integer'],
            [['rent_id'], 'required'],
            [['start_date', 'end_date'], 'string', 'max' => 45],
        	[['name', 'id_card','tel'], 'string']
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numFloor' => Yii::t('app', 'ชั้น'),
            'room' => Yii::t('app', 'เลขห้อง'),
            'status' => Yii::t('app', 'สถานะห้องพัก'),
            'cost' => Yii::t('app', 'ราคา'),
            'type_pay' => Yii::t('app', 'ประเภทการชำระเงิน'),
            'insurance' => Yii::t('app', 'ค่าประกันหอพัก'),
            'start_date' => Yii::t('app', 'วันที่ทำการจอง'),
            'end_date' => Yii::t('app', 'วันหมดอายุการจอง'),
            'rent_id' => Yii::t('app', 'หอพัก'),
            'user_id' => Yii::t('app', 'ผู้ใช้งาน'),
        	'code' => Yii::t('app', 'รหัสยืนยันการจอง'),
        	'name' => Yii::t('app', 'ชื่อผู้ทำการจอง'),
        	'id_card' => Yii::t('app', 'รหัสบัตรประชาชน'),
        	'tel' => Yii::t('app', 'หมายเลขโทรศัพท์')
        ];
        
    }
    
   /*  public function validateUsername($attribute, $params)
    {
    	if (! preg_match('/^[a-zA-Z]+$/', $this->$attribute)) {
    		$this->addError($attribute, 'Name should only contain alphabets');
    	} */
    	/* if ( ! preg_match('/^.{3,8}$/', $this->$attribute) ) {
    		$this->addError($attribute, 'Username must be bwtween 3 to 8 characters.');
    	} */
   /*  } */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessoriesHasRooms()
    {
        return $this->hasMany(AccessoriesHasRoom::className(), ['room_id' => 'id']);
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
    public function getRent()
    {
        return $this->hasOne(Rent::className(), ['id' => 'rent_id']);
    }

    /**
     * @inheritdoc
     * @return RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomQuery(get_called_class());
    }
}
