<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\cms\CmsPage;

/* @var $this yii\web\View */
/* @var $searchModel common\models\cms\CmsPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Cms Page List');
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
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active cms-page-index">
                
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('cms', 'Create Cms Page'), ['create'], ['class' => 'btn btn-success']) ?>
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
                
                            // 'id',
                        	[
                        		'attribute' => 'cms_class_id',
                        		'format' => 'raw',
                        		'header' => Yii::t('cms', 'Cms Class'),
                        		'value' => function($model){
                        			return Html::a($model->cmsClass->name, ['update', 'id'=>$model->id]);
                        		},
                        	],
//                             'content:ntext',
							[
								'attribute' => 'order',
								'format' => 'raw',
								'value' => function($model){
									return Html::activeTextInput($model, 'order', ['style'=>'width:50px', 'data-id'=>$model->id]);
								},
							], [
                        		'attribute' => 'status',
                        		'format' => 'html',
								'filter' => [CmsPage::STATUS_YES=>Yii::t('cms', 'Yes'), CmsPage::STATUS_NO=>Yii::t('cms', 'No')],
                        		'value' => function($model){
                        			$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
                        			$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
                        			return $model->status?$on:$off;
                        		},
                        	],
                            'updated_at:datetime',
                            // 'created_at:datetime',
//                             [
//                                 'class' => 'yii\grid\ActionColumn',
//                                 'template' => '{update}',
//                                 'header' => Yii::t('common', 'Opration'),
//                             ],
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



