<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\customer\CustomerGroup;

/* @var $this yii\web\View */
/* @var $model common\models\customer\CustomerGroup */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row customer-group-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
        <?= $form->field($model, 'is_default')->dropDownList([CustomerGroup::CUSTOMER_GROUP_IS_DEFAULT => Yii::t('common', 'Default'), CustomerGroup::CUSTOMER_GROUP_NOT_DEFAULT => Yii::t('common', 'Not Default')])?>
        
        <?= $form->field($model, 'approval')->dropDownList([CustomerGroup::CUSTOMER_GROUP_PASSED => Yii::t('common', 'Passed'), CustomerGroup::CUSTOMER_GROUP_FORBID => Yii::t('common', 'Forbid')])?>
        
        <?= $form->field($model, 'sort')->textInput() ?>
        
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('customer', 'Create') : Yii::t('customer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>
    </div>
</div>
