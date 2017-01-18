<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Rent]].
 *
 * @see Rent
 */
class RentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Rent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}