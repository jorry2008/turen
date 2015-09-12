<?php

namespace common\models\extend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\extend\Message;

/**
 * MessageSearch represents the model behind the search form about `common\models\extend\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_top', 'is_recommend', 'order', 'status', 'deleted', 'created_at', 'updated_at'], 'integer'],
            [['nickname', 'contact', 'content', 'ip'], 'safe'],
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
        $query = Message::find()->alive();

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
            'is_top' => $this->is_top,
            'is_recommend' => $this->is_recommend,
            'order' => $this->order,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
