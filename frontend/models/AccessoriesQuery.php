<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Accessories]].
 *
 * @see Accessories
 */
class AccessoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Accessories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Accessories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}