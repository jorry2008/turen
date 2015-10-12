<?php
/* @var $this yii\web\View */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="side">
	<a class="btn_yuyue" rel="nofollow" href="javascript:;">立即预约</a>
	<a class="btn_liuyan" rel="nofollow" href="javascript:;">给我们留言</a>
	
	<div class="side_box">
	    <div class="list_page">
	    	<ul>
	    		<li>title1</li>
	    		<li>title2</li>
	    	</ul>
	    </div>
	</div>
	
	<div class="side_box">
	    <h3 class="box_title">热门文章</h3>
	    <div class="box_content">
	    	content
	    </div>
	</div>
	
</div>



<div class="main">
	<h2 style="text-align: center;"><?= $this->title ?></h2>
	<?= $model->page->content ?>
</div>






