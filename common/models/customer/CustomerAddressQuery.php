<?php

namespace common\models\customer;

/**
 * This is the ActiveQuery class for [[CustomerAddress]].
 *
 * @see CustomerAddress
 */
class CustomerAddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CustomerAddress[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CustomerAddress|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}