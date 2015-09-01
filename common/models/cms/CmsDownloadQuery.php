<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[CmsDownload]].
 *
 * @see CmsDownload
 */
class CmsDownloadQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return \common\models\cms\CmsDownloadQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * @return \common\models\cms\CmsDownloadQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return CmsDownload[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CmsDownload|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}