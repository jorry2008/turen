<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\CascadeData;

/**
 * CascadeDataSearch represents the model behind the search form about `common\models\system\CascadeData`.
 */
class CascadeDataSearch extends CascadeData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'data_group', 'updated_at'], 'integer'],
            [['name'], 'safe'],
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
        $query = CascadeData::find()->with('mySelf');

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
            'parent_id' => $this->parent_id,
            'level' => $this->level,
            'data_group' => $this->data_group,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchForAjax($params)
    {
        $query = CascadeData::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        $limit = isset($params['limit'])?$params['limit']:10;
        $this->name = isset($params['q'])?$params['q']:'';
    
        if (!$this->validate()) {
            return $dataProvider;
        }
    
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->limit($limit);
    
        return $dataProvider;
    }
}
