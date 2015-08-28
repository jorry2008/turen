<?php

namespace common\models\user;

/**
 * This is the ActiveQuery class for [[UserGroup]].
 *
 * @see UserGroup
 */
class UserGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}