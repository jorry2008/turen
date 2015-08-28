<?php

namespace common\models\payment;

use Yii;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $fee
 * @property string $desc
 * @property string $config
 * @property integer $is_cod
 * @property integer $is_online
 * @property integer $order
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'config'], 'required'],
            [['desc', 'config'], 'string'],
            [['is_cod', 'is_online', 'order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 120],
            [['fee'], 'string', 'max' => 10],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('payment', 'ID'),
            'code' => Yii::t('payment', 'Code'),
            'name' => Yii::t('payment', 'Name'),
            'fee' => Yii::t('payment', 'Fee'),
            'desc' => Yii::t('payment', 'Desc'),
            'config' => Yii::t('payment', 'Config'),
            'is_cod' => Yii::t('payment', 'Is Cod'),
            'is_online' => Yii::t('payment', 'Is Online'),
            'order' => Yii::t('payment', 'Order'),
            'status' => Yii::t('payment', 'Status'),
            'updated_at' => Yii::t('payment', 'Updated At'),
            'created_at' => Yii::t('payment', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return PaymentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentQuery(get_called_class());
    }
}
