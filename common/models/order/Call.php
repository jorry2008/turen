<?php

namespace common\models\order;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

use common\models\account\Customer;

/**
 * This is the model class for table "{{%order_call}}".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $username
 * @property string $contact
 * @property string $call_note
 * @property string $ip
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
	
	const CALL_NAME = '搬家啦';
	
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
            [['call_note'], 'string', 'max' => 255],
        	[['ip'], 'safe'],
        	[['contact'], 'required']
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
            'call_note' => Yii::t('order', 'Call Note'),
        	'ip' => Yii::t('order', 'IP'),
            'deleted' => Yii::t('order', 'Deleted'),
        	'is_send' => Yii::t('order', 'Is Send'),
        	'is_view' => Yii::t('order', 'Is View'),
            'created_at' => Yii::t('order', 'Created At'),
            'updated_at' => Yii::t('order', 'Updated At'),
        ];
    }
    
    /**
     * 预约
     * @param array $params
     * @return number
     */
    public function call($params)
    {
    	$this->isNewRecord = true;//新建
    	$this->username = empty($params['name'])?'未知':$params['name'];
    	$this->contact = $params['phone'];
    	$this->ip = Yii::$app->getRequest()->userIP;
    	
    	//检查电话
//     	return 2;//电话有误
    	
    	
    	//判断用户是否登录
    	if(!Yii::$app->getUser()->isGuest) {//已经登录
    		$this->customer_id = Yii::$app->getUser()->id;
    	}
    	
    	//入库
    	$this->save(false);
    	
    	//通知
    	$this->sendCallMail();
    	
    	return 0;//入库成功
    }
    
    /**
     * 预约邮箱发送
     */
    public function sendCallMail()
    {
    	$form = array();
    	$form['name'] = $this->username;
    	$form['contact'] = $this->contact;
    	
    	//ArrayHelper::merge();
    	$to = explode(',', Yii::$app->params['config']['config_email_to']);
    	$bcc = Yii::$app->params['config']['config_email_bcc'];
    	
    	//, 'html' => 'call-html'
    	return Yii::$app->mailer->compose(['text' => 'call-text'], ['from' => $form])//内容整合？
		    	->setFrom([Yii::$app->params['config']['config_email_username']=>Yii::$app->name])//发送来源
		    	->setSubject(static::CALL_NAME)//邮件标题？
		    	->setTo($to)//发送对象邮箱？
		    	->setBcc($bcc)//密送邮箱
		    	->send();//发送
    }
    
    /**
     * 一对一
     */
    public function getCustomer()
    {
    	return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
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
