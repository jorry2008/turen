<?php
/**
 * 
 */

namespace backend\behaviors;

use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;

use common\models\system\Explorer;

/*
 * 使用方法
 */
class UploadFileBehavior extends \yii\behaviors\AttributeBehavior
{
    public $fileAttribute = 'file';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->fileAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this->fileAttribute],
            ];
        }
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
    	//查找资源表，获取有效资源信息
    	$del = Explorer::find()->where(['field'=>$this->fileAttribute])->deleteDraft()->all();
    	$ins = Explorer::find()->where(['field'=>$this->fileAttribute])->insertDraft()->all();
    	
    	$owner = $this->owner;
    	$value = $owner->getOldAttribute($this->fileAttribute);//注意：bug
    	
//     	print_r($value);
//     	print_r($del);
//     	print_r($ins);
//     	exit;
    	
    	$fvalue = [];
    	if($value) {
    		$fvalue = explode(',', $value);
    	}
    	
    	$fdel = [];
    	foreach ($del as $de) {
    		$fdel[] = $de->path;
    		//更新草稿状态
    		$de->status = Explorer::STATUS_COMPLETE;
    		$de->update(false);
    	}
    	
    	$fins = [];
    	foreach ($ins as $in) {
    		$fins[] = $in->path;
    		//更新草稿状态
    		$in->status = Explorer::STATUS_COMPLETE;
    		$in->update(false);
    	}
    	
    	$fnew = [];
    	if($fins) {
    		$fvalue = ArrayHelper::merge($fvalue, $fins);//所有不重复的文件
    	}
    	if($fdel) {
    		$fvalue = array_diff($fvalue, $fdel);//取差集
    	}
    	
    	return empty($fvalue)?'':implode(',', $fvalue);
    }

//     public function touch($attribute)
//     {
//         /* @var $owner BaseActiveRecord */
//         $owner = $this->owner;
//         if ($owner->getIsNewRecord()) {
//             throw new InvalidCallException('Updating the timestamp is not possible on a new record.');
//         }
//         $owner->updateAttributes(array_fill_keys((array) $attribute, $this->getValue(null)));
//     }
}
