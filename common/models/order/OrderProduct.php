<?php

namespace common\models\order;

use Yii;
use yii\behaviors\TimestampBehavior;

use common\models\catalog\Product;
use common\models\catalog\Brand;
use common\models\catalog\Category;

/**
 * This is the model class for table "{{%order_product}}".
 *
 * @property string $id
 * @property string $order_info_id
 * @property string $product_id
 * @property string $product_name
 * @property string $product_sku
 * @property integer $product_number
 * @property string $market_price
 * @property string $shop_price
 * @property string $product_attr
 * @property integer $send_number
 * @property integer $is_real
 * @property string $extension_code
 */
class OrderProduct extends \yii\db\ActiveRecord
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
        return '{{%order_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_info_id', 'product_id', 'product_number', 'send_number', 'is_real'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['product_attr'], 'string'],
            [['product_name'], 'string', 'max' => 120],
            [['product_sku'], 'string', 'max' => 60],
            [['extension_code'], 'string', 'max' => 30],
            
            [['product_id', 'product_number', 'order_info_id'], 'required', 'on' => ['add_product']],
            [['product_number'], 'number', 'min' =>1, 'on' => ['add_product']],//大于0
        ];
    }
    
    /**
     * 指定入库和指定model属性接收的值
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'add_product' => ['product_id', 'product_number', 'order_info_id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'order_info_id' => Yii::t('order', 'Order Info ID'),
            'product_id' => Yii::t('order', 'Product ID'),
            'product_name' => Yii::t('order', 'Product Name'),
            'product_sku' => Yii::t('order', 'Product Sku'),
            'product_number' => Yii::t('order', 'Product Number'),
            'market_price' => Yii::t('order', 'Market Price'),
            'shop_price' => Yii::t('order', 'Shop Price'),
            'product_attr' => Yii::t('order', 'Product Attr'),
            'send_number' => Yii::t('order', 'Send Number'),
            'is_real' => Yii::t('order', 'Is Real'),
            'extension_code' => Yii::t('order', 'Extension Code'),
        ];
    }
    
    /**
     * 记录产品详情到订单产品中
     * @return boolean
     */
    public function productDetailToOrderProduct()
    {
//         $productModel = Product::find()->where(['id'=>$this->product_id])->with(['category', 'brand'])->one();
//         $categoryModel = $productModel->category;
//         $brandModel = $productModel->brand;

        $productModel = Product::findOne($this->product_id);
        $this->product_name = $productModel->name;
        $this->product_sku = $productModel->sku;
        $this->market_price = $productModel->market_price;
        $this->shop_price = $productModel->shop_price;
        $this->is_real = $productModel->is_real;
        return $this->save(false);//直接保存创建
    }

    /**
     * 一对一
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    
    /**
     * @inheritdoc
     * @return OrderProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderProductQuery(get_called_class());
    }
}
