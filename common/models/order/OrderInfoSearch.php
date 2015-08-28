<?php

namespace common\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\OrderInfo;

/**
 * OrderInfoSearch represents the model behind the search form about `common\models\order\OrderInfo`.
 */
class OrderInfoSearch extends OrderInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'order_status', 'shipping_status', 'payment_status', 'country', 'province', 'city', 'district', 'shipping_id', 'payment_id', 'pack_id', 'card_id', 'point', 'bonus_id', 'from_ad', 'add_time', 'confirm_time', 'payment_time', 'shipping_time', 'extension_id', 'agency_id', 'is_separate', 'parent_id'], 'integer'],
            [['order_no', 'consignee', 'address', 'zipcode', 'tel', 'mobile', 'email', 'best_time', 'order_note', 'shipping_name', 'payment_name', 'how_oos', 'pack_name', 'card_name', 'card_message', 'inv_payee', 'inv_content', 'inv_type', 'referer', 'invoice_no', 'extension_code', 'to_buyer_note', 'payment_note'], 'safe'],
            [['payment_fee', 'pack_fee', 'card_fee', 'inv_tax', 'product_amount', 'shipping_fee', 'insure_fee', 'paid_rate', 'point_rate', 'bonus', 'order_amount', 'discount'], 'number'],
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
        $query = OrderInfo::find();

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
            'customer_id' => $this->customer_id,
            'order_status' => $this->order_status,
            'shipping_status' => $this->shipping_status,
            'payment_status' => $this->payment_status,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'shipping_id' => $this->shipping_id,
            'payment_id' => $this->payment_id,
            'payment_fee' => $this->payment_fee,
            'pack_id' => $this->pack_id,
            'pack_fee' => $this->pack_fee,
            'card_id' => $this->card_id,
            'card_fee' => $this->card_fee,
            'inv_tax' => $this->inv_tax,
            'product_amount' => $this->product_amount,
            'shipping_fee' => $this->shipping_fee,
            'insure_fee' => $this->insure_fee,
            'paid_rate' => $this->paid_rate,
            'point' => $this->point,
            'point_rate' => $this->point_rate,
            'bonus' => $this->bonus,
            'bonus_id' => $this->bonus_id,
            'order_amount' => $this->order_amount,
            'from_ad' => $this->from_ad,
            'add_time' => $this->add_time,
            'confirm_time' => $this->confirm_time,
            'payment_time' => $this->payment_time,
            'shipping_time' => $this->shipping_time,
            'extension_id' => $this->extension_id,
            'agency_id' => $this->agency_id,
            'is_separate' => $this->is_separate,
            'parent_id' => $this->parent_id,
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'best_time', $this->best_time])
            ->andFilterWhere(['like', 'order_note', $this->order_note])
            ->andFilterWhere(['like', 'shipping_name', $this->shipping_name])
            ->andFilterWhere(['like', 'payment_name', $this->payment_name])
            ->andFilterWhere(['like', 'how_oos', $this->how_oos])
            ->andFilterWhere(['like', 'pack_name', $this->pack_name])
            ->andFilterWhere(['like', 'card_name', $this->card_name])
            ->andFilterWhere(['like', 'card_message', $this->card_message])
            ->andFilterWhere(['like', 'inv_payee', $this->inv_payee])
            ->andFilterWhere(['like', 'inv_content', $this->inv_content])
            ->andFilterWhere(['like', 'inv_type', $this->inv_type])
            ->andFilterWhere(['like', 'referer', $this->referer])
            ->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
            ->andFilterWhere(['like', 'extension_code', $this->extension_code])
            ->andFilterWhere(['like', 'to_buyer_note', $this->to_buyer_note])
            ->andFilterWhere(['like', 'payment_note', $this->payment_note]);

        return $dataProvider;
    }
}
