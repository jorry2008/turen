<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\auth\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('auth', 'Auth Operation');
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
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'name',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'attribute' => 'type',
                                'value' => function($model){
                                    return $model->type == yii\rbac\Item::TYPE_PERMISSION ? Yii::t('auth', 'Permisstion') : Yii::t('auth', 'Role');
                                },
                            ],
                            
                            'description:ntext',
//                             'rule_name',
//                             'data:ntext',
                            // 'created_at',
                            'updated_at:datetime',
    
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => Yii::t('common', 'Opration'),
                                'template' => '{config} {update}',
                                'buttons' => [
                                    'config' => function ($url, $model, $key) {
                                        $url = ['config', 'name'=>$model->name];
                                        $options = [
                                            'title' => Yii::t('auth', 'Auth'),
                                            'aria-label' => Yii::t('auth', 'Auth Config'),
                                            'data-pjax' => '0',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        $url = ['auth-item/update', 'name'=>$model->name];
                                        $options = [
                                            'title' => Yii::t('common', 'Update'),
                                            'aria-label' => Yii::t('common', 'Update'),
                                            'data-pjax' => '0',
                                            'target' => '_blank',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                                    },
                                ],
                            ],
                        ],
                    ]); ?>
                                
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



