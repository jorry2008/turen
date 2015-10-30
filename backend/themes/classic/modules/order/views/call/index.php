<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\order\Call;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\order\CallSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Call List');
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
                <div class="tab-pane active call-index">
                
            	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
	            <!-- 
	                <p>
	                    <?= Html::a(Yii::t('order', 'Create Call'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    
                    'filterModel' => $searchModel,
        			'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
// 			                'id',
//         					[
// 	        					'attribute' => 'username',
// 	        					'format' => 'raw',
// 	        					'value' => function($model){
// 	        						return Html::a($model->username, ['update', 'id'=>$model->id]);
// 	        					},
//         					],
        					[
	        					'attribute' => 'username',
	        					'format' => 'raw',
	        					'value' => function($model){
	        						return Html::a(empty($model->username)?'<i>[未留名]</i>':$model->username, ['view', 'id'=>$model->id], ['data-pjax' => '0']);
	        					},
        					],
				            'contact',
				            'call_note',
				            // 'deleted',
        					[
	        					'attribute' => 'customer_id',
	        					'format' => 'html',
	        					'value' => function($model){
	        						return empty($model->customer)?'<i>[匿名客户]</i>':$model->customer->username;
	        					},
        					], [
	        					'attribute' => 'is_view',
	        					'format' => 'html',
	        					'filter' => [Call::STATUS_YES=>Yii::t('common', 'Yes'), Call::STATUS_NO=>Yii::t('common', 'No')],
	        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	        					'value' => function($model){
	        						$on = '<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>';
	        						$off = '<small class="label bg-red">'.Yii::t('common', 'No').'</small>';
	        						return $model->is_view?$on:$off;
	        					},
        					], [
	        					'attribute' => 'is_send',
	        					'format' => 'html',
	        					'filter' => [Call::STATUS_YES=>Yii::t('common', 'Yes'), Call::STATUS_NO=>Yii::t('common', 'No')],
	        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	        					'value' => function($model){
	        						$on = '<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>';
	        						$off = '<small class="label bg-red">'.Yii::t('common', 'No').'</small>';
	        						return $model->is_send?$on:$off;
	        					},
        					],
				            'created_at:datetime',
				            // 'updated_at',
            
                        [
                            'class' => 'yii\grid\ActionColumn',
                        	'template' => '{update} {delete}',
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



