<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\helpers\General;
use common\models\catalog\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\catalog\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog', 'Categories');
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
                <div class="tab-pane active category-index">
                
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        
                    <!-- 
                        <p>
                            <?= Html::a(Yii::t('catalog', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            'attribute' => 'parent_id',
                            'filter' => ArrayHelper::merge([0 => Yii::t('catalog','Top Category')], ArrayHelper::map(General::recursiveObj(Category::find()->orderBy(['sort'=>SORT_ASC])->all()), 'id', 'name')),
                            'value' => function($model, $key, $index, $_this){
                                if(!$model->parent_id) {
                                    return Yii::t('catalog', 'Top Category');
                                } else {
                                    return $model->getRelatedRecords()['mySelf']->name;
                                }
                            },
                        ], [
                            'attribute' => 'top',
                            'filter' => [Category::CATEGORY_IS_TOP=>Yii::t('catalog', 'Is Top'), Category::CATEGORY_NOT_TOP=>Yii::t('catalog', 'Not Top')],
                            'value' => function($model, $key, $index, $_this){
                                return $model->top?Yii::t('catalog', 'Is Top'):Yii::t('catalog', 'Not Top');
                            },
                        ], [
                            'attribute' => 'status',
                            'filter' => [Category::CATEGORY_STATUS_ON=>Yii::t('catalog', 'Status On'), Category::CATEGORY_STATUS_OFF=>Yii::t('catalog', 'Status Off')],
                            'value' => function($model, $key, $index, $_this){
                                return $model->status?Yii::t('catalog', 'Status On'):Yii::t('catalog', 'Status Off');
                            },
                        ], [
                            'attribute' => 'sort',
                            'filter' => false,
                        ], [
                            'attribute' => 'updated_at',
                            'format' => 'datetime',
                            'filter' => false,
                        ],
                        //'id',
                        //'keyword',
                        //'brief',
                        // 'description:ntext',
                        // 'image',
                        // 'column',
                        // 'created_at',
//                         [
//                             //实现完全自定义
//                             'header' => 'Length',
//                             'value' => function($model, $key, $index, $_this){
//                                 return strlen($model->description);
//                             },
//                         ],
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



