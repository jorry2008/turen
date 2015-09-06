<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Ad]].
 *
 * @see Ad
 */
class AdQuery extends \yii\db\ActiveQuery
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
     * @return Ad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}