<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "accessories".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AccessoriesHasRoom[] $accessoriesHasRooms
 * @property RentHasAccessories[] $rentHasAccessories
 */
class Accessories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accessories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชือสิ่งอำนวยความสะดวก'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessoriesHasRooms()
    {
        return $this->hasMany(AccessoriesHasRoom::className(), ['accessories_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentHasAccessories()
    {
        return $this->hasMany(RentHasAccessories::className(), ['accessories_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AccessoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccessoriesQuery(get_called_class());
    }
}
