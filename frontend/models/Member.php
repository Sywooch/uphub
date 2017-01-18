<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property integer $privilege_id
 *
 * @property Privilege $privilege
 * @property Register[] $registers
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['privilege_id'], 'required'],
            [['privilege_id'], 'integer'],
            [['username', 'password', 'firstname', 'lastname'], 'string', 'max' => 45],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'หมายเลขสมาชิก',
            'username' => 'ชื่อผุ้ใช้',
            'password' => 'รหัสผาน',
            'firstname' => 'ชื่อ',
            'lastname' => 'นามสกุล',
            'privilege_id' => 'สิทธิ์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivilege()
    {
        return $this->hasOne(Privilege::className(), ['id' => 'privilege_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisters()
    {
        return $this->hasMany(Register::className(), ['member_id' => 'id']);
    }
}
