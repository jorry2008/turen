<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Download]].
 *
 * @see Download
 */
class DownloadQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\DownloadQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\DownloadQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Download[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Download|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}