<?php
/* @var $this yii\web\View */
$this->title = '广州搬家';

use yii\helpers\Html;
use frontend\assets\FlexsliderAsset;
use frontend\assets\JcarouselliteAsset;
use common\helpers\General;

FlexsliderAsset::register($this);
JcarouselliteAsset::register($this);

$callUrl = Yii::$app->getUrlManager()->createUrl(['/site/order/call']);

//使用插件
$this->registerJs("
	$('.flexslider').flexslider({
		animation: \"slide\",
		controlsContainer: $(\".custom-controls-container\"),
		customDirectionNav: $(\".custom-navigation a\")
	});
	
    $('#xianchang').jCarouselLite({
        btnNext: \".next\",
        btnPrev: \".prev\",
		mouseWheel: true,//支持鼠标滚动
		auto: 2500,//自动开始
		speed: 400,//滚动速度
		visible: 4,//可见几个
		scroll: 1,//一次滚动多少个
    });
	
	//tabs
	var nav = $('.about_news .nav li');
	var con = $('.about_news .con');
	nav.hover(function(){
		nav.removeClass('active');
		$(this).addClass('active');
		var i = $(this).index();
		con.removeClass('on');
		$('.content_'+(i+1)).addClass('on');
	}, function(){
		//nothing
	});
	
	$('.input-label').keydown(function(){
		$(this).prev().css('left', '-999em');
	}).blur(function(){
		var val = $.trim($(this).val());
		if(val == '') {
			$(this).val('');
			$(this).prev().css('left', '11px');
		}
	});
	
	//预约提交
	$('#call-button').click(function(){
		var name = $.trim($('#yourname').val());
		var phone = $.trim($('#yourphone').val());
		if(name != '' && phone != '') {
			$.get('$callUrl', {name: name, phone: phone},function(data){
				//data
				console.debug('提交完成');
				//0,预约成功，马安排给您回电
				
				//1,您已经预约，请耐心等待
				
				//2,您填写的电话号码格式有误，请检查后再预约
				
			});
		} else {
			alert('预约称呼或者电话不能为空，请填写后再预约。');
		}
	});
");

// $assetUrl = $this->getAssetManager()->getBundle(JcarouselliteAsset::className())->baseUrl;
// Yii::$app->getAssetManager()->assetMap = ['jquery.js' => substr($assetUrl, strpos($assetUrl, '/assets/')+8).'/jquery.min.js'];

// fb(Yii::$app->getAssetManager());
// $asset = Yii::$app->getAssetManager();
// $asset->bundles['yii\web\JqueryAsset'];
// fb($asset->bundles['yii\web\JqueryAsset']);
// fb($asset);
?>

<div class="slider mar-b18">
	<div class="flexslider">
	    <ul class="slides">
	    	<?php foreach ($mainAds as $ad) { ?>
	        <li>
	            <?= Html::a(General::showImg($ad->pic_url, 'o', $ad->title, 'px', $mainAdType->width, $mainAdType->height), ['/ad/link/ad-click', 'name'=>$ad->short_code], ['target'=>'_blank']) ?>
	        </li>
	        <?php } ?>
	    </ul>
	</div>
	<div class="custom-navigation">
		<a href="#" class="flex-prev">上一个</a>
		<a href="#" class="flex-next">下一个</a>
	</div>
	<div class="custom-controls-container"></div>
</div>

<div class="quick_order">
	<div class="button clearfix">
	    <a class="yellow_button mar-r15" target="_blank" href="###">
	        <i class="fa fa-paw icon_fg"></i>
	        <font>专业人才加盟</font>
	    </a>
	    <a class="yellow_button" target="_blank" href="###">
	        <i class="fa fa-qq icon_fg"></i>
	        <font>呼叫客服小妹</font>
	    </a>
    </div>
    
    <div class="order mar-t11">
    	
    	<div class="sec_topr_bd">
		    <div class="sec_topr_form index_form">
		        <div class="form_hd">
		            <p class="mar-t0">
		                10秒预约，咨询报价，获得免费电话回拨，或者直接拨打热线电话：<span style="color: #f25618; font-weight: bold; font-size: 18px;"><?= Yii::$app->params['config']['config_site_contact_phone'] ?></span>
		            </p>
		        </div>
		        <div class="form_line">
		            <label class="label" for="yourname">您的称呼</label>
		            <input type="text" id="yourname" class="text outcontrol input-label" value="" name="yourname">
		        </div>
		        <div class="form_line">
		            <label class="label" for="yourphone">您的电话</label>
		            <input type="text" id="yourphone" class="text outcontrol input-label" value="" name="yourphone">
		        </div>
		        <input id="call-button" type="button" value="预约搬家" class="form_btn">
		    </div>
		</div>
		
    </div>
</div>

<div class="service_list mar-b18">
	
	<ul class="index_zxlc_list clearfix">
	    <li class="first">
	        <a rel="nofollow" href="http://sz.to8to.com/zb/index6.html">
	            <i class="index_zxlc_ico1">
	            </i>
	            <span>
	                合理报价
	            </span>
	        </a>
	    </li>
	    <li>
	        <a rel="nofollow" href="http://sz.to8to.com/zb/">
	            <i class="index_zxlc_ico4">
	            </i>
	            <span>
	                附加服务
	            </span>
	        </a>
	    </li>
	    <li>
	        <a rel="nofollow" href="http://mall.to8to.com/">
	            <i class="index_zxlc_ico5">
	            </i>
	            <span>
	                搬家套餐
	            </span>
	        </a>
	    </li>
	    <li>
	        <a rel="nofollow" href="http://www.to8to.com/riji/">
	            <i class="index_zxlc_ico6">
	            </i>
	            <span>
	                施工阶段
	            </span>
	        </a>
	    </li>
	    <li class="last">
	        <a rel="nofollow" href="http://www.to8to.com/company/zxb.php">
	            <i class="index_zxlc_ico7">
	            </i>
	            <span>
	                售后验收
	            </span>
	        </a>
	    </li>
	</ul>

</div>

<div class="about_news mar-b18">
	<div class="_about">
		<?= $about->page->content ?>
		<?= Html::a('[详情...]', ['/site/page/view', 'name'=>'about'], ['style'=>'bottom: 15px;position: absolute;right: 15px;']) ?>
	</div>
	<div class="_list">
		<ul class="nav">
			<?php foreach ($columns as $key=>$column) { ?>
				<li class="tab_<?= ($key+1) ?><?= empty($key)?' active':''?>"><a href="javascript:;"><?= $column->name?></a></li>
			<?php } ?>
		</ul>
		
		<!-- <a class="more" href="">更多</a> -->
		<?php 
		foreach ($columns as $key=>$column) {
			$post = $column->getPost()->where(['like', 'flag', 'c'])->all();//这里是文章类型列表【后台推荐文章】
			echo '<div class="con content_'.($key+1).(empty($key)?' on':'').'"><ul class="recommend">';
			if($post) {
				foreach ($post as $p) {
					echo '<li>';
					echo Html::a($p->title.'<span class="right_date">'.date('Y-m-d', $p->publish_at).'</span>', ['/site/post/view', 'id'=>$p->id]);
					echo '</li>';
				}
			}
			echo '</ul></div>';
		} ?>
	</div>
</div>

<div class="scene mar-b18">
    <ul class="nav">
		<li class="active"><a href="javascript:;">搬运现场</a></li>
	</ul>
    <?= Html::a('更多', ['/site/pic/list'], ['class'=>'more']) ?>
    <div id="xianchang" class="clearfix">
	    <a href="javascript:void(0)" class="prev"></a>
	    <a href="javascript:void(0)" class="next"></a>
        <ul>
        	<?php foreach ($scenes as $scene) { ?>
            <li>
            	<?php 
            	$link = $scene->link_url;
            	if(empty($link))
            		$link = ['/site/pic/view', 'name'=>'', 'id'=>$scene->id];
            	?>
            	<?= Html::a('<span class="pic_box">'.General::showImg($scene->pic_url, 'o', $scene->title, 'px', '230', '140').'</span><span class="text-box">'.$scene->title.'</span>', $link) ?>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>

<div id="index_banner_botton">
	<?= Html::a(General::showImg($adBottom->pic_url, 'o', $adBottom->title, 'px', '1024', '95', 'w'), ['/ad/link/ad-click', 'name'=>$adBottom->short_code], ['target'=>'_blank']) ?>
</div>

