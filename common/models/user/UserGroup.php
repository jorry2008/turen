<?php

namespace common\models\user;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%user_group}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property integer $is_default
 * @property string $sort
 * @property integer $status
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['sort', 'integer'],
            ['status', 'boolean'],
            ['status', 'default', 'value'=>true],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('user-group', 'Group Name'),
            'description' => Yii::t('user-group', 'Description'),
            'sort' => Yii::t('user-group', 'Sort'),
            'status' => Yii::t('user-group', 'Status'),
        ];
    }
    
    /**
     * 判断指定的管理员组中是否有管理员
     * @param mixed $ids
     * @return boolean
     */
    public function isExistUser(array $ids)
    {
        $rows = (new Query())
                ->select(['id'])
                ->from(User::tableName())
                ->where([
                    'user_group_id' => $ids,
                ])
                ->all();
        
        return !empty($rows); 
    }

    /**
     * @inheritdoc
     * @return UserGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserGroupQuery(get_called_class());
    }
}
