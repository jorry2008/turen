<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\system\CascadeData */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Cascade Datas'), 'url' => ['index']];
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
                <div class="tab-pane active cascade-data-view">
                    <p>
                        <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
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
                            [
                                'attribute' => 'parent_id',
                                'value' => $model->mySelf->name,
                            ], [
                                'attribute' => 'level',
                                'value' => $model->levelArr[$model->level],
                            ], [
                                'attribute' => 'data_group',
                                'value' => $model->dataGroupArr[$model->data_group],
                            ],
                            'updated_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


