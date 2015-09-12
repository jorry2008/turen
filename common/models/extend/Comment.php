<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_comment}}".
 *
 * @property string $id
 * @property string $relative_id
 * @property integer $mode
 * @property string $customer_id
 * @property string $customer_name
 * @property string $content
 * @property string $reply
 * @property string $link
 * @property string $ip
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_comment}}';
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
            [['relative_id', 'mode', 'customer_id', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['content', 'reply'], 'string'],
            [['customer_name'], 'string', 'max' => 20],
            [['link'], 'string', 'max' => 200],
            [['ip'], 'string', 'max' => 30],
        	
        	[['content'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'relative_id' => Yii::t('extend', 'Relative ID'),
            'mode' => Yii::t('extend', 'Mode'),
            'customer_id' => Yii::t('extend', 'Customer ID'),
            'customer_name' => Yii::t('extend', 'Customer Name'),
            'content' => Yii::t('extend', 'Content'),
            'reply' => Yii::t('extend', 'Reply'),
            'link' => Yii::t('extend', 'Link'),
            'ip' => Yii::t('extend', 'Ip'),
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
