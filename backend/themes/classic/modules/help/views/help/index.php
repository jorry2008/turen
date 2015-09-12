<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use common\models\help\Help;

/* @var $this yii\web\View */
/* @var $searchModel common\models\help\HelpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('help', 'Help List');
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
                <div class="tab-pane active help-index">
                
            	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
	            <!-- 
	                <p>
	                    <?= Html::a(Yii::t('help', 'Create Help'), ['create'], ['class' => 'btn btn-success']) ?>
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
// 							'Id',
        					[
	        					'attribute' => 'title',
	        					'format' => 'raw',
	        					'value' => function($model){
	        						$length = Yii::$app->params['config']['config_site_title_length'];
	        						$title = '<span title="'.$model->title.'">'.StringHelper::truncate($model->title, $length).'</span>';
	        						return Html::a($title, ['update', 'id'=>$model->id]);
	        					},
        					],
        					'short_code',
// 				            'user_content:ntext',
// 				            'dev_content:ntext',
				            'url:url',
        					[
	        					'attribute' => 'status',
	        					'format' => 'html',
        						'filter' => [Help::STATUS_YES=>Yii::t('common', 'Yes'), Help::STATUS_NO=>Yii::t('common', 'No')],
        						'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	        					'value' => function($model){
	        						$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('common', 'Update Status')]);
	        						$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('common', 'Update Status')]);
	        						return $model->status?$on:$off;
	        					},
        					],
				            // 'deleted',
				            // 'created_at',
				            'updated_at:datetime',
            
                        [
                            'class' => 'yii\grid\ActionColumn',
                        	'template' => '{view} {delete}',
                            'header' => Yii::t('common', 'Opration'),
                        ],
                    ],
                ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



