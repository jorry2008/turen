<?php

namespace backend\modules\catalog\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use common\models\catalog\Product;
use common\models\catalog\ProductSearch;
use backend\components\Controller;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function actions()
    {
        return [
            'uploadify' => [
                'class' => 'backend\components\uploadify\UploadifyAction',
            ],
            'ueditor' => [
                'class' => \backend\components\ueditor\UeditorAction::className(),
            ]
        ];
    }
    
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * 以ajax的方式返回搜索到的用户信息，
     * 并返回定制后的select数据源
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionGetProduct()
    {
        if(Yii::$app->getRequest()->isAjax) {
            $params = Yii::$app->request->queryParams;
            $limit = isset($params['limit'])?$params['limit']:10;
    
            $model = new Product();
            $model->name = isset($params['q'])?$params['q']:'';
    
            $query = Product::find();
            $query->andFilterWhere(['like', 'name', $model->name]);
            $query->limit($limit);
    
            $models = $query->all();
            $products = [];
            foreach (ArrayHelper::map($models, 'id', 'name') as $key=>$value) {
                $products[] = ['id'=>$key, 'text'=>$value];
            }
            echo Json::encode(['status'=>0, 'msg'=>$products]);
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }
    
    /**
     * 以ajax的方式返回搜索到的产品详情
     * 并返回定制后的select数据源     
     * @return int id
     * @throws NotFoundHttpException
     */
    public function actionGetProductDetail()//联表查询
    {
        if(Yii::$app->getRequest()->isAjax) {
            $model = Product::findOne(Yii::$app->getRequest()->get('id', ''));
            if($model) {
                $productDetail = $model->attributes;
                $productDetail['cate_name'] = isset($model->category)?$model->category->name:Yii::t('common', 'Blank');
                $productDetail['brand_name'] = isset($model->brand)?$model->brand->name:Yii::t('common', 'Blank');
                
                echo Json::encode(['status'=>0, 'msg'=>$productDetail]);
                Yii::$app->end();
            } else {
                throw new NotFoundHttpException('404 This Is Ajax Page!');
            }
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
