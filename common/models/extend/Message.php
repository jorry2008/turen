<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_message}}".
 *
 * @property string $id
 * @property string $nickname
 * @property string $contact
 * @property string $content
 * @property integer $is_top
 * @property integer $is_recommend
 * @property string $ip
 * @property string $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Message extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_message}}';
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
            [['nickname', 'contact', 'content', 'ip'], 'required'],
            [['content'], 'string'],
            [['is_top', 'is_recommend', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['nickname'], 'string', 'max' => 30],
            [['contact'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'nickname' => Yii::t('extend', 'Nickname'),
            'contact' => Yii::t('extend', 'Contact'),
            'content' => Yii::t('extend', 'Content'),
            'is_top' => Yii::t('extend', 'Is Top'),
            'is_recommend' => Yii::t('extend', 'Is Recommend'),
            'ip' => Yii::t('extend', 'Ip'),
            'order' => Yii::t('extend', 'Order'),
            'status' => Yii::t('extend', 'Status'),
            'deleted' => Yii::t('extend', 'Deleted'),
            'created_at' => Yii::t('extend', 'Created At'),
            'updated_at' => Yii::t('extend', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }
}
