<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[List]].
 *
 * @see List
 */
class PostQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\PostQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');//双[[]]表示and
        return $this;
    }
    
    /**
     * @return \common\models\cms\PostQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return List[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return List|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}