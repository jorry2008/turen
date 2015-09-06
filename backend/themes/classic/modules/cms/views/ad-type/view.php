<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\cms\AdType;

/* @var $this yii\web\View */
/* @var $model common\models\cms\AdType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cms', 'Ad Type List'), 'url' => ['index']];
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
                <div class="tab-pane active cms-ad-type-view">
            <p>
                <?= Html::a(Yii::t('cms', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('cms', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('cms', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
                'attributes' => [
                    'id',
		            'name',
                	'short_code',
                	[
                		'attribute' => 'wh_type',
                		'value' => ($model->wh_type == AdType::WH_TYPE_PX)?Yii::t('cms', 'Pixel'):Yii::t('cms', 'Percent'),
                	],
		            'width:integer',
		            'height:integer',
                	[
                		'attribute' => 'status',
                		'value' => $model->status?Yii::t('common', 'Yes'):Yii::t('common', 'No'),
                	],
                	'updated_at:datetime',
                	'created_at:datetime',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


