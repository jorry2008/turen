<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Page]].
 *
 * @see Page
 */
class PageQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\PageQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\PageQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Page[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Page|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}