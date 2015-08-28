<?php

namespace common\models\catalog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\catalog\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\catalog\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'top', 'column', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['keyword', 'brief', 'name', 'description', 'image'], 'safe'],
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
        $query = Category::find()->with('mySelf');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'class' => 'yii\data\Pagination',
                'defaultPageSize' => 16,
            ],
            'sort' => [
                'class' => 'yii\data\Sort',
                'defaultOrder' => [
                    'parent_id' => SORT_ASC,
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
            'parent_id' => $this->parent_id,
            'top' => $this->top,
            'column' => $this->column,
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
