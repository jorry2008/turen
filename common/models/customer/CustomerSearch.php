<?php

namespace common\models\customer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\customer\Customer;

/**
 * CustomerSearch represents the model behind the search form about `common\models\customer\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_group_id', 'gender', 'birthday', 'point', 'default_address_id', 'status', 'created_at', 'updated_at', 'register_at', 'last_login_at'], 'integer'],
            [['username', 'nickname', 'email', 'telephone', 'mobile_phone', 'auth_key', 'password_hash', 'password_reset_token'], 'safe'],
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
        $query = Customer::find()->with('customerGroup');

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
            'customer_group_id' => $this->customer_group_id,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'point' => $this->point,
            'default_address_id' => $this->default_address_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'register_at' => $this->register_at,
            'last_login_at' => $this->last_login_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchForAjax($params)
    {
        $query = Customer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $limit = isset($params['limit'])?$params['limit']:10;
        $this->username = isset($params['q'])?$params['q']:'';
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->limit($limit);
        
        return $dataProvider;
    }
}
