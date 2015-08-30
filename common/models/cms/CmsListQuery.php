<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsList]].
 *
 * @see CmsList
 */
class CmsListQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\CmsListQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');//双[[]]表示and
        return $this;
    }
    
    /**
     * @return \common\models\cms\CmsListQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

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