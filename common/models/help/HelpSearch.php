<?php

namespace common\models\help;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\help\Help;

/**
 * HelpSearch represents the model behind the search form about `common\models\help\Help`.
 */
class HelpSearch extends Help
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['title', 'short_code', 'user_content', 'dev_content', 'url'], 'safe'],
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
        $query = Help::find()->alive();

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
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
        	->andFilterWhere(['like', 'short_code', $this->short_code])
            ->andFilterWhere(['like', 'user_content', $this->user_content])
            ->andFilterWhere(['like', 'dev_content', $this->dev_content])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
