<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use common\helpers\General;
use common\models\catalog\Category;
use common\models\catalog\Product;

/* @var $this yii\web\View */
/* @var $searchModel common\models\catalog\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog', 'Products');
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
                <div class="tab-pane active product-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('catalog', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'name',
                            'shop_price:currency',
                            //'model',
                            'sku',
                            [
                                'attribute' => 'category_id',
                                'value' => function($model, $key, $index, $_this)
                                {
                                    return $model->getRelatedRecords()['category']->name;
                                },
                                'filter' => ArrayHelper::map(General::recursiveObj(Category::find()->orderBy(['sort'=>SORT_ASC])->all()), 'id', 'name'),
                            ],
                            // 'keywords',
                            // 'brief',
                            // 'description:ntext',
//                             'type',
                            [
                                'header' => Yii::t('catalog', 'Shortcut'),
                                'format' => 'raw',
                                'value' => function($model, $key, $index, $_this)
                                {
                                    $str = '';
                                    //$str .= '<a href="javascript:;" title="'.Yii::t('catalog', 'Is Del').'" data-id="'.$model->id.'" data-status="'.$model->is_del.'"><span class="label label-'.($model->is_del?'danger':'success').'">&nbsp;</span></a> ';
                                    $str .= '<a href="javascript:;" data-original-title="'.Yii::t('catalog', 'Is Promote').'" data-toggle="tooltip" data-id="'.$model->id.'" data-status="'.$model->is_promote.'"><span class="label label-'.($model->is_promote?'success':'danger').'">&nbsp;</span></a> ';
                                    $str .= '<a href="javascript:;" data-original-title="'.Yii::t('catalog', 'Is Hot').'" data-toggle="tooltip" data-id="'.$model->id.'" data-status="'.$model->is_hot.'"><span class="label label-'.($model->is_hot?'success':'danger').'">&nbsp;</span></a> ';
                                    $str .= '<a href="javascript:;" data-original-title="'.Yii::t('catalog', 'Is New').'" data-toggle="tooltip" data-id="'.$model->id.'" data-status="'.$model->is_new.'"><span class="label label-'.($model->is_new?'success':'danger').'">&nbsp;</span></a> ';
                                    $str .= '<a href="javascript:;" data-original-title="'.Yii::t('catalog', 'Is Best').'" data-toggle="tooltip" data-id="'.$model->id.'" data-status="'.$model->is_best.'"><span class="label label-'.($model->is_best?'success':'danger').'">&nbsp;</span></a> ';
                                    $str .= '<a href="javascript:;" data-original-title="'.Yii::t('catalog', 'Is Free Shipping').'" data-toggle="tooltip" data-id="'.$model->id.'" data-status="'.$model->is_free_shipping.'"><span class="label label-'.($model->is_free_shipping?'success':'danger').'">&nbsp;</span></a> ';
                                    
                                    return $str;
                                },
                            ],
                            
                            // 'is_del',
                            // 'is_hot',
                            // 'is_new',
                            // 'is_best',
                            // 'is_free_shipping',
                            
                            // 'location',
                            // 'quantity',
                            // 'stock_status',
                            // 'image',
                            // 'brand_id',
                            // 'shipping',
                            // 'price',
                            // 'market_price',
                            
                            // 'promote_price',
                            // 'promote_start_date',
                            // 'promote_end_date',
                            // 'points',
                            // 'tax_class_id',
                            'date_available:datetime',
                            // 'weight',
                            // 'length',
                            // 'width',
                            // 'height',
                            // 'mini_mum',
                            // 'viewed',
                            // 'sort',
                            'updated_at:datetime',
                            // 'created_at',
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => function($model, $key, $index, $_this)
                                {
                                    return '<span class="label label-'.($model->status?'success':'danger').'">&nbsp;</span>';
                                },
                                'filter' => [Product::PRODUCT_STATUS_ON=>Yii::t('catalog', 'Status On'), Product::PRODUCT_STATUS_OFF=>Yii::t('catalog', 'Status Off')],
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



