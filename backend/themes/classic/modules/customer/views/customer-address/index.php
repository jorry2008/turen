<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\customer\CustomerAddress;

/* @var $this yii\web\View */
/* @var $searchModel common\models\customer\CustomerAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Customer Addresses');
if(isset($customerModel) && !empty($customerModel)) {
    fb($customerModel->username);
    $this->title = Yii::t('customer', '{username} Addresses', ['username' => $customerModel->username]);
}
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
               <li class="active">
                   <?= Html::a(Yii::t('common', 'Index'), 'javascript:;') ?>
               </li>
               <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Create').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Create'), ['create']) ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active customer-address-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                <!-- 
                    <p>
                        <?= Html::a(Yii::t('customer', 'Create Customer Address'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                 -->
            
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    
                    'options' => ['class' => 'grid-view box-body table-responsive no-padding'],//整个grid view样式//\yii\helpers\Html::renderTagAttributes()
                    'tableOptions' => ['class'=>'table table-hover table-striped table-bordered'],//表格总样式
                    
                    'headerRowOptions' => [],//头部单行样式//\yii\helpers\Html::renderTagAttributes()
                    'footerRowOptions' => [],//底部单行样式//\yii\helpers\Html::renderTagAttributes()
                    
                    'showHeader' => true,
                    'showFooter' => false,
                    
                    'layout' => "{summary}\n{errors}\n{items}\n{pager}",//布局
                    
                    'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
            
                        //'id',
                        [
                            'attribute' => 'customer.username',
                            'header' => Yii::t('customer', 'For Customer Name'),
                        ],
                        'consignee',
                        'country_id',
                        'province_id',
                        'district_id',
                        'city_id',
                        'address',
                        [
                            'attribute' => 'telephone',
                            'value' => function($model){
                                return $model->mobile_phone.'/'.$model->mobile_phone;
                            },
                        ], [
                            'attribute' => 'postcode',
                            'filter' => false
                        ], [
                            'attribute' => 'created_at',
                            'filter' => false,
                            'value' => function($model){
                                return Yii::$app->getFormatter()->asDatetime($model->created_at);
                            },
                        ], [
                            'attribute' => 'is_default',
                            'value' => function($model){
                                return $model->is_default ? Yii::t('common', 'Default') : Yii::t('common', 'Not Default');
                            },
                        ], [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Yii::t('common', 'Opration'),
                        ],
                    ],
                ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



