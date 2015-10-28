<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\system\Explorer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Explorer List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Index').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Index'), ['index']) ?>
               </li>
               <li class="active">
                   <?= Html::a(Yii::t('common', 'View'), 'javascript:;') ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active explorer-view">
		            <?= DetailView::widget([
		                'model' => $model,
		                'options' => ['class' => 'table table-hover table-striped table-bordered detail-view'],
		                'attributes' => [
		                    'id',
				            'is_exsit',
				            'status',
				            'action',
				            'sesstion',
				            'field',
				            'path',
				            'dir',
				            'created_at:datetime',
				            'updated_at:datetime',
		                ],
		            ]) ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


