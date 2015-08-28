<?php

namespace common\models\cms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cms\CmsAd;

/**
 * CmsAdSearch represents the model behind the search form about `common\models\cms\CmsAd`.
 */
class CmsAdSearch extends CmsAd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cms_ad_type_id', 'order', 'status', 'updated_at', 'created_at'], 'integer'],
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
        $query = CmsAd::find();

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
            'cms_ad_type_id' => $this->cms_ad_type_id,
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
