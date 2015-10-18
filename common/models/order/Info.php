<?php

namespace common\models\order;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order_info}}".
 *
 * @property string $id
 * @property string $order_no
 * @property string $customer_id
 * @property string $consignee
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property string $mobile
 * @property string $email
 * @property string $order_note
 * @property string $order_amount
 * @property string $discount
 * @property integer $cms_ad_id
 * @property string $referer
 * @property string $add_time
 * @property string $confirm_time
 * @property string $payment_time
 * @property string $payment_note
 * @property string $is_send
 * @property string $is_view
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Info extends \yii\db\ActiveRecord
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
        return '{{%order_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'country', 'province', 'city', 'district', 'cms_ad_id', 'add_time', 'confirm_time', 'payment_time', 'is_send', 'is_view', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['order_amount', 'discount'], 'number'],
            [['order_no'], 'string', 'max' => 50],
            [['consignee', 'zipcode', 'tel', 'mobile', 'email'], 'string', 'max' => 60],
            [['address', 'order_note', 'referer', 'payment_note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'order_no' => Yii::t('order', 'Order No'),
            'customer_id' => Yii::t('order', 'Customer ID'),
            'consignee' => Yii::t('order', 'Consignee'),
            'country' => Yii::t('order', 'Country'),
            'province' => Yii::t('order', 'Province'),
            'city' => Yii::t('order', 'City'),
            'district' => Yii::t('order', 'District'),
            'address' => Yii::t('order', 'Address'),
            'zipcode' => Yii::t('order', 'Zipcode'),
            'tel' => Yii::t('order', 'Tel'),
            'mobile' => Yii::t('order', 'Mobile'),
            'email' => Yii::t('order', 'Email'),
            'order_note' => Yii::t('order', 'Order Note'),
            'order_amount' => Yii::t('order', 'Order Amount'),
            'discount' => Yii::t('order', 'Discount'),
            'cms_ad_id' => Yii::t('order', 'Cms Ad ID'),
            'referer' => Yii::t('order', 'Referer'),
            'add_time' => Yii::t('order', 'Add Time'),
            'confirm_time' => Yii::t('order', 'Confirm Time'),
            'payment_time' => Yii::t('order', 'Payment Time'),
            'payment_note' => Yii::t('order', 'Payment Note'),
            'deleted' => Yii::t('order', 'Deleted'),
        	'is_send' => Yii::t('order', 'Is Send'),
        	'is_view' => Yii::t('order', 'Is View'),
            'created_at' => Yii::t('order', 'Created At'),
            'updated_at' => Yii::t('order', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return InfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InfoQuery(get_called_class());
    }
}
