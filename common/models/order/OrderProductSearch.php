<?php

namespace common\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\OrderProduct;

/**
 * OrderProductSearch represents the model behind the search form about `common\models\order\OrderProduct`.
 */
class OrderProductSearch extends OrderProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_info_id', 'product_id', 'product_number', 'send_number', 'is_real', 'created_at', 'updated_at'], 'integer'],
            [['product_name', 'product_sku', 'product_attr', 'extension_code'], 'safe'],
            [['market_price', 'shop_price'], 'number'],
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
        $query = OrderProduct::find();

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
            'order_info_id' => $this->order_info_id,
            'product_id' => $this->product_id,
            'product_number' => $this->product_number,
            'market_price' => $this->market_price,
            'shop_price' => $this->shop_price,
            'send_number' => $this->send_number,
            'is_real' => $this->is_real,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_sku', $this->product_sku])
            ->andFilterWhere(['like', 'product_attr', $this->product_attr])
            ->andFilterWhere(['like', 'extension_code', $this->extension_code]);

        return $dataProvider;
    }
}
