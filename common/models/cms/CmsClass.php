<?php

namespace common\models\cms;

use Yii;
use yii\base\Object;

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
    const CMS_TYPE_PAGE = 0;
    const CMS_TYPE_LIST = 1;
    const CMS_TYPE_IMG = 2;
    
    public $cmsType = [];
    
    /**
     * 初始化栏目类型（应该写入到配置）
     * 注意：系统中栏目的所有类型，都是由这里决定的，为了统一，不可额外延伸
     * @see \yii\db\BaseActiveRecord::init()
     */
    public function init()
    {
        $this->cmsType = [
            '0' => Yii::t('cms', 'Page'),
            '1' => Yii::t('cms', 'List'),
            '2' => Yii::t('cms', 'Image'),
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
            [['parent_id', 'type', 'order', 'status'], 'integer'],
            [['parent_str', 'keywords'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 30],
            [['link_url', 'description'], 'string', 'max' => 255],
            [['pic_url'], 'string', 'max' => 100],
            [['pic_width', 'pic_height'], 'string', 'max' => 5],
            [['seo_title'], 'string', 'max' => 80],
            
            [['name','seo_title'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'parent_id' => Yii::t('cms', 'Parent ID'),
            'parent_str' => Yii::t('cms', 'Parent Str'),
            'type' => Yii::t('cms', 'Type'),
            'name' => Yii::t('cms', 'Name'),
            'link_url' => Yii::t('cms', 'Link Url'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'pic_width' => Yii::t('cms', 'Pic Width'),
            'pic_height' => Yii::t('cms', 'Pic Height'),
            'seo_title' => Yii::t('cms', 'Seo Title'),
            'keywords' => Yii::t('cms', 'Keywords'),
            'description' => Yii::t('cms', 'Description'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
        ];
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        if(parent::beforeSave($insert)) {
            if($insert) {//插入
                $this->createNewPage();
            } else {//更新
                $this->updatePage();
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    protected function createNewPage()
    {
        $model = new CmsPage;
        $model->cms_class_id = $this->id;
        $model->save(false);
    }
    
    /**
     * 如果更新后，没有则创建
     * 如果更新到其它类型则删除
     * （即这里是一个创建和删除的操作）
     */
    protected function updatePage()
    {
    
    }
    
    public function afterDelete()
    {
        parent::afterDelete();
        CmsPage::deleteAll(['cms_class_id'=>$this->id]);
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
