<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\auth\AuthItem */
/* @var $form yii\widgets\ActiveForm */

$createItemsUrl = Yii::$app->getUrlManager()->createUrl(['auth/auto-deal/create-items']);
$btn = Yii::t('auth', 'Reset Auth');
$btn_ = Yii::t('auth', 'Progress...');
$this->registerJs("
    jQuery(document).on('click','#btn_reset_auth',function() {
        if(confirm('确实重置整个权限系统吗?')) {
            $(this).html('<i class=\"fa fa-refresh fa-spin\"></i> $btn_');
            $.ajax({
                url: '$createItemsUrl',
                type: 'get',
                dataType: 'json',
                context: $(this),
                success: function(data){
                    $(this).html('$btn');
                    alert(data.msg);
                }
            });
        }
	});
");
?>

<div class="row auth-item-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        
        <?php if($model->isNewRecord == true || ($model->isNewRecord == false && $model->type == yii\rbac\Item::TYPE_ROLE)) { ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?php 
            if($model->type == yii\rbac\Item::TYPE_ROLE) {
                $types = [yii\rbac\Item::TYPE_ROLE => Yii::t('auth', 'Role')];
            } else {
                $types = [yii\rbac\Item::TYPE_PERMISSION => Yii::t('auth', 'Permisstion'),backend\components\Task::TYPE_TASK => Yii::t('auth', 'Task'), yii\rbac\Item::TYPE_ROLE => Yii::t('auth', 'Role')];
            }
            ?>
            <?= $form->field($model, 'type')->dropDownList($types) ?>
        <?php } else { ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
            <?= $form->field($model, 'type')->dropDownList([yii\rbac\Item::TYPE_PERMISSION => Yii::t('auth', 'Permisstion'), yii\rbac\Item::TYPE_ROLE => Yii::t('auth', 'Role')], ['disabled' => 'disabled'])?>
        <?php } ?>
        
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
        <?php echo $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>
    
        <?php echo $form->field($model, 'data')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>
