<?php

namespace common\models\cms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cms\CmsImg;

/**
 * CmsImgSearch represents the model behind the search form about `common\models\cms\CmsImg`.
 */
class CmsImgSearch extends CmsImg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cms_class_id', 'cms_flag_id', 'hits', 'status', 'updated_at', 'created_at'], 'integer'],
            [['title', 'colorval', 'boldval', 'source', 'author', 'link_url', 'keywords', 'description', 'content', 'pic_url', 'picarr'], 'safe'],
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
        $query = CmsImg::find()->alive();

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
            'cms_class_id' => $this->cms_class_id,
        	'cms_flag_id' => $this->cms_flag_id,
            'hits' => $this->hits,
            'status' => $this->status,
        	'deleted' => $this->deleted,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'colorval', $this->colorval])
            ->andFilterWhere(['like', 'boldval', $this->boldval])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'link_url', $this->link_url])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'pic_url', $this->pic_url])
            ->andFilterWhere(['like', 'picarr', $this->picarr]);

        return $dataProvider;
    }
}
