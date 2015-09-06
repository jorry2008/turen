<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\cms\Page */

$this->title = Yii::t('cms', 'Update:') . $model->column->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cms', 'Page List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->column->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cms', 'Update');
?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Index').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Index'), ['index']) ?>
               </li>
               <li class="active">
                   <?= Html::a(Yii::t('common', 'Update'), 'javascript:;') ?>
               </li>
               
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active cms-page-update">
                    
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

