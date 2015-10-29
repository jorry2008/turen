<?php

namespace common\models\extend;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\extend\LinkType;

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
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
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
    		],
    		'upload-file' => [
    			'class' => \backend\behaviors\UploadFileBehavior::className(),
    			'fileAttribute' => 'pic_url',
    		],
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
            [['link_url'], 'string', 'max' => 255],
        	
        	[['name', 'link_url'], 'required'],
        	[['link_url'], 'url'],
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
            'status' => Yii::t('common', 'Status'),
            'deleted' => Yii::t('common', 'Deleted'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
    
    /**
     * 一对一
     */
    public function getLinkType()
    {
    	return $this->hasOne(LinkType::className(), ['id' => 'link_type_id']);
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
