<?php

namespace common\models\cms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cms\Download;

/**
 * DownloadSearch represents the model behind the search form about `common\models\cms\Download`.
 */
class DownloadSearch extends Download
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'column_id', 'hits', 'order', 'status', 'deleted', 'updated_at', 'created_at'], 'integer'],
            [['title', 'flag', 'colorval', 'boldval', 'file_type', 'language', 'accredit', 'file_size', 'unit', 'run_os', 'down_url', 'source', 'author', 'link_url', 'keywords', 'description', 'content', 'picurl', 'picarr'], 'safe'],
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
        $query = Download::find()->alive();

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
            'column_id' => $this->column_id,
            'hits' => $this->hits,
            'order' => $this->order,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
        	->andFilterWhere(['like', 'flag', $this->flag])
            ->andFilterWhere(['like', 'colorval', $this->colorval])
            ->andFilterWhere(['like', 'boldval', $this->boldval])
            ->andFilterWhere(['like', 'file_type', $this->file_type])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'accredit', $this->accredit])
            ->andFilterWhere(['like', 'file_size', $this->file_size])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'run_os', $this->run_os])
            ->andFilterWhere(['like', 'down_url', $this->down_url])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'link_url', $this->link_url])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'picurl', $this->picurl])
            ->andFilterWhere(['like', 'picarr', $this->picarr]);

        return $dataProvider;
    }
}
