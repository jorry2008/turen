<?php

namespace common\models\shipping;

use Yii;

/**
 * This is the model class for table "{{%shipping}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $desc
 * @property string $insure
 * @property integer $support_cod
 * @property integer $order
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shipping}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['support_cod', 'order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 120],
            [['desc'], 'string', 'max' => 255],
            [['insure'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shipping', 'ID'),
            'code' => Yii::t('shipping', 'Code'),
            'name' => Yii::t('shipping', 'Name'),
            'desc' => Yii::t('shipping', 'Desc'),
            'insure' => Yii::t('shipping', 'Insure'),
            'support_cod' => Yii::t('shipping', 'Support Cod'),
            'order' => Yii::t('shipping', 'Order'),
            'status' => Yii::t('shipping', 'Status'),
            'updated_at' => Yii::t('shipping', 'Updated At'),
            'created_at' => Yii::t('shipping', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return ShippingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShippingQuery(get_called_class());
    }
}
