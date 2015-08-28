<?php

namespace common\models\catalog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\catalog\Brand;

/**
 * BrandSearch represents the model behind the search form about `common\models\catalog\Brand`.
 */
class BrandSearch extends Brand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'image', 'desc', 'url'], 'safe'],
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
        $query = Brand::find();

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
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
