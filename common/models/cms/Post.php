<?php

namespace common\models\cms;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_list}}".
 *
 * @property string $id
 * @property integer $column_id
 * @property string $title
 * @property string $colorval
 * @property string $boldval
 * @property string $flag
 * @property string $source
 * @property string $author
 * @property string $linkurl
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $pic_url
 * @property string $picarr
 * @property string $hits
 * @property string $order
 * @property integer $status
 * @property integer $publish_at
 * @property string $updated_at
 * @property string $created_at
 */
class Post extends \yii\db\ActiveRecord
{
	const MAX_PAGE_SIZE = 20;
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
        return '{{%cms_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
    	$defaultValue = Yii::$app->params['config']['config_site_default_hits'];
    	
        return [
            [['column_id', 'hits', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['content', 'picarr'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['colorval', 'boldval'], 'string', 'max' => 10],
            [['source', 'author', 'keywords'], 'string', 'max' => 50],
            [['linkurl', 'description'], 'string', 'max' => 255],
            [['pic_url'], 'string', 'max' => 100],
        		
        	[['hits'], 'default', 'value'=>$defaultValue],
        	[['title', 'content', 'publish_at'], 'required'],
        	[['source', 'linkurl'], 'url'],
        	[['flag'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'column_id' => Yii::t('cms', 'Column'),
            'title' => Yii::t('cms', 'Title'),
            'colorval' => Yii::t('cms', 'Colorval'),
            'boldval' => Yii::t('cms', 'Boldval'),
            'flag' => Yii::t('cms', 'Flag'),
            'source' => Yii::t('cms', 'Article Source'),
            'author' => Yii::t('cms', 'Author'),
            'linkurl' => Yii::t('cms', 'Linkurl'),
            'keywords' => Yii::t('cms', 'Keywords'),
            'description' => Yii::t('cms', 'Description'),
            'content' => Yii::t('cms', 'Content'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'picarr' => Yii::t('cms', 'Picarr'),
            'hits' => Yii::t('cms', 'Hits'),
            'status' => Yii::t('cms', 'Status'),
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
    		if($this->flag && is_array($this->flag)) {
    			$this->flag = implode(',', $this->flag);
    		} else {
    			$this->flag = Flag::FLAG_G;
    		}
    		
    		return true;
    	} else {
    		return false;
    	}
    }
    
    /**
     * 一对一
     */
    public function getColumn()
    {
        return $this->hasOne(Column::className(), ['id' => 'column_id']);
    }
    
    /**
     * 一对一
     */
    public function getFlagModel()
    {
    	$this->flag = explode(',', $this->flag);
    	$models = Flag::find()->where(['in', 'flag', $this->flag])->all();
    	$names = ArrayHelper::map($models, 'name', 'id');
    	$this->flag = implode(',', array_keys($names));
    	return $this;
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
