<?php

namespace common\models\cms;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_download}}".
 *
 * @property string $id
 * @property integer $cms_class_id
 * @property string $title
 * @property string $colorval
 * @property string $boldval
 * @property string $cms_flag
 * @property string $file_type
 * @property string $language
 * @property string $accredit
 * @property string $file_size
 * @property string $unit
 * @property string $run_os
 * @property string $down_url
 * @property string $source
 * @property string $author
 * @property string $link_url
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $picurl
 * @property string $picarr
 * @property string $hits
 * @property string $order
 * @property integer $status
 * @property integer $publish_at
 * @property integer $deleted
 * @property string $updated_at
 * @property string $created_at
 */
class CmsDownload extends \yii\db\ActiveRecord
{
// 	const MAX_PAGE_SIZE = 20;
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
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
        return '{{%cms_download}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cms_class_id', 'hits', 'order', 'status', 'deleted', 'updated_at', 'created_at'], 'integer'],
            [['content', 'cms_flag', 'picarr'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['colorval', 'boldval', 'language', 'accredit', 'file_size'], 'string', 'max' => 10],
            [['file_type'], 'string', 'max' => 5],
            [['unit'], 'string', 'max' => 4],
            [['run_os', 'source', 'author', 'keywords'], 'string', 'max' => 50],
            [['down_url', 'link_url', 'description'], 'string', 'max' => 255],
            [['picurl'], 'string', 'max' => 100],
        	
        	[['link_url', 'source'], 'url'],
        	[['title', 'content', 'publish_at'], 'required'],
        	[['cms_flag'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'cms_class_id' => Yii::t('cms', 'Cms Class'),
            'title' => Yii::t('cms', 'Title'),
            'colorval' => Yii::t('cms', 'Colorval'),
            'boldval' => Yii::t('cms', 'Boldval'),
            'cms_flag' => Yii::t('cms', 'Flag'),
            'file_type' => Yii::t('cms', 'File Type'),
            'language' => Yii::t('cms', 'Language'),
            'accredit' => Yii::t('cms', 'Accredit'),
            'file_size' => Yii::t('cms', 'File Size'),
            'unit' => Yii::t('cms', 'Unit'),
            'run_os' => Yii::t('cms', 'Run Os'),
            'down_url' => Yii::t('cms', 'Down Url'),
            'source' => Yii::t('cms', 'Source'),
            'author' => Yii::t('cms', 'Author'),
            'link_url' => Yii::t('cms', 'Link Url'),
            'keywords' => Yii::t('cms', 'Keywords'),
            'description' => Yii::t('cms', 'Description'),
            'content' => Yii::t('cms', 'Content'),
            'picurl' => Yii::t('cms', 'Picurl'),
            'picarr' => Yii::t('cms', 'Picarr'),
            'hits' => Yii::t('cms', 'Hits'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
            'deleted' => Yii::t('cms', 'Deleted'),
        	'publish_at' => Yii::t('cms', 'Publish At'),
            'updated_at' => Yii::t('cms', 'Updated At'),
            'created_at' => Yii::t('cms', 'Created At'),
        ];
    }
    
    /**
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
    	if(parent::beforeSave($insert)) {
    		//处理时间
    		$this->publish_at = strtotime($this->publish_at);
    
    		//处理标记
    		if($this->cms_flag && is_array($this->cms_flag)) {
    			$this->cms_flag = implode(',', $this->cms_flag);
    		} else {
    			$this->cms_flag = CmsFlag::FLAG_G;
    		}
    
    		return true;
    	} else {
    		return false;
    	}
    }
    
    /**
     * 一对一
     */
    public function getCmsClass()
    {
    	return $this->hasOne(CmsClass::className(), ['id' => 'cms_class_id']);
    }

    /**
     * 一对一
     */
    public function getCmsFlag()
    {
    	$this->cms_flag = explode(',', $this->cms_flag);
    	$models = CmsFlag::find()->where(['in', 'flag', $this->cms_flag])->all();
    	$names = ArrayHelper::map($models, 'name', 'id');
    	$this->cms_flag = implode(',', array_keys($names));
    	return $this;
    }
    
    /**
     * @inheritdoc
     * @return CmsDownloadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsDownloadQuery(get_called_class());
    }
}