<?php

namespace common\models\help;

/**
 * This is the ActiveQuery class for [[Help]].
 *
 * @see Help
 */
class HelpQuery extends \yii\db\ActiveQuery
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
     * @return Help[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Help|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}