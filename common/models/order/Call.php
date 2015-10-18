<?php

namespace common\models\order;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order_call}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $username
 * @property string $contact
 * @property string $order_note
 * @property string $is_send
 * @property string $is_view
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Call extends \yii\db\ActiveRecord
{
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
        return '{{%order_call}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'deleted', 'created_at', 'is_send', 'is_view', 'updated_at'], 'integer'],
            [['username', 'contact'], 'string', 'max' => 60],
            [['order_note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'customer_id' => Yii::t('order', 'Customer ID'),
            'username' => Yii::t('order', 'Username'),
            'contact' => Yii::t('order', 'Contact'),
            'order_note' => Yii::t('order', 'Order Note'),
            'deleted' => Yii::t('order', 'Deleted'),
        	'is_send' => Yii::t('order', 'Is Send'),
        	'is_view' => Yii::t('order', 'Is View'),
            'created_at' => Yii::t('order', 'Created At'),
            'updated_at' => Yii::t('order', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CallQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CallQuery(get_called_class());
    }
}
