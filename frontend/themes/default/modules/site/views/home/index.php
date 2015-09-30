<?php
/* @var $this yii\web\View */
$this->title = '搬家啦（广州）';

use frontend\assets\FlexsliderAsset;

FlexsliderAsset::register($this);

//使用插件
$this->registerJs("
	$('.flexslider').flexslider({
		animation: \"slide\",
		controlsContainer: $(\".custom-controls-container\"),
		customDirectionNav: $(\".custom-navigation a\")
	});
");

?>

<div class="slider mar-b18">
	<div class="flexslider">
	    <ul class="slides">
	        <li>
	            <img src="<?php echo Yii::getAlias('@web/upload/banner/').'1.jpg'; ?>" />
	        </li>
	        <li>
	            <img src="<?php echo Yii::getAlias('@web/upload/banner/').'2.jpg'; ?>" />
	        </li>
	        <li>
	            <img src="<?php echo Yii::getAlias('@web/upload/banner/').'3.jpg'; ?>" />
	        </li>
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
		                10秒预约，咨询报价，获得免费电话回拨
		            </p>
		        </div>
		        <div class="form_line">
		            <label class="label" for="">您的称呼</label>
		            <input type="text" class="text outcontrol" value="" name="yourname" style="border-color: rgb(221, 221, 221);">
		        </div>
		        <div class="form_line">
		            <label class="label" for="">您的电话</label>
		            <input type="text" class="text outcontrol" value="" name="yourphone">
		        </div>
		        <input type="button" value="预约搬家" class="form_btn">
		    </div>
		    <div class="sec_topr_list">
		        <ul>
		            <li>风投C轮投资2亿美金，互联网装修领导者</li>
		        </ul>
		    </div>
		</div>
		
    </div>
</div>

<div class="service_list mar-b18">
	service
</div>

<div class="top10">
	top10
</div>