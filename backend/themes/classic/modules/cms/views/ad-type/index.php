<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

use common\models\cms\AdType;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cms', 'Ad Type List');
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
                <div class="tab-pane active cms-ad-type-index">
                
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('cms', 'Create Ad Type'), ['create'], ['class' => 'btn btn-success']) ?>
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
                
                            // 'id',
                        	[
                        		'attribute' => 'name',
                        		'format' => 'raw',
                        		'value' => function($model){
                        			$length = Yii::$app->params['config']['config_site_title_length'];
                        			$title = StringHelper::truncate($model->name, $length);//'<span class="fa fa-list-ol"></span> '.
                        			return Html::a($title, ['/cms/ad/index', 'AdSearch[ad_type_id]'=>$model->id]);
                        		},
                        	],
                        	'short_code',
                        	[
	                        	'attribute' => 'wh_type',
	                        	'value' => function($model){
	                        		return ($model->wh_type == AdType::WH_TYPE_PX)?Yii::t('cms', 'Pixel'):Yii::t('cms', 'Percent');
	                        	},
                        	], [
	                        	'attribute' => 'width',
	                        	'value' => function($model){
	                        		$unit = ($model->wh_type == AdType::WH_TYPE_PX)?'px':'%';
	                        		return $model->width.$unit;
	                        	},
                        	], [
	                        	'attribute' => 'height',
	                        	'value' => function($model){
	                        		$unit = ($model->wh_type == AdType::WH_TYPE_PX)?'px':'%';
	                        		return $model->height.$unit;
	                        	},
                        	], [
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
	                            'template' => '{update} {delete}',
	                            'header' => Yii::t('common', 'Opration'),
                            ],
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



