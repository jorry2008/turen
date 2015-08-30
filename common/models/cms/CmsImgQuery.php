<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsImg]].
 *
 * @see CmsImg
 */
class CmsImgQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\CmsImgQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
	
    /**
     * @return \common\models\cms\CmsImgQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }
    
    /**
     * @inheritdoc
     * @return CmsImg[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsImg|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}