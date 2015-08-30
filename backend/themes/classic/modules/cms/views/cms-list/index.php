<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;

use common\models\cms\CmsClass;
use common\models\cms\CmsFlag;

/* @var $this yii\web\View */
/* @var $searchModel common\models\cms\CmsListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Cms List List');
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
                <div class="tab-pane active cms-list-index">
                
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('cms', 'Create Cms List'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        		'attribute' => 'title',
                        		'format' => 'raw',
                        		'value' => function($model){
                        			$length = Yii::$app->params['config']['config_site_title_length'];
                        			return '<span title="'.$model->title.'" style="color:'.$model->colorval.';font-weight:'.$model->boldval.';">'.StringHelper::truncate($model->title, $length).'</span>';
                        		},
                        	], [
	                            'attribute' => 'cms_class_id',
                        		'filter' => ArrayHelper::map(CmsClass::find()->where(['type'=>CmsClass::CMS_TYPE_LIST])->alive()->all(), 'id', 'name'),
	                            'value' => function($model){
	                            	return $model->cmsClass->name;
	                            },
                            ],
                            // 'cms_flag_id',
                            // 'source',
                            'author',
                            // 'linkurl:url',
                            // 'keywords',
                            // 'description',
                            // 'content:ntext',
                            // 'pic_url:url',
                            // 'picarr:ntext',
                            [
                            	'attribute' => 'cms_flag_id',
                            	'filter' => ArrayHelper::map(CmsFlag::find()->orderBy('order')->all(), 'id', 'name'),
                            	'value' => function($model){
                            		return $model->cmsFlag->name;
                            	},
                            ],
                            'hits',
                        	[
                        		'attribute' => 'status',
                        		'format' => 'html',
                        		'value' => function($model){
                        			$on = Html::a('<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
                        			$off = Html::a('<small class="label bg-red">'.Yii::t('common', 'No').'</small>', ['switch-stauts', 'id'=>$model->id], ['title'=>Yii::t('cms', 'Update Status')]);
                        			return $model->status?$on:$off;
                        		},
                        	],
                            'updated_at:datetime',
                            // 'created_at:datetime',
                
                            [
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



