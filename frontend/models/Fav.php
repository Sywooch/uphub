<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%fav}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $rent_id
 *
 * @property Rent $rent
 * @property User $user
 */
class Fav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fav}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'rent_id'], 'required'],
            [['id', 'user_id', 'rent_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'rent_id' => 'Rent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRent()
    {
        return $this->hasOne(Rent::className(), ['id' => 'rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
