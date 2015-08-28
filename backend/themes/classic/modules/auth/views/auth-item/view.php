<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\auth\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Auth Items'), 'url' => ['index']];
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
                <div class="tab-pane active auth-item-view">
            <p>
                <?= Html::a(Yii::t('auth', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('auth', 'Delete'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('auth', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
                'attributes' => [
                    'name',
                    [
                        'attribute' => 'type',
                        //'label' => 'type',
                        'value' => $model->type == yii\rbac\Item::TYPE_PERMISSION ? Yii::t('auth', 'Permisstion') : Yii::t('auth', 'Role'),
                    ],
                    'description:ntext',
                    'rule_name',
                    'data:ntext',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


