<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->column->name, 'url' => ['post/list', 'id'=>$model->column->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<?= Html::a('立即预约', ['/site/order/online-call'], ['class'=>'btn_yuyue', 'rel'=>'nofollow']) ?>
	<?= Html::a('给我们留言', ['/site/message/comment'], ['class'=>'btn_liuyan', 'rel'=>'nofollow']) ?>
	
	<?= \frontend\widgets\SideCurrentTop::widget(['title'=>'相关话题', 'type'=>'v', 'num'=>6]) ?>
	
	<?= \frontend\widgets\SideImgTop::widget(['title'=>'特荐现场', 'short_code'=>'', 'type'=>'a', 'num'=>6]) ?>
	
	<?= \frontend\widgets\SideFragment::widget(['short_code'=>'contact_us']) ?>
</div>

<div class="main">
	<h2 class="con-title" style="text-align: center;"><?= $this->title ?></h2>
	<?= $model->content ?>
</div>

