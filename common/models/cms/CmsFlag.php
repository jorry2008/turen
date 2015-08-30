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
	const FLAG_G = 0;//普通
	const FLAG_H = 1;//头条
	const FLAG_C = 2;//推荐
	const FLAG_F = 3;//幻灯
	const FLAG_A = 4;//特荐
	const FLAG_S = 5;//滚动	
	const FLAG_J = 6;//跳转
	
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
            [['order', 'cms_flag_id'], 'integer'],
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
            'flag' => Yii::t('cms', 'Flag'),
            'name' => Yii::t('cms', 'Flag Name'),
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
