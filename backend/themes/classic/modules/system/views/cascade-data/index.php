<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\system\CascadeData;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\system\CascadeDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Cascade Datas');
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
               <li data-original-title="<?= Yii::t('system', 'Click View')?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('system', 'View Demo'), ['demo'], ['target'=>'_blank']) ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active cascade-data-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('system', 'Create Cascade Data'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            
                            'name',
                            [
                                'attribute' => 'mySelf.name',
                                'header' => Yii::t('system', 'Parent'),
                                'value' => function($model, $key, $index, $_this){
                                    if(!$model->parent_id) {
                                        return Yii::t('system', 'Top Category');
                                    } else {
                                        return $model->getRelatedRecords()['mySelf']->name;
                                    }
                                },
                            ], [
                                'attribute' => 'level',
                                'filter' => (new CascadeData)->levelArr,
                                'value' => function($model){
                                    return (new CascadeData)->levelArr[$model->level];
                                },
                            ], [
                                'attribute' => 'data_group',
                                'filter' => (new CascadeData)->dataGroupArr,
                                'value' => function($model){
                                    return (new CascadeData)->dataGroupArr[$model->data_group];
                                },
                            ],
                            'updated_at:datetime',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => Yii::t('common', 'Opration'),
                                'template' => '{view} {update} {delete} {new_child}',
                                'buttons' => [
                                    'new_child' => function ($url, $model, $key) {
                                        $url = ['/system/cascade-data/create', 'parent_id'=>$model->id];//用户id取用户地址
                                        $options = [
                                            'title' => Yii::t('system', 'Add Chile Data'),
                                            'aria-label' => Yii::t('system', 'Add Chile Data'),
                                            'data-pjax' => '0',
                                            //'target' => '_blank',
                                        ];
                                        return Html::a('<span class="glyphicon ion-ios-plus"></span>', $url, $options);
                                    }
                                ],
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



