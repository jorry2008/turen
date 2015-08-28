<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Index').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Index'), ['index']) ?>
               </li>
               <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Create').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Create'), ['create']) ?>
               </li>
               <li class="active">
                   <?= Html::a(Yii::t('common', 'View'), 'javascript:;') ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active product-view">
            <p>
                <?= Html::a(Yii::t('catalog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('catalog', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('catalog', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
                'attributes' => [
                    'id',
                    //'model',
                    'sku',
                    'name',
                    'keywords',
                    'brief',
                    'description:ntext',
                    [
                        'attribute' => 'category_id',
                        'value' => $model->category->name,
                    ], [
                        'attribute' => 'type',
                        'value' => '',
                    ], 
//                     [
//                         'attribute' => 'is_del',
//                         'format' => 'html',
//                         'value' => '<span class="label label-'.($model->is_del?'success':'danger').'">&nbsp;</span>',
//                     ], 
                    [
                        'attribute' => 'is_hot',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->is_hot?'success':'danger').'">&nbsp;</span>',
                    ], [
                        'attribute' => 'is_new',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->is_new?'success':'danger').'">&nbsp;</span>',
                    ], [
                        'attribute' => 'is_best',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->is_best?'success':'danger').'">&nbsp;</span>',
                    ], [
                        'attribute' => 'is_free_shipping',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->is_free_shipping?'success':'danger').'">&nbsp;</span>',
                    ],
                    'location',
                    'quantity',
                    'stock_status',
                    'image',
                    [
                        'attribute' => 'brand_id',
                        'value' => $model->brand->name,
                    ], [
                        'attribute' => 'shipping',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->shipping?'success':'danger').'">&nbsp;</span>',
                    ],
                    'price',
                    'market_price',
                    'shop_price',
                    [
                        'attribute' => 'is_promote',
                        'format' => 'html',
                        'value' => '<span class="label label-'.($model->is_promote?'success':'danger').'">&nbsp;</span>',
                    ],
                    'promote_price',
                    'promote_start_date:datetime',
                    'promote_end_date:datetime',
                    'points',
                    [
                        'attribute' => 'tax_class_id',
                        'value' => '',
                    ],
                    'date_available:datetime',
                    'weight',
                    'length',
                    'width',
                    'height',
                    'mini_mum',
                    'viewed',
                    'sort',
                    [
                        'attribute' => 'status',
                        'value' => $model->status ? Yii::t('common', 'On') : Yii::t('common', 'Off'),
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


