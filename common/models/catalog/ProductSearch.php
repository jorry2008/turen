<?php

namespace common\models\catalog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\catalog\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\catalog\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type', 'is_del', 'is_hot', 'is_new', 'is_best', 'is_free_shipping', 'quantity', 'brand_id', 'shipping', 'is_promote', 'promote_start_date', 'promote_end_date', 'points', 'tax_class_id', 'date_available', 'mini_mum', 'viewed', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['sku', 'name', 'keywords', 'brief', 'description', 'location', 'stock_status', 'image'], 'safe'],
            [['price', 'market_price', 'shop_price', 'promote_price', 'weight', 'length', 'width', 'height'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()->with('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'is_del' => $this->is_del,
            'is_hot' => $this->is_hot,
            'is_new' => $this->is_new,
            'is_best' => $this->is_best,
            'category_id' => $this->category_id,
            'is_free_shipping' => $this->is_free_shipping,
            'quantity' => $this->quantity,
            'brand_id' => $this->brand_id,
            'shipping' => $this->shipping,
            'price' => $this->price,
            'market_price' => $this->market_price,
            'shop_price' => $this->shop_price,
            'is_promote' => $this->is_promote,
            'promote_price' => $this->promote_price,
            'promote_start_date' => $this->promote_start_date,
            'promote_end_date' => $this->promote_end_date,
            'points' => $this->points,
            'tax_class_id' => $this->tax_class_id,
            'date_available' => $this->date_available,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'mini_mum' => $this->mini_mum,
            'viewed' => $this->viewed,
            'sort' => $this->sort,
            'status' => $this->status,
            'stock_status' => $this->stock_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        //->andFilterWhere(['like', 'model', $this->model])
        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
