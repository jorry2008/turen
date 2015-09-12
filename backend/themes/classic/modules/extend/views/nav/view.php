<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\extend\Nav */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('extend', 'Nav List'), 'url' => ['index']];
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
                <div class="tab-pane active nav-view">
            <p>
                <?= Html::a(Yii::t('extend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('extend', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('extend', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
                'attributes' => [
                    'id',
            'parent_id',
            'name',
            'link_url:url',
            're_link_url:url',
            'pic_url:url',
            'target',
            'order',
            'status',
            'deleted',
            'created_at',
            'updated_at',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


