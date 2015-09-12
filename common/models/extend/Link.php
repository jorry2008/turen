<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_link}}".
 *
 * @property integer $id
 * @property integer $link_type_id
 * @property string $name
 * @property string $description
 * @property string $pic_url
 * @property string $link_url
 * @property integer $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%extend_link}}';
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
            [['link_type_id', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 200],
            [['pic_url'], 'string', 'max' => 100],
            [['link_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'link_type_id' => Yii::t('extend', 'Link Type ID'),
            'name' => Yii::t('extend', 'Name'),
            'description' => Yii::t('extend', 'Description'),
            'pic_url' => Yii::t('extend', 'Pic Url'),
            'link_url' => Yii::t('extend', 'Link Url'),
            'order' => Yii::t('extend', 'Order'),
            'status' => Yii::t('extend', 'Status'),
            'deleted' => Yii::t('extend', 'Deleted'),
            'created_at' => Yii::t('extend', 'Created At'),
            'updated_at' => Yii::t('extend', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return LinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinkQuery(get_called_class());
    }
}
