<?php

namespace common\models\extend;

/**
 * This is the ActiveQuery class for [[Fragment]].
 *
 * @see Fragment
 */
class FragmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Fragment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fragment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}