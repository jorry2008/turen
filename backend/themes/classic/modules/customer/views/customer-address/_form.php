<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use backend\assets\Select2Asset;

/* @var $this yii\web\View */
/* @var $model common\models\customer\CustomerAddress */
/* @var $form yii\widgets\ActiveForm */

//加载一插件
Select2Asset::register($this);

$customerUrl = Yii::$app->getUrlManager()->createUrl(['/customer/customer/get-customer', 'limit' => 10]);
//使用插件
$this->registerJs("
    $('#customer-address-get-customer').select2({
        ajax: {
            url: '$customerUrl',
            dataType: 'json',
            delay: 250,
    		processResults: function (data) {
    			return {
    				results: data.msg
    			};
    		},
    		cache: true
        }
    });
");
?>

<div class="row customer-address-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        <?php 
        $customerList = [];
        if(!$model->isNewRecord) {//懒加载
            $customerList = [$model->customer_id=>$model->getCustomer()->one()->username];
        }
        ?>
        <?= $form->field($model, 'customer_id')->label(Yii::t('customer', 'Customer'))->dropDownList($customerList, ['id'=>'customer-address-get-customer'])?>
        <?= $form->field($model, 'consignee')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'country_id')->textInput() ?>
        <?= $form->field($model, 'province_id')->textInput() ?>
        <?= $form->field($model, 'district_id')->textInput() ?>
        <?= $form->field($model, 'city_id')->textInput() ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'is_default')->checkbox(['value'=>true]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('customer', 'Create') : Yii::t('customer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
