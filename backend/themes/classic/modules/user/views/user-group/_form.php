<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\user\UserGroup */
/* @var $form yii\widgets\ActiveForm */

$model->status = true;//给个默认值
?>

<div class="row user-group-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
    
        <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'name', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('name')]])->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'description', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('description')]])->textarea(['rows' => 3]) ?>
    
        <?= $form->field($model, 'sort', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('sort')]])->input('number') ?>
    
        <?= $form->field($model, 'status')->checkbox(['value'=>true]) ?>
    
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
        
    </div>
</div>


