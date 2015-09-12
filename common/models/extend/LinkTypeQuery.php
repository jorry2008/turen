<?php

namespace common\models\extend;

/**
 * This is the ActiveQuery class for [[LinkType]].
 *
 * @see LinkType
 */
class LinkTypeQuery extends \yii\db\ActiveQuery
{
    /**
	 * 前台显示
	 * @return \common\models\extend\NavQuery
	 */
    public function active()
    {
        $this->andWhere(['status'=>1,'deleted'=>0]);
        return $this;
    }
    
    /**
     * 没有被删除
     * @return \common\models\extend\NavQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return LinkType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LinkType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}