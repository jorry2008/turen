<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_link_type}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class LinkType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_link_type}}';
    }

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
    public function rules()
    {
        return [
            [['parent_id', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'parent_id' => Yii::t('extend', 'Parent ID'),
            'name' => Yii::t('extend', 'Name'),
            'order' => Yii::t('extend', 'Order'),
            'status' => Yii::t('extend', 'Status'),
            'deleted' => Yii::t('extend', 'Deleted'),
            'created_at' => Yii::t('extend', 'Created At'),
            'updated_at' => Yii::t('extend', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return LinkTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkTypeQuery(get_called_class());
    }
}
