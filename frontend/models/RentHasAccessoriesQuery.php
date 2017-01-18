<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[RentHasAccessories]].
 *
 * @see RentHasAccessories
 */
class RentHasAccessoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RentHasAccessories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RentHasAccessories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}