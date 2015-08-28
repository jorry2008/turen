<?php

namespace common\models\order;

/**
 * This is the ActiveQuery class for [[OrderInfo]].
 *
 * @see OrderInfo
 */
class OrderInfoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return OrderInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function sumProductAmount()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
}