<?php

namespace common\models\cms;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_ad}}".
 *
 * @property integer $id
 * @property integer $ad_type_id
 * @property string $title
 * @property string $mode
 * @property string $pic_url
 * @property string $text
 * @property string $hits
 * @property string $link_url
 * @property integer $order
 * @property integer $status
 * @property integer $deleted
 * @property string $updated_at
 * @property string $created_at
 */
class Ad extends \yii\db\ActiveRecord
{
	//广告发布状态
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
	const MAX_PAGE_SIZE = 20;
	
	//广告类型
	const AD_IMG = 1;
	const AD_FLASH = 2;
	const AD_VIDEO = 3;
	const AD_HTML_CODE = 4;
	
	const AD_SOURCE_PC = 'pc';
	const AD_SOURCE_M = 'm';
	
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
			], 
			'upload-file' => [
				'class' => \backend\behaviors\UploadFileBehavior::className(),
				'fileAttribute' => 'pic_url',
			]
		];
	}
	
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
            [['ad_type_id', 'order', 'status', 'deleted', 'updated_at', 'created_at'], 'integer'],
            [['text'], 'string'],
            [['title', 'short_code'], 'string', 'max' => 30],
            [['mode'], 'string', 'max' => 10],
            [['pic_url'], 'string', 'max' => 100],
            [['link_url'], 'string', 'max' => 255],
        	
        	[['title', 'order', 'short_code'], 'required'],
        	[['short_code'], 'unique'],
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
            'ad_type_id' => Yii::t('cms', 'Ad Type'),
            'title' => Yii::t('cms', 'Title'),
            'mode' => Yii::t('cms', 'Mode'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'text' => Yii::t('cms', 'Text'),
            'link_url' => Yii::t('cms', 'Link Url'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
            'updated_at' => Yii::t('cms', 'Updated At'),
            'created_at' => Yii::t('cms', 'Created At'),
        	'short_code' => Yii::t('cms', 'Short Code'),
        ];
    }
    
    /**
     * 一对一
     */
    public function getAdType()
    {
    	return $this->hasOne(AdType::className(), ['id' => 'ad_type_id']);
    }
    
    /**
     * 获取广告的模型
     * @return multitype:string
     */
    public static function getAdMode()
    {
    	return [
    		static::AD_IMG => Yii::t('cms', 'Image'),
    		static::AD_FLASH => Yii::t('cms', 'Flash'),
    		static::AD_VIDEO => Yii::t('cms', 'Video'),
    		static::AD_HTML_CODE => Yii::t('cms', 'HTML Code'),
    	];
    }

    /**
     * @inheritdoc
     * @return AdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdQuery(get_called_class());
    }
}
