<?php

use yii\helpers\Html;
//yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\user\UserGroup;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\user\User */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord)
    $model->status = true;
?>

<div class="row user-form">
    <div class="col-md-1"></div>
    <div class="col-md-12 col-lg-6">
        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'username', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('username')]])->textInput() ?>
        
        <?= $form->field($model, 'realname', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('realname')]])->textInput() ?>
        
        <?= $form->field($model, 'email', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('email')]])->input('email') ?>
        
        <?= $form->field($model, 'password', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('password')]])->passwordInput() ?>
        
        <?= $form->field($model, 'user_group_id')->label(Yii::t('user', 'User Group'))->dropDownList(ArrayHelper::map(UserGroup::find()->all(), 'id', 'name'))?>
        
        <?= $form->field($model, 'role_name')->label(Yii::t('user', 'Role'))->dropDownList(ArrayHelper::map(Yii::$app->getAuthManager()->getRoles(), 'name', 'description'))?>
        
        <?= $form->field($model, 'status')->checkbox(['value'=>true]) ?>
        
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    </div>
</div>


