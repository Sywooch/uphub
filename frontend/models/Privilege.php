<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "privilege".
 *
 * @property integer $id
 * @property string $valueTh
 * @property string $valueEn
 *
 * @property Member[] $members
 */
class Privilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privilege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valueTh', 'valueEn'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valueTh' => 'Value Th',
            'valueEn' => 'Value En',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['privilege_id' => 'id']);
    }
}
