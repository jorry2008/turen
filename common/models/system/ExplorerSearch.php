<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\Explorer;

/**
 * ExplorerSearch represents the model behind the search form about `common\models\system\Explorer`.
 */
class ExplorerSearch extends Explorer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_exsit', 'status', 'created_at', 'updated_at'], 'integer'],
            [['action', 'session', 'field', 'path', 'dir'], 'safe'],
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
        $query = Explorer::find();//->isExists();

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
            'is_exsit' => $this->is_exsit,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'session', $this->session])
            ->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'dir', $this->dir]);

        return $dataProvider;
    }
}
