<?php

namespace common\models\system;

use Yii;

/**
 * This is the ActiveQuery class for [[Explorer]].
 *
 * @see Explorer
 */
class ExplorerQuery extends \yii\db\ActiveQuery
{
	//资源存在
    public function isExists()
    {
        $this->andWhere('[[is_exsit]]='.Explorer::EXIST_YES);
        return $this;
    }
    
    //删除的草稿
    public function deleteDraft()
    {
    	$this->andWhere(['status'=>Explorer::STATUS_DRAFT ,'action'=>Explorer::ACTION_DEL, 'session'=>Yii::$app->getSession()->id]);
    	return $this;
    }
    
    //插入的草稿
    public function insertDraft()
    {
    	$this->andWhere(['status'=>Explorer::STATUS_DRAFT ,'action'=>Explorer::ACTION_INS, 'session'=>Yii::$app->getSession()->id]);
    	return $this;
    }

    /**
     * @inheritdoc
     * @return Explorer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Explorer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}