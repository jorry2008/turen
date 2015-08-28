<?php
namespace common\models\user;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $role_name
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        //, 'on' => ['create']
        return [
            [['username','realname','email','user_group_id','role_name'], 'required', 'on'=>['create','update']],
            ['password', 'required', 'on'=>['create']],
            [['username','realname','email','email'], 'filter', 'filter' => 'trim'],
            [['username','email'], 'unique', 'targetClass' => '\common\models\user\User', 'on'=>['create'], 'message' => Yii::t('user', 'Has already been taken.')],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['status', 'boolean'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['username', 'realname', 'email', 'password', 'user_group_id', 'status', 'role_name'],
            'update' => ['username', 'realname', 'email', 'password', 'user_group_id', 'status', 'role_name']
            //如果不让入库：'!username'
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'username' => Yii::t('user', 'User Name'),
            'realname' => Yii::t('user', 'Real Name'),
            'email' => Yii::t('user', 'Email'),
            'status' => Yii::t('user', 'Status'),
            'password' => Yii::t('user', 'Password'),
            'role_name' => Yii::t('user', 'Role Name'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }
    
    /**
     * 修改之前，如果没有修改权限的权力，而且又对权限进行了修改，则强制失败并提示
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)) {
            if($insert) {//新建插入
                //没有新建的权限(插入前检查)
//                 Yii::$app->getSession()->setFlash('denger', 'You do not have permission to modify the user permissions!');
//                 return false;
            } else {//更新
                if(!Yii::$app->getUser()->can('auth/auth')) {
                    //如果修改了权限则
                    if($this->getAttribute('role_name') != $this->getOldAttribute('role_name')) {
                        $this->setAttribute('role_name', $this->getOldAttribute('role_name'));//恢复并提示
                        Yii::$app->getSession()->setFlash('warning', 'You do not have permission to modify the user permissions!');
                    }
                }
            }
            
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 表关联
     */
    public function getUserGroup()
    {
        //管理员与其组，是一对一的关系
        return $this->hasOne(UserGroup::className(), ['id' => 'user_group_id'])->select(['name']);
    }
    
    /**
     * 返回用户的角色描述
     * @return string
     */
    public function getAuthDesByName()
    {
        $authManager = Yii::$app->getAuthManager();
        $role = $authManager->getRole($this->role_name);
    
        if($role)
            return $role->description;
        else
            return '';
    }
    
    /**
     * 创建更新用户授权操作
     * @param unknown $roleName
     */
    public function assignForUser()
    {
        $auth = Yii::$app->getAuthManager();
        $authorRole = $auth->getRole($this->role_name);
        $auth->assign($authorRole, $this->getId());
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 1]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
