<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%cms_ad}}".
 *
 * @property integer $id
 * @property integer $cms_ad_type_id
 * @property string $title
 * @property string $mode
 * @property string $pic_url
 * @property string $text
 * @property string $link_url
 * @property integer $order
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class CmsAd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_ad_type_id', 'order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 30],
            [['mode'], 'string', 'max' => 10],
            [['pic_url'], 'string', 'max' => 100],
            [['link_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'cms_ad_type_id' => Yii::t('cms', 'Cms Ad Type ID'),
            'title' => Yii::t('cms', 'Title'),
            'mode' => Yii::t('cms', 'Mode'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'text' => Yii::t('cms', 'Text'),
            'link_url' => Yii::t('cms', 'Link Url'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
            'updated_at' => Yii::t('cms', 'Updated At'),
            'created_at' => Yii::t('cms', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CmsAdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsAdQuery(get_called_class());
    }
}
