<?php

namespace common\models\cms;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cms_ad_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_code
 * @property integer $width
 * @property integer $height
 * @property integer $status
 * @property integer $deleted
 * @property integer $wh_type
 * @property integer $updated_at
 * @property integer $created_at
 */
class AdType extends \yii\db\ActiveRecord
{
	const WH_TYPE_PX = 1;//像素
	const WH_TYPE_PERCENT = 2;//百分比
	
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
	const MAX_PAGE_SIZE = 20;
	
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
        return '{{%cms_ad_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wh_type', 'width', 'height', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
        	[['short_code'], 'string', 'max' => 20],
        		
        	[['name', 'short_code'], 'required'],
        	[['short_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'name' => Yii::t('cms', 'Name'),
            'width' => Yii::t('cms', 'Width'),
            'height' => Yii::t('cms', 'Height'),
            'status' => Yii::t('cms', 'Status'),
        	'wh_type' => Yii::t('cms', 'Size Type'),
        	'created_at' => Yii::t('cms', 'Created At'),
        	'updated_at' => Yii::t('cms', 'Updated At'),
        	'short_code' => Yii::t('cms', 'Short Code'),
        ];
    }
    
    /**
     * 一对多
     */
    public function getAd()
    {
    	return $this->hasMany(Ad::className(), ['ad_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AdTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdTypeQuery(get_called_class());
    }
}
