<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

use common\models\extend\Message;

/* @var $this yii\web\View */
/* @var $searchModel common\models\extend\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('extend', 'Message List');
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
                <div class="tab-pane active message-index">
                
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                
	            <!-- 
	                <p>
	                    <?= Html::a(Yii::t('extend', 'Create Message'), ['create'], ['class' => 'btn btn-success']) ?>
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
	        					'attribute' => 'nickname',
	        					'format' => 'raw',
	        					'value' => function($model){
	        						$length = Yii::$app->params['config']['config_site_title_length'];
	        						$title = StringHelper::truncate($model->nickname, $length);//'<span class="fa fa-list-ol"></span> '.
	        						return Html::a($title, ['update', 'id'=>$model->id]);
	        					},
        					],
				            'contact',
// 				            'content:ntext',
        					[
	        					'attribute' => 'is_top',
	        					'filter' => false,
	        					'value' => function($model){
	        						return $model->is_top;
	        					},
        					], [
	        					'attribute' => 'is_recommend',
	        					'filter' => false,
	        					'value' => function($model){
	        						return $model->is_top;
	        					},
        					],
				            // 'ip',
				            // 'order',
        					[
	        					'attribute' => 'status',
	        					'format' => 'html',
	        					'filter' => [Message::STATUS_YES=>Yii::t('common', 'Yes'), Message::STATUS_NO=>Yii::t('common', 'No')],
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



