<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%extend_link_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_code
 * @property integer $order
 * @property integer $status
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 */
class LinkType extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
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
            [['order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
        	[['short_code'], 'string', 'max' => 50],
        	
        	[['name', 'short_code'], 'required'],
        	[['short_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('extend', 'ID'),
            'name' => Yii::t('extend', 'Name'),
        	'short_code' => Yii::t('extend', 'Short Code'),
            'order' => Yii::t('common', 'Order'),
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
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
