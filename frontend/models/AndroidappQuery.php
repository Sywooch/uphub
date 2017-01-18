<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Androidapp]].
 *
 * @see Androidapp
 */
class AndroidappQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Androidapp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Androidapp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}