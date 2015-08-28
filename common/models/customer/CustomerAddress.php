<?php

namespace common\models\customer;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%customer_address}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $consignee
 * @property string $address
 * @property string $telephone
 * @property string $mobile_phone
 * @property integer $district_id
 * @property integer $city_id
 * @property integer $province_id
 * @property integer $country_id
 * @property string $postcode
 * @property integer $created_at
 * @property integer $is_default
 */
class CustomerAddress extends \yii\db\ActiveRecord
{
    const CUSTOMER_ADDRESS_IS_DEFAULT = 1;//默认
    const CUSTOMER_ADDRESS_NOT_DEFAULT = 0;//不是默认
    
    public function behaviors()
    {
        return [
	       'timemap' => [
	           'class' => TimestampBehavior::className(),
	           'createdAtAttribute' => 'created_at',
	           'updatedAtAttribute' => false,
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'country_id', 'address', 'city_id'], 'required'],
            [['customer_id', 'city_id', 'country_id', 'created_at', 'is_default'], 'integer'],
            [['consignee'], 'string', 'max' => 60],
            [['address'], 'string', 'max' => 128],
            [['telephone'], 'string', 'max' => 32],
            [['mobile_phone'], 'string', 'max' => 16],
            [['postcode'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'customer_id' => Yii::t('customer', 'Customer ID'),
            'consignee' => Yii::t('customer', 'Consignee'),
            'address' => Yii::t('customer', 'Address'),
            'telephone' => Yii::t('customer', 'Telephone'),
            'mobile_phone' => Yii::t('customer', 'Mobile'),
            'district_id' => Yii::t('customer', 'District'),
            'city_id' => Yii::t('customer', 'City'),
            'province_id' => Yii::t('customer', 'Province'),
            'country_id' => Yii::t('customer', 'Country'),
            'postcode' => Yii::t('customer', 'Postcode'),
            'created_at' => Yii::t('customer', 'Created At'),
            'is_default' => Yii::t('customer', 'Is Default'),
        ];
    }
    
    /**
     * 表关联
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    
    /**
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //地址设为默认
            if($this->is_default) {
                CustomerAddress::updateAll(['is_default'=>self::CUSTOMER_ADDRESS_NOT_DEFAULT], 'customer_id = :customer_id', [':customer_id'=>$this->customer_id]);
            }
            
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     * @return CustomerAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerAddressQuery(get_called_class());
    }
}
