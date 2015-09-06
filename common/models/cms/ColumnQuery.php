<?php

namespace common\models\cms;

/**
 * This is the ActiveQuery class for [[Column]].
 *
 * @see Column
 */
class ColumnQuery extends \yii\db\ActiveQuery
{
	/**
	 * 前台可视的
	 * @return \common\models\cms\ColumnQuery
	 */
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }
    
    /**
     * 未删除的
     * @return \common\models\cms\ColumnQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Column[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Column|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}