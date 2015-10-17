<?php

namespace common\models\extend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\extend\Link;

/**
 * LinkSearch represents the model behind the search form about `common\models\extend\Link`.
 */
class LinkSearch extends Link
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'link_type_id', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'pic_url', 'link_url'], 'safe'],
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
        $query = Link::find()->alive();

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
            'link_type_id' => $this->link_type_id,
            'order' => $this->order,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'pic_url', $this->pic_url])
            ->andFilterWhere(['like', 'link_url', $this->link_url]);

        return $dataProvider;
    }
}
