<?php

namespace common\models\system;

/**
 * This is the ActiveQuery class for [[CascadeData]].
 *
 * @see CascadeData
 */
class CascadeDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CascadeData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CascadeData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}