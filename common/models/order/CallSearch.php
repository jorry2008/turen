<?php

namespace common\models\order;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\order\Call;

/**
 * CallSearch represents the model behind the search form about `common\models\order\Call`.
 */
class CallSearch extends Call
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['username', 'contact', 'order_note'], 'safe'],
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
        $query = Call::find()->alive();

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
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'order_note', $this->order_note]);

        return $dataProvider;
    }
}
