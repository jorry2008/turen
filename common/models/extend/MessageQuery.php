<?php

namespace common\models\extend;

/**
 * This is the ActiveQuery class for [[Message]].
 *
 * @see Message
 */
class MessageQuery extends \yii\db\ActiveQuery
{
    /**
	 * 前台显示
	 * @return \common\models\extend\NavQuery
	 */
    public function active()
    {
        $this->andWhere(['status'=>1,'deleted'=>0]);
        return $this;
    }
    
    /**
     * 没有被删除
     * @return \common\models\extend\NavQuery
     */
    public function alive()
    {
    	$this->andWhere('[[deleted]]=0');
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Message[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Message|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}