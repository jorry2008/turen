<?php

namespace common\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\Info;

/**
 * InfoSearch represents the model behind the search form about `common\models\order\Info`.
 */
class InfoSearch extends Info
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'country', 'province', 'city', 'district', 'cms_ad_id', 'add_time', 'confirm_time', 'payment_time', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['order_no', 'consignee', 'address', 'zipcode', 'tel', 'mobile', 'email', 'order_note', 'referer', 'payment_note'], 'safe'],
            [['order_amount', 'discount'], 'number'],
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
        $query = Info::find()->alive();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => [
        		'defaultOrder' => [
        			'created_at' => SORT_DESC
        		],
        	],
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
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'order_amount' => $this->order_amount,
            'discount' => $this->discount,
            'cms_ad_id' => $this->cms_ad_id,
            'add_time' => $this->add_time,
            'confirm_time' => $this->confirm_time,
            'payment_time' => $this->payment_time,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'order_note', $this->order_note])
            ->andFilterWhere(['like', 'referer', $this->referer])
            ->andFilterWhere(['like', 'payment_note', $this->payment_note]);

        return $dataProvider;
    }
}
