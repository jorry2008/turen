<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsClass]].
 *
 * @see CmsClass
 */
class CmsClassQuery extends \yii\db\ActiveQuery
{
	/**
	 * 前台可视的
	 * @return \common\models\cms\CmsClassQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * 未删除的
     * @return \common\models\cms\CmsClassQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

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