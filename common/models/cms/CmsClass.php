<?php

namespace common\models\cms;

use Yii;
use yii\base\Object;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_class}}".
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
class CmsClass extends \yii\db\ActiveRecord
{
    const CMS_TYPE_PAGE = 1;
    const CMS_TYPE_LIST = 2;
    const CMS_TYPE_IMG = 3;
    const CMS_TYPE_DOWNLOAD = 4;
    const CMS_TYPE_PROD = 5;
    
    public $cmsType = [];
    public $relativeClass = [];
    
    /**
     * 初始化栏目类型（应该写入到配置）
     * 注意：系统中栏目的所有类型，都是由这里决定的，为了统一，不可额外延伸
     * @see \yii\db\BaseActiveRecord::init()
     */
    public function init()
    {
        $this->cmsType = [
            self::CMS_TYPE_PAGE => Yii::t('cms', 'Page'),
            self::CMS_TYPE_LIST => Yii::t('cms', 'List'),
            self::CMS_TYPE_IMG => Yii::t('cms', 'Image'),
        	self::CMS_TYPE_DOWNLOAD => Yii::t('cms', 'Download'),
        	self::CMS_TYPE_PROD => Yii::t('cms', 'Product'),
        ];
        
        $this->relativeClass = [
        	self::CMS_TYPE_PAGE => 'CmsPage',
        	self::CMS_TYPE_LIST => 'CmsList',
        	self::CMS_TYPE_IMG => 'CmsImg',
        	self::CMS_TYPE_DOWNLOAD => 'CmsDownload',
        	self::CMS_TYPE_PROD => 'CmsProduct',
        ];
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
    public static function tableName()
    {
        return '{{%cms_class}}';
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
    			if($this->type != self::CMS_TYPE_PAGE && $this->getOldAttribute('deleted') != $this->getAttribute('deleted')) {
    				//当前分类下有没有子分类
    				if($this->deleted && CmsClass::find()->where(['parent_id'=>$this->id])->exists()) {
    					Yii::$app->getSession()->setFlash('warning', Yii::t('cms', 'Under this column subtopic, are not allowed to delete directly!'));
    					return false;
    				}
    				
    				//判断当前分类下有没有内容
    				$class = $this->relativeClass[$this->type];//由type关联到相应的模型
    				$class = 'common\\models\\cms\\'.$class;
    				if($this->deleted && $class::find()->where(['cms_class_id'=>$this->id])->exists()) {
    					Yii::$app->getSession()->setFlash('warning', Yii::t('cms', 'Under this category contains content, cannot be deleted!'));
    					return false;
    				}
    			}
    		}
    		//当前分类下，有子分类，有没有内容
    		
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
    			if($this->type == self::CMS_TYPE_PAGE) {
    				$model = new CmsPage;
			        $model->cms_class_id = $this->id;
			        $model->save(false);
    			}
    		} else {//更新
    			if($this->type == self::CMS_TYPE_PAGE && array_key_exists('deleted', $changedAttributes) && $this->deleted == 1) {//删除单页页分类
    				CmsPage::updateAll(['deleted'=>0], ['cms_class_id'=>$this->id]);
    			}
    		}
    
    		return true;
    	} else {
    		return false;
    	}
    }

    /**
     * @inheritdoc
     * @return CmsClassQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsClassQuery(get_called_class());
    }
}
