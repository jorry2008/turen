<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%cms_ad_type}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $parent_str
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property integer $order
 * @property integer $status
 */
class CmsAdType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_ad_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'width', 'height', 'order', 'status'], 'integer'],
            [['width', 'height'], 'required'],
            [['parent_str'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'parent_id' => Yii::t('cms', 'Parent ID'),
            'parent_str' => Yii::t('cms', 'Parent Str'),
            'name' => Yii::t('cms', 'Name'),
            'width' => Yii::t('cms', 'Width'),
            'height' => Yii::t('cms', 'Height'),
            'order' => Yii::t('cms', 'Order'),
            'status' => Yii::t('cms', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return CmsAdTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsAdTypeQuery(get_called_class());
    }
}
