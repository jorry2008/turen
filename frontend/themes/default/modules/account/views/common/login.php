<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('account', '欢迎登录');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="header_title container clearfix">
	<span class="hcc_title"><?= Html::encode($this->title) ?></span>
</div>

<div class="container clearfix">
    <div class="login_img fl">
        <img width="390" height="310" alt="美好生活从这里开始" src="<?= Yii::getAlias('@web/images/').'zcdl_img.jpg' ?>">
    </div>
    <div class="login_box fl">
        <div class="login_tab">
            <ul>
                <li id="nomallogin" class="on">
                    <a href="javascript:;"><?= Yii::t('account', '帐号登录') ?></a>
                </li>
            </ul>
        </div>
        <div class="login_wrap">
        	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="login_select">
                	<?= $form->field($model, 'username')->label(false) ?>
                    <span><?= Yii::t('account', '用户名/手机号/邮箱')?></span>
                </div>
                <div class="login_select">
                    <?= $form->field($model, 'password')->label(false)->passwordInput() ?>
                    <span><?= Yii::t('account', ' 密码')?></span>
                </div>
                <div class="safe">
                    <span class="safe_login">
                    	<?= $form->field($model, 'rememberMe')->checkbox(['label'=>Yii::t('account', '下次自动登录')]) ?>
                        
                    </span>
                    <?= Html::a(Yii::t('account', '忘记密码?'), ['/account/common/request-password-reset'], ['class'=>'forget_pw']) ?>
                </div>
                <?= Html::submitButton(Yii::t('account', '立即登录'), ['class' => 'btn_login', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
            <ul class="entries">
                <li class="other_login">
                    <a href="http://www.to8to.com/loginfromsina/" title="微博帐号登录" class="weibo_login">
                        <i></i>微博登录
                    </a>
                    <a href="http://www.to8to.com/loginfromqq/oauth/redirect_to_login.php"
                    title="QQ账户登录" class="qq_login">
                        <i></i>QQ登录
                    </a>
                </li>
                <li class="register">
                    <a href="http://www.to8to.com/reg/reg_new.php">免费注册</a>
                </li>
            </ul>
        </div>
    </div>
</div>
            
