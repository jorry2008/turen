<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsList]].
 *
 * @see CmsList
 */
class CmsListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CmsList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}