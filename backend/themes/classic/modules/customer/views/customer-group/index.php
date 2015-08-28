<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\customer\CustomerGroup;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Customer Group');
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
                <div class="tab-pane active customer-group-index">
                
                        
            <!-- 
                <p>
                    <?= Html::a(Yii::t('customer', 'Create Customer Group'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'name',
                        'description:ntext',
                        // 'sort',
                        [
                            //'class' => 'yii\grid\DataColumn',
                            'attribute' => 'is_default',
                            // 'filter' => [CustomerGroup::CUSTOMER_GROUP_IS_DEFAULT => Yii::t('common', 'Default'), CustomerGroup::CUSTOMER_GROUP_NOT_DEFAULT => Yii::t('common', 'Not Default')],
                            'value' => function($model){
                                return $model->is_default ? Yii::t('common', 'Default') : Yii::t('common', 'Not Default');
                            },
                        ], [
                            //'class' => 'yii\grid\DataColumn',
                            'attribute' => 'approval',
                            // 'filter' => [CustomerGroup::CUSTOMER_GROUP_PASSED => Yii::t('common', 'Passed'), CustomerGroup::CUSTOMER_GROUP_FORBID => Yii::t('common', 'Forbid')],
                            'value' => function($model){
                                return $model->approval ? Yii::t('common', 'Passed') : Yii::t('common', 'Forbid');
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



