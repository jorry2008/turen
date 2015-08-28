<?php

namespace common\models\auth;

use Yii;
use common\models\user\User;
use yii\rbac\Item;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('auth', 'Name'),
            'type' => Yii::t('auth', 'Type'),
            'description' => Yii::t('auth', 'Description'),
            'rule_name' => Yii::t('auth', 'Rule Name'),
            'data' => Yii::t('auth', 'Data'),
            'created_at' => Yii::t('auth', 'Created At'),
            'updated_at' => Yii::t('auth', 'Updated At'),
        ];
    }
    
    /**
     * 判断一个权限项有没有被后台管理员占用
     * @param string $role
     * @return boolean
     */
    public function isExist($role)
    {
        return User::find()->where(['role_name'=>$role])->exists();
    }
    
    /**
     * 删除一个权限项
     * @return boolean
     */
    public function deleteItem()
    {
        $authManager = Yii::$app->getAuthManager();
        if($this->type == Item::TYPE_PERMISSION) {
            $object = $authManager->getPermission($this->name);
        } elseif ($this->type == Item::TYPE_ROLE) {
            $object = $authManager->getRole($this->name);
        }
        
        return $authManager->remove($object);
    }
    
    /**
     * 创建一个权限项
     * @return boolean
     */
    public function createItem()
    {
        if($this->validate()) {
            $authManager = Yii::$app->getAuthManager();
            $object = new Item();
            $object->name = $this->name;
            $object->type = $this->type;
            $object->description = $this->description;
            return $authManager->add($object);
        } else {
            return false;
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//     public function getAuthItemChildren()
//     {
//         return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
//     }

    /**
     * @return \yii\db\ActiveQuery
     */
//     public function getAuthItemChildren0()
//     {
//         return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
//     }

    /**
     * @inheritdoc
     * @return AuthItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthItemQuery(get_called_class());
    }
}
