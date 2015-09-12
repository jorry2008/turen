<?php

namespace common\models\help;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%help}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_code
 * @property string $user_content
 * @property string $dev_content
 * @property string $url
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Help extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%help}}';
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
            [['user_content', 'dev_content', 'short_code'], 'string'],
            [['status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'url'], 'string', 'max' => 100],
        	[['short_code'], 'string', 'max' => 50],
        	
        	[['url'], 'url'],
        	[['title' ,'short_code'], 'required'],
        	[['short_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('help', 'ID'),
            'title' => Yii::t('help', 'Title'),
        	'short_code' => Yii::t('help', 'Short Code'),
            'user_content' => Yii::t('help', 'User Content'),
            'dev_content' => Yii::t('help', 'Dev Content'),
            'url' => Yii::t('help', 'Url'),
            'status' => Yii::t('help', 'Status'),
            'deleted' => Yii::t('help', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return HelpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HelpQuery(get_called_class());
    }
}
