<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsPage]].
 *
 * @see CmsPage
 */
class CmsPageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CmsPage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsPage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}