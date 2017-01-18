<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "accessories_has_room".
 *
 * @property integer $id
 * @property integer $accessories_id
 * @property integer $room_id
 *
 * @property Accessories $accessories
 * @property Room $room
 */
class AccessoriesHasRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accessories_has_room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accessories_id', 'room_id'], 'required'],
            [['accessories_id', 'room_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'accessories_id' => Yii::t('app', 'สิ่งอำนวยความสะดวก'),
            'room_id' => Yii::t('app', 'หมายเลขห้อง'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessories()
    {
        return $this->hasOne(Accessories::className(), ['id' => 'accessories_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @inheritdoc
     * @return AccessoriesHasRoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccessoriesHasRoomQuery(get_called_class());
    }
}
