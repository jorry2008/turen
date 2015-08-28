<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\catalog\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Index').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Index'), ['index']) ?>
               </li>
               <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Create').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Create'), ['create']) ?>
               </li>
               <li class="active">
                   <?= Html::a(Yii::t('common', 'View'), 'javascript:;') ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active category-view">
            <p>
                <?= Html::a(Yii::t('catalog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('catalog', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('catalog', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'parent_id',
                        'value' => isset($model->mySelf)?$model->mySelf->name:Yii::t('catalog', 'Top Category'),
                    ],
                    'keyword',
                    'brief',
                    'name',
                    'description:ntext',
                    'image',
                    [
                        'attribute' => 'top',
                        'value' => $model->top ? Yii::t('catalog', 'Is Top') : Yii::t('catalog', 'Not Top'),
                    ],
                    'column',
                    'sort',
                    [
                        'attribute' => 'status',
                        'value' => $model->status ? Yii::t('common', 'On') : Yii::t('common', 'Off'),
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


