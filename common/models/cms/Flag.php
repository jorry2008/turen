<?php

namespace common\models\cms;

use Yii;

/**
 * This is the model class for table "{{%flag}}".
 *
 * @property integer $id
 * @property string $flag
 * @property string $name
 * @property integer $order
 */
class Flag extends \yii\db\ActiveRecord
{
	const FLAG_G = 'g';//普通
	const FLAG_H = 'h';//头条
	const FLAG_C = 'c';//推荐
	const FLAG_F = 'f';//幻灯
	const FLAG_A = 'a';//特荐
	const FLAG_S = 's';//滚动
	const FLAG_J = 'j';//跳转
	
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
            [['order', 'flag_id', 'deleted'], 'integer'],
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
        	'deleted' => Yii::t('cms', 'Deleted'),
            'order' => Yii::t('cms', 'Order'),
        ];
    }

    /**
     * @inheritdoc
     * @return FlagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FlagQuery(get_called_class());
    }
}
