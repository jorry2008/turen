<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\order\Info;

/* @var $this yii\web\View */
/* @var $searchModel common\models\order\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Info List');
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
                <div class="tab-pane active info-index">
                
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
	            <!-- 
	                <p>
	                    <?= Html::a(Yii::t('order', 'Create Info'), ['create'], ['class' => 'btn btn-success']) ?>
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
// 							'id',
        					[
	        					'attribute' => 'order_no',
	        					'format' => 'raw',
	        					'value' => function($model){
	        						return Html::a($model->order_no, ['view', 'id'=>$model->id]);
	        					},
        					],
				            'consignee',
// 				            'country',
				            // 'province',
				            // 'city',
				            // 'district',
				            // 'address',
				            // 'zipcode',
				            // 'tel',
				            // 'mobile',
				            // 'email:email',
				            // 'order_note',
// 				            'discount:currency',
        					'order_amount:currency',
//         					'ip',
        					'customer_id',
        					[
	        					'attribute' => 'is_view',
	        					'format' => 'html',
	        					'filter' => [Info::STATUS_YES=>Yii::t('common', 'Yes'), Info::STATUS_NO=>Yii::t('common', 'No')],
	        					'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
	        					'value' => function($model){
	        						$on = '<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>';
	        						$off = '<small class="label bg-red">'.Yii::t('common', 'No').'</small>';
	        						return $model->is_view?$on:$off;
	        					},
        					], [
        						'attribute' => 'is_send',
        						'format' => 'html',
        						'filter' => [Info::STATUS_YES=>Yii::t('common', 'Yes'), Info::STATUS_NO=>Yii::t('common', 'No')],
        						'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt'=>Yii::t('common', 'All')],
        						'value' => function($model){
        							$on = '<small class="label bg-green">'.Yii::t('common', 'Yes').'</small>';
        							$off = '<small class="label bg-red">'.Yii::t('common', 'No').'</small>';
        							return $model->is_send?$on:$off;
        						},
        					],
// 				            'cms_ad_id',
				            // 'referer',
// 				            'add_time',
				            // 'confirm_time',
				            // 'payment_time',
				            // 'payment_note',
				            // 'deleted',
				            'created_at:datetime',
				            // 'updated_at',
            
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



