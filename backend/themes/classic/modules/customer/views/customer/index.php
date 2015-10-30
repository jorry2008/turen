<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\customer\Customer;
use common\models\customer\CustomerGroup;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\customer\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Customer');
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
               <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Adress Admin').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('customer', 'Adress Admin'), ['/customer/customer-address/index'], ['target'=>'_blank']) ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active customer-index">
                
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                <!-- 
                    <p>
                        <?= Html::a(Yii::t('customer', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                 -->
            	<?php Pjax::begin() ?>
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
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        'username',
                        //'nickname',
                        [
                            //'class' => 'yii\grid\DataColumn',
                            'attribute' => 'gender',
                            'filter' => [Customer::CUSTOMER_MALE => Yii::t('common', 'Male'), Customer::CUSTOMER_FEMALE => Yii::t('common', 'Female')],
                            'value' => function($model){
                                return $model->status ? Yii::t('common', 'Male') : Yii::t('common', 'Female');
                            },
                        ],
                        'birthday:date',
                        'email:email',
                        // 'telephone',
                        // 'mobile_phone',
                        [
	                       //'class' => 'yii\grid\DataColumn',
                            'attribute' => 'point',
                            'filter' => false//禁用filter
                        ], [
                            'attribute' => 'customerGroup.name',
                            'filter' => ArrayHelper::map(CustomerGroup::find()->all(), 'id', 'name'),
                        ],
                        // 'default_address_id',
                        // 'auth_key',
                        // 'password_hash',
                        // 'password_reset_token',
                        [
                            //'class' => 'yii\grid\DataColumn',
                            'attribute' => 'status',
                            'filter' => [Customer::CUSTOMER_ON => Yii::t('common', 'On'), Customer::CUSTOMER_OFF => Yii::t('common', 'Off')],
                            'value' => function($model){
                                return $model->status ? Yii::t('common', 'On') : Yii::t('common', 'Off');
                            },
                        ],
                        // 'created_at',
                        // 'updated_at',
                        // 'register_at',
                        'last_login_at:datetime',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Yii::t('common', 'Opration'),
                            
                            'template' => '{view} {update} {delete} {address} {new_address}',
                            'buttons' => [
                                'address' => function ($url, $model, $key) {
                                    $url = ['/customer/customer-address/index', 'CustomerAddressSearch[customer_id]'=>$model->id];//用户id取用户地址
                                    $options = [
                                        'title' => Yii::t('customer', 'View Address'),
                                        'aria-label' => Yii::t('customer', 'View Address'),
                                        'data-pjax' => '0',
                                        'target' => '_blank',
                                    ];
                                    return Html::a('<span class="ion-map"></span>', $url, $options);
                                }, 
                                'new_address' => function ($url, $model, $key) {
                                    $url = ['/customer/customer-address/create', 'customer_id'=>$model->id];//用户id取用户地址
                                    $options = [
                                        'title' => Yii::t('customer', 'Add New Address'),
                                        'aria-label' => Yii::t('customer', 'Add New Address'),
                                        'data-pjax' => '0',
                                        'target' => '_blank',
                                    ];
                                    return Html::a('<span class="ion-ios-plus"></span>', $url, $options);
                                }
                            ],
                        ]
                    ],
                ]); ?>
				<?php Pjax::end() ?>
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



