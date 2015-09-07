<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\auth\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('auth', 'Auth Items');
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
                <div class="tab-pane active auth-item-index">
                
                    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
                                
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('auth', 'Create Auth Item'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            'name',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'attribute' => 'type',
                                'value' => function($model){
                                    if($model->type == yii\rbac\Item::TYPE_PERMISSION)
                                        return Yii::t('auth', 'Permisstion');
                                    elseif($model->type == backend\components\Task::TYPE_TASK)
                                        return Yii::t('auth', 'Task');
                                    else
                                        return Yii::t('auth', 'Role');
                                },
                                'filter' => [yii\rbac\Item::TYPE_PERMISSION => Yii::t('auth', 'Permisstion'),backend\components\Task::TYPE_TASK => Yii::t('auth', 'Task'), yii\rbac\Item::TYPE_ROLE => Yii::t('auth', 'Role')],
                            ],
                            
                            'description:ntext',
//                             'rule_name',
//                             'data:ntext',
                            // 'created_at',
                            'updated_at:datetime',
    
                            [
	                            'class' => 'yii\grid\ActionColumn',
	                            'header' => Yii::t('common', 'Opration'),
	                            
	                            'template' => '{view} {update} {delete}',
	                            'buttons' => [
                            		'view' => function ($url, $model, $key) {
                            			$url = ['view', 'name'=>$model->name];//用户id取用户地址
                            			$options = [
                            					'title' => Yii::t('yii', 'View'),
                            					'aria-label' => Yii::t('yii', 'View'),
                            					'data-pjax' => '0',
//                             					'target' => '_blank',
                            			];
                            			return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                            		},
                            		'update' => function ($url, $model, $key) {
                            			$url = ['update', 'name'=>$model->name];//用户id取用户地址
                            			$options = [
                            					'title' => Yii::t('yii', 'Add'),
                            					'aria-label' => Yii::t('yii', 'Add'),
                            					'data-pjax' => '0',
//                             					'target' => '_blank',
                            			];
                            			return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                            		},
                            		'delete' => function ($url, $model, $key) {
                            			$url = ['delete', 'name'=>$model->name];//用户id取用户地址
                            			$options = [
                            					'title' => Yii::t('yii', 'Delete'),
                            					'aria-label' => Yii::t('yii', 'Delete'),
                            					'data-pjax' => '0',
                            					'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
//                             					'target' => '_blank',
                            			];
                            			return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                            		}
	                            ],
                            ]
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



