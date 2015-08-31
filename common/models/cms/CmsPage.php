<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%cms_page}}".
 *
 * @property integer $id
 * @property integer $cms_class_id
 * @property string $title
 * @property string $pic_url
 * @property string $content
 * @property string $order
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class CmsPage extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['pic_url'], 'string', 'max' => 100],
            
            [['cms_class_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'cms_class_id' => Yii::t('cms', 'Cms Class ID'),
            'title' => Yii::t('cms', 'Title'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'content' => Yii::t('cms', 'Content'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
            'updated_at' => Yii::t('cms', 'Updated At'),
            'created_at' => Yii::t('cms', 'Created At'),
        ];
    }
    
    /**
     * 一对一
     */
    public function getCmsClass()
    {
        return $this->hasOne(CmsClass::className(), ['id' => 'cms_class_id']);
    }

    /**
     * @inheritdoc
     * @return CmsPageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsPageQuery(get_called_class());
    }
}
