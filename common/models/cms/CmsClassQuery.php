<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsClass]].
 *
 * @see CmsClass
 */
class CmsClassQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CmsClass[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsClass|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}