<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property integer $upload_id
 * @property string $file_name
 * @property string $real_filename
 * @property string $create_date
 * @property integer $type
 * @property integer $albumn_id
 * @property integer $rent_id
 *
 * @property Rent $rent
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['type', 'rent_id'], 'integer'],
            [['rent_id'], 'required'],
            [['file_name', 'real_filename'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => Yii::t('app', 'Upload ID'),
            'file_name' => Yii::t('app', 'ชื่อไฟล์'),
            'real_filename' => Yii::t('app', 'ชื่อไฟล์จริง'),
            'create_date' => Yii::t('app', 'Create Date'),
            'type' => Yii::t('app', 'ประเภท'),
            'rent_id' => Yii::t('app', 'Rent ID'),
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
     * @inheritdoc
     * @return UploadsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadsQuery(get_called_class());
    }
}
