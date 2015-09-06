<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%cms_page}}".
 *
 * @property integer $id
 * @property integer $column_id
 * @property string $title
 * @property string $pic_url
 * @property string $content
 * @property string $order
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Page extends \yii\db\ActiveRecord
{
	const STATUS_YES = 1;
	const STATUS_NO = 0;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['pic_url'], 'string', 'max' => 100],
            
            [['column_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'column_id' => Yii::t('cms', 'Column'),
            'title' => Yii::t('cms', 'Title'),
            'pic_url' => Yii::t('cms', 'Pic Url'),
            'content' => Yii::t('cms', 'Content'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
            'updated_at' => Yii::t('cms', 'Updated At'),
            'created_at' => Yii::t('cms', 'Created At'),
        ];
    }
    
    /**
     * 一对一
     */
    public function getColumn()
    {
        return $this->hasOne(Column::className(), ['id' => 'column_id']);
    }

    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }
}
