<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\customer\Customer;
use common\models\customer\CustomerGroup;
use yii\helpers\ArrayHelper;
use backend\assets\DatePickerAsset;

/* @var $this yii\web\View */
/* @var $model common\models\customer\Customer */
/* @var $form yii\widgets\ActiveForm */

//加载一插件
DatePickerAsset::register($this);

//使用插件
$this->registerJs("
	$('#customer-birthday').datepicker({
        language: '".Yii::$app->language."',//使用当前语言
	    format: 'yyyy/mm/dd'
	});
");

//添加时，使用默认值
if($model->isNewRecord)
    $model->status = true;
    
//修改日期时间格式
$model->birthday = Yii::$app->getFormatter()->asDate($model->birthday, 'yyyy/MM/dd');//与js配合

//以下时间都是系统行为决定的，不用人工干预
// $model->created_at = Yii::$app->getFormatter()->asDatetime($model->created_at, 'yyyy/MM/dd');
// $model->updated_at = Yii::$app->getFormatter()->asDatetime($model->updated_at, 'yyyy/MM/dd');
// $model->last_login_at = Yii::$app->getFormatter()->asDatetime($model->last_login_at, 'yyyy/MM/dd');
?>
<div class="row customer-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?php echo  $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'customer_group_id')->label(Yii::t('customer', 'Customer Group'))->dropDownList(ArrayHelper::map(CustomerGroup::find()->all(), 'id', 'name'))?>
        <?= $form->field($model, 'gender')->dropDownList([Customer::CUSTOMER_MALE => Yii::t('common', 'Male'), Customer::CUSTOMER_FEMALE => Yii::t('common', 'Female')])?>
        
        <?= $form->field($model, 'birthday', ['enableClientValidation'=>false])->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'point')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'default_address_id')->textInput(['maxlength' => true]) ?>
    
        <?php //echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
        <?php //echo  $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'status')->checkbox(['value'=>true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('customer', 'Create') : Yii::t('customer', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>


