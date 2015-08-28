<?php

namespace common\models\catalog;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property string $id
 * @property integer $category_id
 * @property string $model
 * @property string $sku
 * @property string $name
 * @property string $keywords
 * @property string $brief
 * @property string $description
 * @property integer $type
 * @property integer $is_del
 * @property integer $is_hot
 * @property integer $is_new
 * @property integer $is_best
 * @property integer $is_free_shipping
 * @property string $location
 * @property string $quantity
 * @property string $stock_status
 * @property string $image
 * @property string $brand_id
 * @property integer $shipping
 * @property string $price
 * @property string $market_price
 * @property string $shop_price
 * @property integer $is_promote
 * @property string $promote_price
 * @property string $promote_start_date
 * @property string $promote_end_date
 * @property string $points
 * @property string $tax_class_id
 * @property string $date_available
 * @property string $weight
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $mini_mum
 * @property string $viewed
 * @property string $sort
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    const PRODUCT_STATUS_ON = 1;
    const PRODUCT_STATUS_OFF = 0;
    
    const PRODUCT_IS_DEL = 1;
    const PRODUCT_NOT_DEL = 0;
    
    const PRODUCT_IS_HOT = 1;
    const PRODUCT_NOT_HOT = 0;
    
    const PRODUCT_IS_BEST = 1;
    const PRODUCT_NOT_BEST = 0;
    
    const PRODUCT_IS_FREE_SHIPPING = 1;
    const PRODUCT_NOT_FREE_SHIPPING = 0;
    
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
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sku', 'description', 'price', 'shop_price', 'weight'], 'required'],
            
            [['category_id', 'type', 'is_del', 'is_hot', 'is_new', 'is_best', 'is_free_shipping', 'quantity', 'brand_id', 'shipping', 'is_promote', 'mini_mum', 'viewed', 'status', 'created_at', 'updated_at'], 'integer'],
            
            //'date_available', 
            //'tax_class_id', 
            // 'sort',
            //, 'promote_start_date', 'promote_end_date'
            //'promote_price', 
            //'points', 
            
            [['description'], 'string'],
            [['price', 'market_price', 'shop_price', 'weight', 'length', 'width', 'height'], 'number'],
            [['sku'], 'string', 'max' => 64],
            [['name', 'stock_status'], 'string', 'max' => 120],
            [['keywords', 'brief', 'image'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'category_id' => Yii::t('catalog', 'Category ID'),
            'model' => Yii::t('catalog', 'Model'),
            'sku' => Yii::t('catalog', 'Sku'),
            'name' => Yii::t('catalog', 'Name'),
            'keywords' => Yii::t('catalog', 'Keywords'),
            'brief' => Yii::t('catalog', 'Brief'),
            'description' => Yii::t('catalog', 'Description'),
            'type' => Yii::t('catalog', 'Type'),
            'is_del' => Yii::t('catalog', 'Is Del'),
            'is_hot' => Yii::t('catalog', 'Is Hot'),
            'is_new' => Yii::t('catalog', 'Is New'),
            'is_best' => Yii::t('catalog', 'Is Best'),
            'is_free_shipping' => Yii::t('catalog', 'Is Free Shipping'),
            'location' => Yii::t('catalog', 'Location'),
            'quantity' => Yii::t('catalog', 'Quantity'),
            'stock_status' => Yii::t('catalog', 'Stock Status'),
            'image' => Yii::t('catalog', 'Image'),
            'brand_id' => Yii::t('catalog', 'Brand ID'),
            'shipping' => Yii::t('catalog', 'Shipping'),
            'price' => Yii::t('catalog', 'Price'),
            'market_price' => Yii::t('catalog', 'Market Price'),
            'shop_price' => Yii::t('catalog', 'Shop Price'),
            'is_promote' => Yii::t('catalog', 'Is Promote'),
            'promote_price' => Yii::t('catalog', 'Promote Price'),
            'promote_start_date' => Yii::t('catalog', 'Promote Start Date'),
            'promote_end_date' => Yii::t('catalog', 'Promote End Date'),
            'points' => Yii::t('catalog', 'Points'),
            'tax_class_id' => Yii::t('catalog', 'Tax Class ID'),
            'date_available' => Yii::t('catalog', 'Date Available'),
            'weight' => Yii::t('catalog', 'Weight'),
            'length' => Yii::t('catalog', 'Length'),
            'width' => Yii::t('catalog', 'Width'),
            'height' => Yii::t('catalog', 'Height'),
            'mini_mum' => Yii::t('catalog', 'Mini Mum'),
            'viewed' => Yii::t('catalog', 'Viewed'),
            'sort' => Yii::t('catalog', 'Sort'),
            'status' => Yii::t('catalog', 'Status'),
            'created_at' => Yii::t('catalog', 'Created At'),
            'updated_at' => Yii::t('catalog', 'Updated At'),
            
            'exemption_amount' => Yii::t('catalog', 'Exemption Amount'),
            'regulatory_category_mark' => Yii::t('catalog', 'Regulatory Category Mark'),
            'brand_country' => Yii::t('catalog', 'Brand Country'),
            'origin_country' => Yii::t('catalog', 'Origin Country'),
            'manu_facture' => Yii::t('catalog', 'Manu Facture'),
            'unit' => Yii::t('catalog', 'Unit'),
            'basis' => Yii::t('catalog', 'Basis'),
            'upc' => Yii::t('catalog', 'Upc'),
            'declare_category' => Yii::t('catalog', 'Declare Category'),
            'declare_value' => Yii::t('catalog', 'Declare Value'),
            'declare_name' => Yii::t('catalog', 'Declare Name'),
            'tax_rate' => Yii::t('catalog', 'Tax Rate'),
            'tax_code' => Yii::t('catalog', 'Tax Code'),
            'hs_code' => Yii::t('catalog', 'Hs Code'),
        ];
    }
    
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            //整理上传的图上路径
            $images = explode(',', $this->image);
            if(!empty($images)) {
                foreach ($images as $key=>$image) {
                    if(empty($image)) {
                        unset($images[$key]);
                    } else {
                        $images[$key] = trim($images[$key]);
                    }
                }
                $this->image = implode(',', $images);
            }
            
            $this->promote_end_date = strtotime(trim($this->promote_end_date));
            $this->promote_start_date = strtotime(trim($this->promote_start_date));
    
            return true;
        } else {
            return false;
        }
    }

    /**
     * 与产品分类联表
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    /**
     * 与产品分类联表
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
    
    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
