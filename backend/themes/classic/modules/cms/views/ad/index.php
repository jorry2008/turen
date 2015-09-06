<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

use common\models\cms\Ad;
use common\models\cms\AdType;

/* @var $this yii\web\View */
/* @var $searchModel common\models\cms\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Ad List');
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
                <div class="tab-pane active cms-ad-index">
                
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('cms', 'Create Ad'), ['create'], ['class' => 'btn btn-success']) ?>
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
                
//                             'id',
                        	[
                        		'attribute' => 'title',
                        		'format' => 'raw',
                        		'value' => function($model){
                        			$length = Yii::$app->params['config']['config_site_title_length'];
                        			$title = StringHelper::truncate($model->title, $length);
                        			return Html::a($title, ['update', 'id'=>$model->id]);
                        		},
                        	], [
                        		'attribute' => 'ad_type_id',
                        		'filter' => ArrayHelper::map(AdType::find()->alive()->all(), 'id', 'name'),
                        		'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
                        		'value' => function($model){
                        			return $model->adType->name;
                        		},
                        	], [
	                            'attribute' => 'mode',
                        		'format' => 'raw',
                        		'filter' => Ad::getAdMode(),
                        		'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	                            'value' => function($model){
	                            	$modes = Ad::getAdMode();
	                            	return empty($modes[$model->mode])?'':$modes[$model->mode];
	                            },
                            ],
//                             'pic_url:url',
//                             'text:ntext',
//                             'link_url:url',
                            [
	                            'attribute' => 'order',
	                            'format' => 'raw',
	                            'value' => function($model){
	                            	return Html::activeTextInput($model, 'order', ['style'=>'width:50px', 'data-id'=>$model->id, 'id'=>'', 'class'=>'cms-order']);
	                            },
                            ], [
	                            'attribute' => 'status',
	                            'format' => 'html',
	                            'filter' => [Ad::STATUS_YES=>Yii::t('cms', 'Yes'), Ad::STATUS_NO=>Yii::t('cms', 'No')],
	                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	                            'value' => function($model){
	                            	$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
	                            	$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
	                            	return $model->status?$on:$off;
	                            },
                            ],
                            'updated_at:datetime',
//                             'created_at:datetime',
                			
                            [
	                            'class' => 'yii\grid\ActionColumn',
	                            'template' => '{delete}',
	                            'header' => Yii::t('common', 'Opration'),
                            ],
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



