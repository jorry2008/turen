<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Cms Classe List');
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
                <div class="tab-pane active cms-class-index">
                
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('cms', 'Create Cms Class'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            ['class' => 'yii\grid\SerialColumn'],
                
                            'id',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'attribute' => 'name',
                                'format' => 'html',
                                'value' => function($model){
                                	$type = !empty($model->cmsType[$model->type])?$model->cmsType[$model->type]:Yii::t('cms', 'Top Class');
                                    return $model->name.'<i class="type">['.$type.']</i>';
                                },
                            ],
//                             'parent_id',
//                             'parent_str',
//                             [
//                                 'class' => 'yii\grid\DataColumn',
//                                 'attribute' => 'type',
//                                 //'format' => 'html',
//                                 'value' => function($model){
//                                     return !empty($model->cmsType[$model->type])?$model->cmsType[$model->type]:Yii::t('cms', 'Top Class');
//                                 },
//                             ],
                            // 'link_url:url',
                            // 'pic_url:url',
                            // 'pic_width',
                            // 'pic_height',
                            // 'seo_title',
                            // 'keywords',
                            // 'description',
                            [
	                            'attribute' => 'order',
	                            'format' => 'raw',
	                            'value' => function($model){
	                            	return Html::activeTextInput($model, 'order', ['style'=>'width:50px', 'data-id'=>$model->id]);
	                            },
                            ], [
// 	                            'class' => 'yii\grid\DataColumn',
	                            'attribute' => 'status',
	                            'format' => 'html',
	                            'value' => function($model){
	                            	$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
	                            	$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
	                            	return $model->status?$on:$off;
	                            },
                            ],
                			'updated_at:datetime',
                            [
	                            'class' => 'yii\grid\ActionColumn',
	                            'header' => Yii::t('common', 'Opration'),
	                            
	                            'template' => '{add} {view} {update} {delete}',
	                            'buttons' => [
                            		'add' => function ($url, $model, $key) {
                            			$url = ['create', 'id'=>$model->id];
                            			$options = [
                            				'title' => Yii::t('cms', 'Add Column'),
                            				'aria-label' => Yii::t('cms', 'Add New Column'),
                            				'data-pjax' => '0',
                            			];
                            			return Html::a('<span class="ion-ios-plus"></span>', $url, $options);
                            		},
	                            ],
                            ]
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



