<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;

use common\models\cms\Column;
use common\models\cms\Flag;
use common\models\cms\Download;

/* @var $this yii\web\View */
/* @var $searchModel common\models\cms\DownloadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Download List');
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
                <div class="tab-pane active cms-download-index">
                
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	                        
		            <!-- 
		                <p>
		                    <?= Html::a(Yii::t('cms', 'Create Download'), ['create'], ['class' => 'btn btn-success']) ?>
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
	            
	//                         'id',
	        				[
	        					'attribute' => 'title',
	        					'format' => 'raw',
	        					'value' => function($model){
	        						$length = Yii::$app->params['config']['config_site_title_length'];
	        						$options = ['style'=>''];
	        						Html::addCssStyle($options, ['color'=>$model->colorval, 'font-weight'=>$model->boldval]);
	        						$title = '<span title="'.$model->title.'" style="'.$options['style'].'">'.StringHelper::truncate($model->title, $length).'</span>';
	        						return Html::a($title, ['update', 'id'=>$model->id]);
	        					},
	        				], [
        						'attribute' => 'column_id',
        						'filter' => ArrayHelper::map(Column::find()->where(['type'=>Column::CMS_TYPE_DOWNLOAD])->alive()->all(), 'id', 'name'),
	        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	        					'value' => function($model){
        							return $model->column->name;
        						},
	        				],
// 				            'colorval',
// 				            'boldval',
				            [
                            	'attribute' => 'flag',
                            	'filter' => ArrayHelper::map(Flag::find()->orderBy('order')->all(), 'id', 'name'),
				            	'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
                            	'value' => function($model){
                            		return $model->flagModel->flag;
                            	},
                            ],
				            // 'file_type',
				            // 'language',
				            // 'accredit',
				            // 'file_size',
				            // 'unit',
				            // 'run_os',
				            // 'down_url:url',
				            // 'source',
				            // 'author',
				            // 'link_url:url',
				            // 'keywords',
				            // 'description',
				            // 'content:ntext',
				            // 'picurl:url',
				            // 'picarr:ntext',
				            'hits',
				            // 'order',
				            [
					            'attribute' => 'status',
					            'format' => 'html',
					            'filter' => [Download::STATUS_YES=>Yii::t('cms', 'Yes'), Download::STATUS_NO=>Yii::t('cms', 'No')],
				            	'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
					            'value' => function($model){
					            	$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
					            	$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
					            	return $model->status?$on:$off;
					            },
				            ],
				            // 'deleted',
				            'updated_at:datetime',
				            // 'created_at',
	            
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



