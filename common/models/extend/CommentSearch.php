<?php

namespace common\models\extend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\extend\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\extend\Comment`.
 */
class CommentSearch extends Comment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'relative_id', 'mode', 'customer_id', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['customer_name', 'content', 'reply', 'link', 'ip'], 'safe'],
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
        $query = Comment::find()->alive();

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
            'relative_id' => $this->relative_id,
            'mode' => $this->mode,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'reply', $this->reply])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
