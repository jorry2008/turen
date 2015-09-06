<?php

namespace common\models\cms;

use Yii;
use yii\base\Object;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_column}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $parent_str
 * @property integer $type
 * @property string $name
 * @property string $link_url
 * @property string $pic_url
 * @property string $pic_width
 * @property string $pic_height
 * @property string $seo_title
 * @property string $keywords
 * @property string $description
 * @property integer $order
 * @property integer $status
 */
class Column extends \yii\db\ActiveRecord
{
    const CMS_TYPE_PAGE = 1;
    const CMS_TYPE_LIST = 2;
    const CMS_TYPE_IMG = 3;
    const CMS_TYPE_DOWNLOAD = 4;
//     const CMS_TYPE_PROD = 5;
    
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
    public static function tableName()
    {
        return '{{%cms_column}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'type', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['parent_str', 'keywords'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 30],
            [['link_url', 'description'], 'string', 'max' => 255],
            [['pic_url'], 'string', 'max' => 100],
            [['pic_width', 'pic_height'], 'string', 'max' => 5],
            [['seo_title'], 'string', 'max' => 80],
            
            [['name'], 'required'],
        	[['link_url'], 'url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'parent_id' => Yii::t('cms', 'Belong Column'),
            'type' => Yii::t('cms', 'Column Type'),
            'name' => Yii::t('cms', 'Column Name'),
            'link_url' => Yii::t('cms', 'Link Url'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'pic_width' => Yii::t('cms', 'Pic Width'),
            'pic_height' => Yii::t('cms', 'Pic Height'),
            'seo_title' => Yii::t('cms', 'Seo Title'),
            'keywords' => Yii::t('cms', 'Column Keywords'),
            'description' => Yii::t('cms', 'Column Description'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
        	'created_at' => Yii::t('cms', 'Created At'),
        	'updated_at' => Yii::t('cms', 'Updated At'),
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
    			//判断是否为删除动作的非单页面
    			//当前分类下，有子分类，有没有内容
    			if($this->getOldAttribute('deleted') != $this->getAttribute('deleted')) {
    				//当前分类下有没有子分类
    				if($this->deleted && Column::find()->where(['parent_id'=>$this->id])->alive()->exists()) {
    					Yii::$app->getSession()->setFlash('warning', Yii::t('cms', 'Under this column subtopic, are not allowed to delete directly!'));
    					return false;
    				}
    				
    				if($this->type != static::CMS_TYPE_PAGE) {
    					//判断当前分类下有没有内容
    					$class = static::getRelativeClass()[$this->type];//由type关联到相应的模型
    					$class = 'common\\models\\cms\\'.$class;
    					if($this->deleted && $class::find()->where(['column_id'=>$this->id])->alive()->exists()) {
    						Yii::$app->getSession()->setFlash('warning', Yii::t('cms', 'Under this category contains content, cannot be deleted!'));
    						return false;
    					}
    				}
    			}
    		}
    		
			return true;
		} else {
			return false;
		}
    }
    
    /**
     * (non-PHPdoc)
     * @see \yii\db\BaseActiveRecord::afterSave($insert, $changedAttributes)
     */
    public function afterSave($insert, $changedAttributes)
    {
    	if(parent::beforeSave($insert)) {
    		if($insert) {//插入
    			//如果是单页面，则插入时创建一个单页
    			if($this->type == static::CMS_TYPE_PAGE) {
    				$model = new Page;
			        $model->column_id = $this->id;
			        $model->save(false);
    			}
    		} else {//更新
    			if($this->type == static::CMS_TYPE_PAGE && array_key_exists('deleted', $changedAttributes) && $this->deleted == 1) {//删除单页页分类
    				Page::updateAll(['deleted'=>1], ['column_id'=>$this->id]);
    			}
    		}
    
    		return true;
    	} else {
    		return false;
    	}
    }

    /**
     * 栏目类型
     * @return array
     */
    public static function getType()
    {
    	return [
    		static::CMS_TYPE_PAGE => Yii::t('cms', 'Page'),
    		static::CMS_TYPE_LIST => Yii::t('cms', 'List'),
    		static::CMS_TYPE_IMG => Yii::t('cms', 'Image'),
    		static::CMS_TYPE_DOWNLOAD => Yii::t('cms', 'Download'),
//         	static::CMS_TYPE_PROD => Yii::t('cms', 'Product'),
    	];
    }
    
    /**
     * 与类型相对应的栏目类
     * @return array
     */
    public static function getRelativeClass()
    {
    	return [
    		static::CMS_TYPE_PAGE => 'Page',
    		static::CMS_TYPE_LIST => 'List',
    		static::CMS_TYPE_IMG => 'Img',
    		static::CMS_TYPE_DOWNLOAD => 'Download',
//         	static::CMS_TYPE_PROD => 'Product',
    	];
    }
    
    /**
     * 自我表关联
     */
    public function getMySelf()
    {
    	return $this->hasOne(Column::className(), ['id' => 'parent_id']);
    }
    
    /**
     * @inheritdoc
     * @return ColumnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ColumnQuery(get_called_class());
    }
}
