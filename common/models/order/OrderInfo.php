<?php

namespace common\models\order;

use Yii;
use yii\behaviors\TimestampBehavior;

use common\models\order\OrderProduct;

/**
 * This is the model class for table "{{%order_info}}".
 *
 * @property string $id
 * @property string $order_no
 * @property string $customer_id
 * @property integer $order_status
 * @property integer $shipping_status
 * @property integer $payment_status
 * @property string $consignee
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $tel
 * @property string $mobile
 * @property string $email
 * @property string $best_time
 * @property string $order_note
 * @property integer $shipping_id
 * @property string $shipping_name
 * @property integer $payment_id
 * @property string $payment_name
 * @property string $payment_fee
 * @property string $how_oos
 * @property integer $pack_id
 * @property string $pack_name
 * @property string $pack_fee
 * @property integer $card_id
 * @property string $card_name
 * @property string $card_message
 * @property string $card_fee
 * @property string $inv_payee
 * @property string $inv_content
 * @property string $inv_tax
 * @property string $inv_type
 * @property string $product_amount
 * @property string $shipping_fee
 * @property string $insure_fee
 * @property string $paid_rate
 * @property string $point
 * @property string $point_rate
 * @property string $bonus
 * @property integer $bonus_id
 * @property string $order_amount
 * @property integer $from_ad
 * @property string $referer
 * @property string $add_time
 * @property string $confirm_time
 * @property string $payment_time
 * @property string $shipping_time
 * @property string $invoice_no
 * @property string $extension_code
 * @property string $extension_id
 * @property string $to_buyer_note
 * @property string $payment_note
 * @property integer $agency_id
 * @property integer $is_separate
 * @property string $parent_id
 * @property string $discount
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * 行为处理时间
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
    public static function tableName()
    {
        return '{{%order_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_status', 'shipping_status', 'payment_status', 'country', 'province', 'city', 'district', 'shipping_id', 'payment_id', 'pack_id', 'card_id', 'point', 'bonus_id', 'from_ad', 'add_time', 'confirm_time', 'payment_time', 'shipping_time', 'extension_id', 'agency_id', 'is_separate', 'parent_id'], 'integer'],
            [['payment_fee', 'pack_fee', 'card_fee', 'inv_tax', 'product_amount', 'shipping_fee', 'insure_fee', 'paid_rate', 'point_rate', 'bonus', 'order_amount', 'discount'], 'number'],
            [['order_no'], 'string', 'max' => 20],
            [['consignee', 'zipcode', 'tel', 'mobile', 'email', 'inv_type'], 'string', 'max' => 60],
            [['address', 'order_note', 'card_message', 'referer', 'to_buyer_note', 'payment_note'], 'string', 'max' => 255],
            [['best_time', 'shipping_name', 'payment_name', 'how_oos', 'pack_name', 'card_name', 'inv_payee', 'inv_content'], 'string', 'max' => 120],
            [['invoice_no'], 'string', 'max' => 50],
            [['extension_code'], 'string', 'max' => 30],
            [['order_no'], 'unique'],
            
            [['order_no'], 'required', 'on' => ['order_guset_customer']],
            [['customer_id', 'order_no'], 'required', 'on' => ['order_customer']],
            [['consignee', 'country', 'address', 'email'], 'required', 'on' => ['order_address']],
            
//             [[''], 'required', 'on' => ['create']],
//             [[''], 'required', 'on' => ['create']],
//             [[''], 'required', 'on' => ['create']],
//             [[''], 'required', 'on' => ['create']],
        ];
    }
    
    /**
     * 指定入库和指定model属性接收的值
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'order_guset_customer' => ['order_no', 'status'],
            'order_customer' => ['customer_id', 'order_no', 'status'],
            'order_address' => ['consignee', 'country', 'province', 'city', 'address', 'email', 'tel', 'mobile', 'zipcode', 'best_time'],
            
//             
//             'order_ship' => ['', ''],
//             'order_pay' => ['', ''],
//             'order_inv' => ['', ''],
            'order_amount' => ['discount', 'inv_tax', 'point_rate', 'shipping_fee', 'paid_rate', 'pack_fee', 'insure_fee', 'payment_fee', 'order_amount'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'order_no' => Yii::t('order', 'Order No'),
            'customer_id' => Yii::t('order', 'Customer ID'),
            'order_status' => Yii::t('order', 'Order Status'),
            'shipping_status' => Yii::t('order', 'Shipping Status'),
            'payment_status' => Yii::t('order', 'Payment Status'),
            'consignee' => Yii::t('order', 'Consignee'),
            'country' => Yii::t('order', 'Country'),
            'province' => Yii::t('order', 'Province'),
            'city' => Yii::t('order', 'City'),
            'district' => Yii::t('order', 'District'),
            'address' => Yii::t('order', 'Address'),
            'zipcode' => Yii::t('order', 'Zipcode'),
            'tel' => Yii::t('order', 'Tel'),
            'mobile' => Yii::t('order', 'Mobile'),
            'email' => Yii::t('order', 'Email'),
            'best_time' => Yii::t('order', 'Best Time'),
            'order_note' => Yii::t('order', 'Order Note'),
            'shipping_id' => Yii::t('order', 'Shipping ID'),
            'shipping_name' => Yii::t('order', 'Shipping Name'),
            'payment_id' => Yii::t('order', 'Payment ID'),
            'payment_name' => Yii::t('order', 'Payment Name'),
            'payment_fee' => Yii::t('order', 'Payment Fee'),
            'how_oos' => Yii::t('order', 'How Oos'),
            'pack_id' => Yii::t('order', 'Pack ID'),
            'pack_name' => Yii::t('order', 'Pack Name'),
            'pack_fee' => Yii::t('order', 'Pack Fee'),
            'card_id' => Yii::t('order', 'Card ID'),
            'card_name' => Yii::t('order', 'Card Name'),
            'card_message' => Yii::t('order', 'Card Message'),
            'card_fee' => Yii::t('order', 'Card Fee'),
            'inv_payee' => Yii::t('order', 'Inv Payee'),
            'inv_content' => Yii::t('order', 'Inv Content'),
            'inv_tax' => Yii::t('order', 'Inv Tax'),
            'inv_type' => Yii::t('order', 'Inv Type'),
            'product_amount' => Yii::t('order', 'Product Amount'),
            'shipping_fee' => Yii::t('order', 'Shipping Fee'),
            'insure_fee' => Yii::t('order', 'Insure Fee'),
            'paid_rate' => Yii::t('order', 'Paid Rate'),
            'point' => Yii::t('order', 'Point'),
            'point_rate' => Yii::t('order', 'Point Rate'),
            'bonus' => Yii::t('order', 'Bonus'),
            'bonus_id' => Yii::t('order', 'Bonus ID'),
            'order_amount' => Yii::t('order', 'Order Amount'),
            'from_ad' => Yii::t('order', 'From Ad'),
            'referer' => Yii::t('order', 'Referer'),
            'add_time' => Yii::t('order', 'Add Time'),
            'confirm_time' => Yii::t('order', 'Confirm Time'),
            'payment_time' => Yii::t('order', 'Payment Time'),
            'shipping_time' => Yii::t('order', 'Shipping Time'),
            'invoice_no' => Yii::t('order', 'Invoice No'),
            'extension_code' => Yii::t('order', 'Extension Code'),
            'extension_id' => Yii::t('order', 'Extension ID'),
            'to_buyer_note' => Yii::t('order', 'To Buyer Note'),
            'payment_note' => Yii::t('order', 'Payment Note'),
            'agency_id' => Yii::t('order', 'Agency ID'),
            'is_separate' => Yii::t('order', 'Is Separate'),
            'parent_id' => Yii::t('order', 'Parent ID'),
            'discount' => Yii::t('order', 'Discount'),
        ];
    }
    
    /**
     * 一对多
     */
    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::className(), ['order_info_id' => 'id']);
    }
    
    /**
     * 调整订单总额
     * @param int $order_id
     */
    public function adjustProductAmount($order_id)
    {
        $productAmount = OrderProduct::find()->where(['order_info_id'=>$order_id])->sum('shop_price*product_number');
        if($productAmount) {
            $this->product_amount = $productAmount;
            $this->update(false);
        }
    }
    
    /**
     * 判断当前订单是否是易极付
     */
    public function isYjf()
    {
        return ($this->payment_name == '易极付');
    }
    
    /**
     * 计算订单总额，算法如下：
     * （产品总金额 - 折扣金额） + 发票税额 + 配送费用 + 保价费用 + 支付费用 + 包装费用 + 贺卡费用 = 订单总金额
     * @param array $orderInfo
     * @return number
     */
    public static function calculateOrderTotal(array $orderInfo)
    {
        $product_amount = empty($orderInfo['product_amount'])?0:$orderInfo['product_amount'];//产品总额
        $discount = empty($orderInfo['discount'])?0:$orderInfo['discount'];//折扣金额
        $inv_tax = empty($orderInfo['inv_tax'])?0:$orderInfo['inv_tax'];//发票税费
        $shipping_fee = empty($orderInfo['shipping_fee'])?0:$orderInfo['shipping_fee'];//物流费
        $insure_fee = empty($orderInfo['insure_fee'])?0:$orderInfo['insure_fee'];//保价费
        $payment_fee = empty($orderInfo['payment_fee'])?0:$orderInfo['payment_fee'];//支付手续费
        $pack_fee = empty($orderInfo['pack_fee'])?0:$orderInfo['pack_fee'];//打包费
        
        $order_amount = $product_amount - $discount + $inv_tax + $shipping_fee + $insure_fee + $payment_fee + $pack_fee;//订单总额（最终的价格）
        
        return $order_amount;
    }
    
    /**
     * 计算订单应付款金额，算法如下：
     * 订单总金额 - 已付款金额 - 使用余额 - 使用积分 - 使用红包 = 应付款金额
     * @param array $orderInfo
     * @return number
     */
    public static function calculatePayableOrderTotal(array $orderInfo)
    {
        $order_amount = static::calculateOrderTotal($orderInfo);
        $point_rate = empty($orderInfo['point_rate'])?0:$orderInfo['point_rate'];//积分
        $paid_rate = empty($orderInfo['paid_rate'])?0:$orderInfo['paid_rate'];//已付款
        
        return $order_amount - $point_rate - $paid_rate;
    }

    /**
     * @inheritdoc
     * @return OrderInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderInfoQuery(get_called_class());
    }
}
