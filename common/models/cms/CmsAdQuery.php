<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsAd]].
 *
 * @see CmsAd
 */
class CmsAdQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CmsAd[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsAd|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}