<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

use common\models\extend\Nav;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('extend', 'Nav List');
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
                <div class="tab-pane active nav-index">
                
		            <!-- 
		                <p>
		                    <?= Html::a(Yii::t('extend', 'Create Nav'), ['create'], ['class' => 'btn btn-success']) ?>
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
	                    
	                    'columns' => [
	                        ['class' => 'yii\grid\SerialColumn'],
	// 			                'id',
	                    		[
		                    		'attribute' => 'name',
		                    		'format' => 'html',
		                    		'value' => function($model){
	                    				return Html::a($model->name, ['update', 'id'=>$model->id], ['data-pjax' => '0']);
		                    		},
	                    		],
	// 				            'parent_id',
					            'link_url',
	// 				            're_link_url:url',
					            // 'pic_url:url',
					            'target',
					            [
						            'attribute' => 'order',
						            'format' => 'raw',
						            'value' => function($model){
						            	return Html::activeTextInput($model, 'order', ['style'=>'width:50px', 'data-id'=>$model->id, 'id'=>'', 'class'=>'cms-order']);
						            },
					            ], [
						            'attribute' => 'status',
						            'format' => 'html',
						            'filter' => [Nav::STATUS_YES=>Yii::t('common', 'Yes'), Nav::STATUS_NO=>Yii::t('common', 'No')],
						            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
						            'value' => function($model){
						            	$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-status', 'id'=>$model->id], ['title'=>Yii::t('common', 'Update Status'),'data-pjax' => '0']);
						            	$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-status', 'id'=>$model->id], ['title'=>Yii::t('common', 'Update Status'),'data-pjax' => '0']);
						            	return $model->status?$on:$off;
						            },
					            ],
					            // 'deleted',
					            // 'created_at',
					            'created_at:datetime',
	            
	                        [
	                            'class' => 'yii\grid\ActionColumn',
	                        	'template' => '{delete}',
	                            'header' => Yii::t('common', 'Opration'),
	                        ],
	                    ],
	                ]); ?>
					<?php Pjax::end() ?>
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



