<?php

namespace common\models\cms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cms\Ad;

/**
 * AdSearch represents the model behind the search form about `common\models\cms\Ad`.
 */
class AdSearch extends Ad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ad_type_id', 'order', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title', 'mode', 'pic_url', 'text', 'link_url'], 'safe'],
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
        $query = Ad::find()->alive();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'pagination' => [
        		//'pageSize' => static::MAX_PAGE_SIZE,
        	],
        	'sort' => [
        		'defaultOrder' => [
        			'updated_at' => SORT_DESC
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
            'ad_type_id' => $this->ad_type_id,
            'order' => $this->order,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'pic_url', $this->pic_url])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'link_url', $this->link_url]);

        return $dataProvider;
    }
}
