<?php
/* @var $this yii\web\View */
$this->title = '搬家啦（广州）';

use frontend\assets\FlexsliderAsset;
use frontend\assets\JcarouselliteAsset;

FlexsliderAsset::register($this);
JcarouselliteAsset::register($this);

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
		$('.content_'+i).addClass('on');
	}, function(){
		//nothing
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
		                10秒预约，咨询报价，获得免费电话回拨，或者直接拨打热线电话：<span style="color: #f25618; font-weight: bold; font-size: 18px;">13725514524</span>
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
		<img width="154" height="83" style="float:left;padding-right: 15px;margin-top: 14px;" src="<?php echo Yii::getAlias('@web/upload/').'about.jpg'; ?>">
		<p><span class="title">深圳市快兔搬家有限公司</span>是一家具有独立法人资格的专业搬家公司，成立于1996年。公司拥有各种大小厢式货车、吊车、叉车、平板车等专业搬家车辆数十台，并拥有一支训练有素的搬家队伍，他们经过严格的专业培训，熟练掌握物品的包装、拆卸及搬运的技能，让客户在搬家时省心、放心。</p>
		<p>鹏程蚂蚁搬家公司将是您最佳的选择，我们将真诚为您服务。
本公司的主要业务是大型企业搬迁、工厂搬迁、写字楼搬迁、学院搬迁、个人搬家、拆装空调、拆装家具等。
本公司自成立迄今，深蒙广大客户支持鼓励，业绩不断成长，口碑尚称良好。我们以服务客户为己任，追求安全、高效、及时、认真的服务宗旨。<a href="">[详情...]</a></p>
	</div>
	<div class="_list">
		<ul class="nav">
			<li class="tab_1 active"><a href="">搬家常识</a></li>
			<li class="tab_2"><a href="">公司新闻</a></li>
			<li class="tab_3"><a href="">行业动态</a></li>
			<li class="tab_4"><a href="">企业公告</a></li>
			<li class="tab_5"><a href="">专题报道</a></li>
		</ul>
		
		<a class="more" href="">更多</a>
		
		<div class="con content_0 on">
			<ul class="recommend">
			    <li>
			        <a title="深圳木门厂家哪家好？深圳木门品牌哪个好？" target="_blank" href="http://sz.to8to.com/company/z49059.html">
			            <i>·</i>
			            深圳木门厂家哪家好？深圳木门品牌哪个好？<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳装修协会活动2015年9月22日开启" target="_blank" href="http://sz.to8to.com/company/z48660.html">
			            <i>
			                ·
			            </i>
			            深圳装修协会活动2015年9月22日开启<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳展厅装修预算如何审核？展厅装修报价怎样比较？" target="_blank" href="http://sz.to8to.com/company/z48657.html">
			            <i>
			                ·
			            </i>
			            深圳展厅装修预算如何审核？展厅装修报价怎样比较？<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳会所装修要注意的和深圳会所装修费用是多少？" target="_blank" href="http://sz.to8to.com/company/z48654.html">
			            <i>
			                ·
			            </i>
			            深圳会所装修要注意的和深圳会所装修费用是多少？<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳办公楼装修方案 办公楼各个空间细节装修" target="_blank" href="http://sz.to8to.com/company/z48652.html">
			            <i>
			                ·
			            </i>
			            深圳办公楼装修方案 办公楼各个空间细节装修<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳室内装修公司哪家好？" target="_blank" href="http://sz.to8to.com/company/z48648.html">
			            <i>
			                ·
			            </i>
			            深圳室内装修公司哪家好？<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			    <li>
			        <a title="深圳室内装修公司哪家好？" target="_blank" href="http://sz.to8to.com/company/z48648.html">
			            <i>
			                ·
			            </i>
			            深圳室内装修公司哪家好？<span class="right_date">2015-09-30</span>
			        </a>
			    </li>
			</ul>
		</div>
		<div class="con content_1">content_2</div>
		<div class="con content_2">content_3</div>
		<div class="con content_3">content_4</div>
		<div class="con content_4">content_5</div>
	</div>
</div>

<div class="scene mar-b18">
    <ul class="nav">
		<li class="active"><a href="">现场案例</a></li>
	</ul>
    <a class="more" href="">更多</a>
    <div id="xianchang">
	    <a href="javascript:void(0)" class="prev"><</a>
	    <a href="javascript:void(0)" class="next">></a>
        <ul class="clearfix">
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/xiaoxianrou2015/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'1.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            2015年度最热名企与小鲜肉勾搭大会！
                    </span>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/top-position/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'2.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            设计圈高级职位专场！
                    </span>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/job/O2O2015/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'3.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            O2O企业设计师招聘专场
                    </span>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/job/hongshanziben2015/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'4.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            红杉资本企业成员设计师招聘专场
                    </span>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/job/idg2014/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'5.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            IDG资本企业成员设计师招聘专场
                    </span>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.zcool.com.cn/special/job/xiaomi/">
                    <span class="pic-box">
                        <img title="" src="<?php echo Yii::getAlias('@web/upload/scene/').'6.jpg'; ?>">
                    </span>
                    <span class="text-box">
                            小米设计师招聘专场
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

