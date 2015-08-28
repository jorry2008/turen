<?php

namespace backend\modules\customer\controllers;

use Yii;
use yii\base\Object;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use common\models\customer\Customer;
use common\models\customer\CustomerAddress;
use common\models\customer\CustomerAddressSearch;
use backend\components\Controller;

/**
 * CustomerAddressController implements the CRUD actions for CustomerAddress model.
 */
class CustomerAddressController extends Controller
{
    /**
     * Lists all CustomerAddress models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerAddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $customerModel = '';
        if(isset(Yii::$app->request->queryParams['CustomerAddressSearch']['customer_id'])) {
            $customerModel = Customer::findOne(Yii::$app->request->queryParams['CustomerAddressSearch']['customer_id']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'customerModel' => $customerModel,
        ]);
    }

    /**
     * Displays a single CustomerAddress model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => CustomerAddress::find()->with('customer')->where(['id'=>$id])->one(),//直接加载数据
        ]);
    }

    /**
     * Creates a new CustomerAddress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerAddress();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CustomerAddress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing CustomerAddress model.
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
     * 以ajax的方式返回搜索到的数据信息，用户地址
     * @param int $customer_id
     * @return array
     * @throws NotFoundHttpException
     * customer/customer-address/get-address
     */
    public function actionGetCustomerAddress($customer_id)
    {
        if(Yii::$app->getRequest()->isAjax) {
            $models = CustomerAddress::findAll(['customer_id'=>$customer_id]);
            $data = [];
            foreach (ArrayHelper::map($models, 'id', 'address') as $key=>$value) {
                $data[] = ['id'=>$key, 'text'=>$value];
            }
    
            echo Json::encode(['status'=>0, 'msg'=>$data]);
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }
    
    public function actionGetCustomerAddressDetail($address_id)
    {
        if(Yii::$app->getRequest()->isAjax) {
            $model = CustomerAddress::findOne($address_id);
            if($model) {
                echo Json::encode(['status'=>0, 'msg'=>$model->attributes]);
            } else {
                echo Json::encode(['status'=>1, 'msg'=>Yii::t('customer', 'Not found a address!')]);
            }
        } else {
            throw new NotFoundHttpException('404 This Is Ajax Page!');
        }
    }

    /**
     * Finds the CustomerAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
