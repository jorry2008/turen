<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('user', 'Login');
?>

<div class="login-logo">
    <a href="javascript:;">
        <?= Html::encode($this->title) ?>
    </a>
</div>
<!-- /.login-logo -->

<div class="login-box-body">
    <p class="login-box-msg"><?= Yii::t('user', 'Log on to your session')?></p>
    
    <?php 
    $form = ActiveForm::begin([//$form为widget对象
        'id' => 'login-form',
    ]); ?>
        <?php //$form->errorSummary($model, ['class'=>'alert alert-danger']);?>
        
        <div class="has-feedback">
            <?= $form->field($model, 'username', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('username')]])->label(false) ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        
        <div class="has-feedback">
            <?= $form->field($model, 'password', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('password')]])->passwordInput()->label(false) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        
        <div class="row">
            <div class="col-sm-5 col-xs-5">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-sm-7 col-xs-7">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-sm-5 col-xs-5">{image}</div><div class="col-sm-7 col-xs-7">{input}</div></div>',
                    'captchaAction' => '/user/common/captcha',
                    'options' => ['class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('verifyCode')],
                ])->label(false) ?>
            </div>
        </div>
        
        <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    <?php ActiveForm::end(); ?>
    
</div>
<!-- /.login-box-body -->



