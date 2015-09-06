<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[AdType]].
 *
 * @see AdType
 */
class AdTypeQuery extends \yii\db\ActiveQuery
{
	/**
     * @return \common\models\cms\AdTypeQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\AdTypeQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return AdType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AdType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}