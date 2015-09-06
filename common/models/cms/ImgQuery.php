<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Img]].
 *
 * @see Img
 */
class ImgQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\ImgQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
	
    /**
     * @return \common\models\cms\ImgQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }
    
    /**
     * @inheritdoc
     * @return Img[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Img|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}