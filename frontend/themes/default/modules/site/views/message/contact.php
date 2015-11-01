<?php

/* @var $this yii\web\View */

$this->title = '联系我们';
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<?= Html::a('立即预约', ['/site/order/online-call'], ['class'=>'btn_yuyue', 'rel'=>'nofollow']) ?>
	<?= Html::a('给我们留言', ['/site/message/comment'], ['class'=>'btn_liuyan', 'rel'=>'nofollow']) ?>

	<?php // \frontend\widgets\SidePostTop::widget(['title'=>'关注最多', 'short_code'=>'', 'type'=>'v', 'num'=>8]) ?>
	
	<?= \frontend\widgets\SideImgTop::widget(['title'=>'特荐现场', 'short_code'=>'', 'type'=>'a', 'num'=>6]) ?>
	
	<?= \frontend\widgets\SideFragment::widget(['short_code'=>'contact_us']) ?>
	
</div>

<div class="main">
	<h2 class="con-title" style="text-align: center;"><?= $this->title ?></h2>
	
	
</div>




<?php // $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?php // $form->field($model, 'name') ?>
                <?php // $form->field($model, 'email') ?>
                <?php // $form->field($model, 'subject') ?>
                <?php // $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?php 
                /*
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                	'captchaAction' => '/site/home/captcha',
                    'template' => '{image}{input}',
                ])
                */
                ?>
                    <?php // Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            <?php // ActiveForm::end(); ?>
            
            