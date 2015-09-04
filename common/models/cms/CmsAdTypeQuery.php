<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsAdType]].
 *
 * @see CmsAdType
 */
class CmsAdTypeQuery extends \yii\db\ActiveQuery
{
	/**
     * @return \common\models\cms\CmsAdTypeQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\CmsAdTypeQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return CmsAdType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsAdType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}