<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = '免费注册';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="header_title container clearfix">
	<span class="hcc_title"><?= Html::encode($this->title) ?></span>
</div>

<div class="container clearfix">
    <div class="login_img fl">
        <img width="390" height="310" alt="美好生活从这里开始" src="<?= Yii::getAlias('@web/images/').'zcdl_img.jpg' ?>">
    </div>
    
	<div class="login_box reg_box fl">
	    <div class="reg_tab">
	        <ul>
	            <li class="on">
	                <a href="javascript:;"><?= Html::encode($this->title) ?></a>
	            </li>
	            <li>
	            	<?= Html::a('用户登录', ['/account/common/login']) ?>
	            </li>
	        </ul>
	    </div>
	    
	    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
	        <div class="login_wrap">
	            <div class="login_select clearfix">
	            	<?= $form->field($model, 'email')->label(false) ?>
	                <span>邮箱/手机</span>
	            </div>
	            <div class="login_select clearfix">
	            <?= $form->field($model, 'username')->label(false) ?>
	                <span>用户名</span>
	            </div>
	            <div class="login_select clearfix">
	                <span>密码</span>
	                <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
	            </div>
	            
	            <!-- 
	            <div class="login_select clearfix ls_yzm">
	                <input type="text" name="mobile_yzm" autocomplete="off" class="autoCode" id="autoCode">
	                <span>验证码</span>
	                <input type="button" id="hqyzm" value="发送验证码到邮箱/手机" class="send_auto">
	            </div>
	             -->
	             
	            <div class="safe accept_service clearfix">
	                <span class="safe_login">
	                    <input type="checkbox" checked="checked" id="as_service">
	                    <label>我已阅读并接受<a target="_blank" href="/about/law.html">《快兔搬家用户服务协议》</a></label>
	                </span>
	            </div>
	            <?= Html::submitButton('立即注册', ['class' => 'btn_login', 'name' => 'signup-button']) ?>
	        </div>
	    <?php ActiveForm::end(); ?>
	</div>
	
</div>

<?php 

fb(Yii::$app->assetManager->bundles);



?>    
