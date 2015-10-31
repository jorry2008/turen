<?php
use frontend\widgets\SideAd;
use frontend\widgets\SideCurrentTop;
use frontend\widgets\SidePage;
use frontend\widgets\SidePicTop;
use frontend\widgets\SidePostTop;

/* @var $this yii\web\View */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<a class="btn_yuyue" rel="nofollow" href="javascript:;">立即预约</a>
	<a class="btn_liuyan" rel="nofollow" href="javascript:;">给我们留言</a>
	
	<?= SideAd::widget(['title'=>'广告']) ?>
	<?= SideCurrentTop::widget(['title'=>'当前']) ?>
	<?= SidePage::widget(['title'=>'单页']) ?>
	<?= SidePicTop::widget(['title'=>'图片']) ?>
	<?= SidePostTop::widget(['title'=>'文章']) ?>
</div>

<div class="main">
	<h2 style="text-align: center;"><?= $this->title ?></h2>
	<?= $model->page->content ?>
</div>






