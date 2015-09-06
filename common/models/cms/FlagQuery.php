<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Flag]].
 *
 * @see Flag
 */
class FlagQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\FlagQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\FlagQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Flag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Flag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}