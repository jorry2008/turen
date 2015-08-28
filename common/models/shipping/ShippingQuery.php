<?php

namespace common\models\shipping;

/**
 * This is the ActiveQuery class for [[Shipping]].
 *
 * @see Shipping
 */
class ShippingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Shipping[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Shipping|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}