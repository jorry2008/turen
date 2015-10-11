<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_nav}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $link_url
 * @property string $re_link_url
 * @property string $pic_url
 * @property string $target
 * @property integer $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Nav extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_nav}}';
    }
    
    /**
     * 以行为的方式处理操作时间
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
    	return [
    		'timemap' => [
    			'class' => TimestampBehavior::className(),
    			'createdAtAttribute' => 'created_at',
    			'updatedAtAttribute' => 'updated_at'
    		]
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name', 'target'], 'string', 'max' => 30],
            [['link_url', 're_link_url'], 'string', 'max' => 255],
            [['pic_url'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * (non-PHPdoc)
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
    	if(parent::beforeSave($insert)) {
    		if($insert) {//创建
    			 
    		} else {//更新
    			//判断是否为假删除操作
    			if(!empty(Yii::$app->requestedAction->feild) && Yii::$app->requestedAction->feild == 'deleted') {
    				//当前分类下有没有子分类
    				if(Nav::find()->where(['parent_id'=>$this->id])->alive()->exists()) {
    					Yii::$app->getSession()->setFlash('warning', Yii::t('extend', 'Have links under the link type, cannot be deleted.'));
    					return false;
    				}
    			}
    		}
    
    		return true;
    	} else {
    		return false;
    	}
    }

    /**
     * 一对一
     * 自我联表
     */
    public function getMySelf()
    {
        return $this->hasOne(static::className(), ['id' => 'parent_id']);
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'parent_id' => Yii::t('extend', 'Parent ID'),
            'name' => Yii::t('extend', 'Name'),
            'link_url' => Yii::t('extend', 'Link Url'),
            're_link_url' => Yii::t('extend', 'Re Link Url'),
            'pic_url' => Yii::t('extend', 'Pic Url'),
            'target' => Yii::t('extend', 'Target'),
            'order' => Yii::t('common', 'Order'),
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return NavQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NavQuery(get_called_class());
    }
}
