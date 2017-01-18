<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rent_has_accessories".
 *
 * @property integer $id
 * @property integer $rent_id
 * @property integer $accessories_id
 *
 * @property Accessories $accessories
 * @property Rent $rent
 */
class RentHasAccessories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rent_has_accessories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rent_id', 'accessories_id'], 'required'],
            [['rent_id', 'accessories_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rent_id' => Yii::t('app', 'ชื่อหอพัก'),
            'accessories_id' => Yii::t('app', 'สิ่งอำนวยความสะดวก'),
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
    public function getRent()
    {
        return $this->hasOne(Rent::className(), ['id' => 'rent_id']);
    }

    /**
     * @inheritdoc
     * @return RentHasAccessoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RentHasAccessoriesQuery(get_called_class());
    }
}
