<?php

namespace common\models\order;

/**
 * This is the ActiveQuery class for [[OrderProduct]].
 *
 * @see OrderProduct
 */
class OrderProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return OrderProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}