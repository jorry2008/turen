<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\system\Explorer;

/* @var $this yii\web\View */
/* @var $searchModel common\models\system\ExplorerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Explorer List');
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
                <div class="tab-pane active explorer-index">
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
	//                         ['class' => 'yii\grid\SerialColumn'],//Explorer
	// 							'id',
	        					[
		        					'attribute' => 'path',
		        					'format' => 'html',
		        					'value' => function($model){
		        						if(is_file(Yii::getAlias('@upload').'/'.$model->path)) {
		        							return Html::img(Yii::getAlias('@web').'/upload/'.$model->path, ['height'=>'100px']);
		        						} else {
		        							return Yii::t('system', 'Not Found');
		        						}
		        					},
	        					], [
		        					'attribute' => 'is_exsit',
		        					'format' => 'html',
		        					'filter' => [Explorer::EXIST_YES=>Yii::t('common', 'Yes'), Explorer::EXIST_NO=>Yii::t('common', 'No')],
		        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
		        					'value' => function($model){
		        						$on = '<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>';
		        						$off = '<small class="label bg-red">'.Yii::t('common', 'No').'</small>';
		        						return $model->is_exsit?$on:$off;
		        					},
	        					], [
		        					'attribute' => 'status',
		        					'format' => 'html',
		        					'filter' => [Explorer::STATUS_COMPLETE=>Yii::t('system', 'Complete'), Explorer::STATUS_DRAFT=>Yii::t('system', 'Draft'), Explorer::STATUS_LOSE=>Yii::t('system', 'Lose')],
		        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
		        					'value' => function($model){
		        						if($model->status == Explorer::STATUS_COMPLETE) {
		        							return '<small class="label bg-green">'.Yii::t('system', 'Complete').'</small>';
		        						} elseif ($model->status == Explorer::STATUS_DRAFT) {
		        							return '<small class="label bg-blue">'.Yii::t('system', 'Draft').'</small>';
		        						} else {
		        							return '<small class="label bg-red">'.Yii::t('system', 'Lose').'</small>';
		        						}
		        					},
	        					], [
		        					'attribute' => 'action',
		        					'format' => 'html',
		        					'filter' => [Explorer::ACTION_DEL=>Yii::t('system', 'Delete'), Explorer::ACTION_INS=>Yii::t('system', 'Insert')],
		        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
		        					'value' => function($model){
		        						$on = '<small class="label bg-green">'.Yii::t('system', 'Delete').'</small>';
		        						$off = '<small class="label bg-blue">'.Yii::t('system', 'Insert').'</small>';
		        						return $model->action?$off:$on;
		        					},
	        					],
// 					            'sesstion',
					            'field',
					            'dir',
					            'created_at:datetime',
// 					            'updated_at',
	                        [
	                            'class' => 'yii\grid\ActionColumn',
	                        	'template' => '{view}',
	                            'header' => Yii::t('common', 'Opration'),
	                        ],
	                    ],
	                ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



