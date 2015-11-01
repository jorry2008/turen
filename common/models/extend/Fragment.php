<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_fragment}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $pic_url
 * @property string $link_url
 * @property string $content
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Fragment extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_fragment}}';
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
    		],
    		'upload-file' => [
    			'class' => \backend\behaviors\UploadFileBehavior::className(),
    			'fileAttribute' => 'pic_url',
    		],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 30],
        	[['short_code'], 'string', 'max' => 50],
            [['pic_url', 'link_url'], 'string', 'max' => 80],
        	
        	[['title', 'short_code'], 'required'],
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
            'id' => Yii::t('extend', 'ID'),
            'title' => Yii::t('extend', 'Title'),
        	'short_code' => Yii::t('extend', 'Short Code'),
            'pic_url' => Yii::t('extend', 'Pic Url'),
            'link_url' => Yii::t('extend', 'Link Url'),
            'content' => Yii::t('extend', 'Content'),
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return FragmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FragmentQuery(get_called_class());
    }
}
