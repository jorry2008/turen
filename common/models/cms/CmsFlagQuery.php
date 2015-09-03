<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsFlag]].
 *
 * @see CmsFlag
 */
class CmsFlagQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\CmsFlagQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\CmsFlagQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return CmsFlag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsFlag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}