<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<?= Html::a('立即预约', ['/site/order/online-call'], ['class'=>'btn_yuyue', 'rel'=>'nofollow']) ?>
	<?= Html::a('给我们留言', ['/site/message/comment'], ['class'=>'btn_liuyan', 'rel'=>'nofollow']) ?>
	
	<?= \frontend\widgets\SidePage::widget(['title'=>'相关页面', 'parent_short_code'=>'base']) ?>
	
	<?= \frontend\widgets\SidePostTop::widget(['title'=>'关注最多', 'short_code'=>'', 'type'=>'v', 'num'=>8]) ?>
	
	<?= \frontend\widgets\SideAd::widget(['short_code'=>'side_ad', 'width'=>238]) ?>
	
	<?php // \frontend\widgets\SideImgTop::widget(['title'=>'特荐现场', 'short_code'=>'', 'type'=>'a', 'num'=>6]) ?>
	<?php // \frontend\widgets\SideCurrentTop::widget(['title'=>'相关话题', 'type'=>'a', 'num'=>6]) ?>
	<?php // \frontend\widgets\SideFragment::widget(['short_code'=>'contact_us']) ?>
	
	
</div>

<div class="main">
	<h2 class="con-title" style="text-align: center;"><?= $this->title ?></h2>
	<?= $model->page->content ?>
</div>






