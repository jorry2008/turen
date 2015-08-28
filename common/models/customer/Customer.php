<?php

namespace common\models\customer;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property integer $customer_group_id
 * @property string $username
 * @property string $nickname
 * @property integer $gender
 * @property string $birthday
 * @property string $email
 * @property string $telephone
 * @property string $mobile_phone
 * @property string $point
 * @property string $default_address_id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $last_login_at
 */
class Customer extends \yii\db\ActiveRecord
{
    const CUSTOMER_OFF = 0;
    const CUSTOMER_ON = 1;
    
    const CUSTOMER_MALE = 1;//男
    const CUSTOMER_FEMALE = 0;
    
    public $password;
    
    /**
     * 行为处理时间
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
        return '{{%customer}}';
    }

    /**
     * 仅仅是做接收post之前的过滤器验证
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_group_id', 'gender', 'point', 'default_address_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['username', 'email'], 'required'],
            [['username', 'email'], 'string', 'max' => 64],
            [['nickname', 'telephone', 'auth_key'], 'string', 'max' => 32],
            [['mobile_phone'], 'string', 'max' => 16],
            [['password'], 'required', 'on' => ['create']],
        ];
    }
    
    /**
     * 指定入库和指定model属性接收的值
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            //后台创建
            'create' => ['username', 'password', 'password_hash', 'nickname', 'customer_group_id', 'gender', 'birthday', 'email', 'telephone', 'mobile_phone', 'point', 'default_address_id', 'status', 'created_at', 'updated_at'],
            //后台更新
            'update' => ['username', 'password' ,'password_hash', 'nickname', 'customer_group_id', 'gender', 'birthday', 'email', 'telephone', 'mobile_phone', 'point', 'default_address_id', 'status', 'updated_at'],
            //注册
            'register' => ['username', 'password', 'email'],
            //登录
            'login' => ['username', 'password'],
            //如果不让入库：'!username'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'customer_group_id' => Yii::t('customer', 'Customer Group'),
            'username' => Yii::t('customer', 'User Name'),
            'nickname' => Yii::t('customer', 'Nick Name'),
            'gender' => Yii::t('customer', 'Gender'),
            'birthday' => Yii::t('customer', 'Birthday'),
            'email' => Yii::t('customer', 'Email'),
            'telephone' => Yii::t('customer', 'Telephone'),
            'mobile_phone' => Yii::t('customer', 'Mobile'),
            'point' => Yii::t('customer', 'Point'),
            'default_address_id' => Yii::t('customer', 'Default Address'),
            'auth_key' => Yii::t('customer', 'Key'),
            'password_hash' => Yii::t('customer', 'Password'),
            'password_reset_token' => Yii::t('customer', 'Password Token'),
            'status' => Yii::t('customer', 'Stutas'),
            'created_at' => Yii::t('customer', 'Created At'),
            'updated_at' => Yii::t('customer', 'Updated At'),
            'last_login_at' => Yii::t('customer', 'Last Login At'),
            'password' => Yii::t('customer', 'Password'),
        ];
    }
    
    /**
     * 保存之前处理密码
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if($insert || !empty($this->password)) {
                $this->setPassword($this->password);
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 表关联
     */
    public function getCustomerGroup()
    {
        //管理员与其组，是一对一的关系
        return $this->hasOne(CustomerGroup::className(), ['id' => 'customer_group_id']);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
