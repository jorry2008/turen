<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\customer\Customer */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('customer', 'Customer'), 'url' => ['index']];
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
                <div class="tab-pane active customer-view">
            <p>
                <?= Html::a(Yii::t('customer', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('customer', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('customer', 'Are you sure you want to delete this item?'),
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
                        'attribute' => 'customer_group_id',
                        'value' => isset($model->customerGroup)?$model->customerGroup->name:Yii::t('customer', 'Top Category'),
                    ],
                    'username',
                    'nickname',
                    [
                        'attribute' => 'gender',
                        'value' => $model->gender ? Yii::t('common', 'Male') : Yii::t('common', 'Male'),
                    ],
                    'birthday:datetime',
                    'email:email',
                    'telephone',
                    'mobile_phone',
                    'point',
                    'default_address_id',
                    'auth_key',
                    'password_hash',
                    'password_reset_token',
                    [
                        'attribute' => 'status',
                        'value' => $model->status ? Yii::t('common', 'On') : Yii::t('common', 'Off'),
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    'last_login_at:datetime',
                ],
            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


