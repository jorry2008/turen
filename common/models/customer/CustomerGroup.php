<?php

namespace common\models\customer;

use Yii;

/**
 * This is the model class for table "{{%customer_group}}".
 *
 * @property integer $id
 * @property integer $approval
 * @property string $name
 * @property string $description
 * @property integer $is_default
 * @property integer $sort
 */
class CustomerGroup extends \yii\db\ActiveRecord
{
    const CUSTOMER_GROUP_PASSED = 1;//通过
    const CUSTOMER_GROUP_FORBID = 0;//禁止
    
    const CUSTOMER_GROUP_IS_DEFAULT = 1;//默认
    const CUSTOMER_GROUP_NOT_DEFAULT = 0;//不是默认
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approval', 'is_default', 'sort'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'approval' => Yii::t('customer', 'Approval'),
            'name' => Yii::t('customer', 'Name'),
            'description' => Yii::t('customer', 'Description'),
            'is_default' => Yii::t('customer', 'Default'),
            'sort' => Yii::t('customer', 'Sort'),
        ];
    }
    
    /**
     * @see \yii\db\BaseActiveRecord::beforeSave($insert)
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            //如果设置为默认，应该取消其它默认，默认只有一个
            if($this->is_default) {
                CustomerGroup::updateAll(['is_default'=>self::CUSTOMER_GROUP_NOT_DEFAULT]);
            }
            
            return true;
        } else {
            return false;
        }
    }
}
