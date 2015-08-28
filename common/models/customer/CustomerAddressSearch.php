<?php

namespace common\models\customer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\customer\CustomerAddress;

/**
 * CustomerAddressSearch represents the model behind the search form about `common\models\customer\CustomerAddress`.
 */
class CustomerAddressSearch extends CustomerAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'district_id', 'city_id', 'province_id', 'country_id', 'created_at'], 'integer'],
            [['consignee', 'address', 'telephone', 'mobile_phone', 'postcode'], 'safe'],
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
        $query = CustomerAddress::find()->with('customer');

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
            'district_id' => $this->district_id,
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'country_id' => $this->country_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'postcode', $this->postcode]);

        return $dataProvider;
    }
}
