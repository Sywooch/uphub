<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%androidapp}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 */
class Androidapp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%androidapp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'name' => Yii::t('app', 'ชื่อหอพัก'),
            'image' => Yii::t('app', 'รูปหอพัก'),
        ];
    }

    /**
     * @inheritdoc
     * @return AndroidappQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AndroidappQuery(get_called_class());
    }
}
