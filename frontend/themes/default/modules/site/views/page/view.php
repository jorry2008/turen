<?php
use frontend\widgets\SideAd;
use frontend\widgets\SideCurrentTop;
use frontend\widgets\SidePage;
use frontend\widgets\SidePostTop;
use frontend\widgets\SideImgTop;
use frontend\widgets\SideFragment;

/* @var $this yii\web\View */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<a class="btn_yuyue" rel="nofollow" href="javascript:;">立即预约</a>
	<a class="btn_liuyan" rel="nofollow" href="javascript:;">给我们留言</a>
	
	
	<?= SidePostTop::widget(['title'=>'关注最多', 'short_code'=>'', 'type'=>'v', 'num'=>8]) ?>
	<?= SideImgTop::widget(['title'=>'特荐现场', 'short_code'=>'', 'type'=>'a', 'num'=>6]) ?>
	<?php // SideCurrentTop::widget(['title'=>'相关话题', 'type'=>'a', 'num'=>6]) ?>
	<?= SideFragment::widget(['short_code'=>'contact_us']) ?>
	<?= SidePage::widget(['title'=>'相关页面', 'parent_short_code'=>'base']) ?>
	<?= SideAd::widget(['short_code'=>'side_ad', 'width'=>238]) ?>
</div>

<div class="main">
	<h2 style="text-align: center;"><?= $this->title ?></h2>
	<?= $model->page->content ?>
</div>






