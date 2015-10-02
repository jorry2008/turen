<?php
namespace common\models\account;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_customer = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    		'username' => Yii::t('model', '用户名'),
    		'password' => Yii::t('model', '密码'),
    	];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getCustomer();//验证用户是否存在
            if (!$user || !$user->validatePassword($this->password)) {//校验：用户存在，并且密码验证成功
            	
            	//仅仅告诉用户，登录失败，不需要回复太多东西
                $this->addError($attribute, Yii::t('model', '用户名或密码错误。'));
            }
        } else {
        	//相关错误
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {//这一步，已经实现了登录验证
        	//fb('验证之后');
        	//这一步只是将认证以指定的方式记录下来即可。即作登录的操作
            return Yii::$app->getUser()->login($this->getCustomer(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getCustomer()
    {
        if ($this->_customer === false) {
            $this->_customer = Customer::findByUsername($this->username);
        }

        return $this->_customer;
    }
}
