<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%cms_flag}}".
 *
 * @property integer $id
 * @property string $flag
 * @property string $name
 * @property integer $order
 */
class CmsFlag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_flag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flag'], 'required'],
            [['order'], 'integer'],
            [['flag', 'name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cms', 'ID'),
            'flag' => Yii::t('cms', 'Flag'),
            'name' => Yii::t('cms', 'Name'),
            'order' => Yii::t('cms', 'Order'),
        ];
    }

    /**
     * @inheritdoc
     * @return CmsFlagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsFlagQuery(get_called_class());
    }
}
