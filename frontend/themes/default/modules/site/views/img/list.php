<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = $columnModel->name;
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
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'options' => ['class' => 'list-view'],//list配置
		'itemOptions' => [],//item配置
// 		'itemView' => function ($model, $key, $index, $widget) {//直接使用回调处理
// 			return '_item';
// 		},
		'itemView' => '_item',//指定一个项目模板来处理
		'viewParams' => ['columnModel'=>$columnModel],//额外参数
		//'separator' => 'ok',//项目之间的分隔符
		'pager' => [
			'class' => LinkPager::className(),
			'options' => ['class' => 'pagination'],
			'nextPageLabel' => '下一页',
			'prevPageLabel' => '上一页',
			'firstPageLabel' => '首页',
			'lastPageLabel' => '末页',
		],
	]) ?>
</div>

