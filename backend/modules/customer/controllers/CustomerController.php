<?php

namespace backend\modules\customer\controllers;

use Yii;
use common\models\customer\Customer;
// use common\models\customer\CustomerGroup;
use common\models\customer\CustomerSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use common\components\helpers\General;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        parent::behaviors();
        
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
    
    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer(['scenario' => 'create']);
        if(Yii::$app->request->post()) {
            $post = General::dateTimeAsInt(Yii::$app->request->post(), 'Customer', ['birthday']);
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //$model = (new Customer(['scenario' => 'update']))->findOne($id);
        $model = $this->findModel($id);
        $model->setScenario('update');
        
        if(Yii::$app->request->post()) {
            //时间转化
            $post = General::dateTimeAsInt(Yii::$app->request->post(), 'Customer', ['birthday']);
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
    public function actionGetCustomer()
    {
        if(Yii::$app->getRequest()->isAjax) {
            $searchModel = new CustomerSearch();
            $dataProvider = $searchModel->searchForAjax(Yii::$app->request->queryParams);
            
            $models = $dataProvider->getModels();
            $customers = [];
            foreach (ArrayHelper::map($models, 'id', 'username') as $key=>$value) {
                $customers[] = ['id'=>$key, 'text'=>$value];
            }
            echo Json::encode(['status'=>0, 'msg'=>$customers]);
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
