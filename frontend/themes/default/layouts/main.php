<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

use common\components\helpers\General;
use common\models\extend\Nav;
// use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

//使用插件
$this->registerJs("
	$('.back_top').toTop({
		autohide: true,  //boolean 'true' or 'false'
		offset: 200,     //numeric value (as pixels) for scrolling length from top to hide automatically
		speed: 500,      //numeric value (as mili-seconds) for duration
		position:true,   //boolean 'true' or 'false'. Set this 'false' if you want to add custom position with your own css
		right: 30,       //numeric value (as pixels) for position from right. It will work only if the 'position' is set 'true'
		bottom: 100       //numeric value (as pixels) for position from bottom. It will work only if the 'position' is set 'true'
	});
	
	$('.header_top_left a').click(function(){
		//if(jQuery.browser.msie && ($.browser.version == \"8.0\" || $.browser.version == \"7.0\"))
		swal({
			title: '目前只开通了广州地区的服务',
			text: '其它地区正在努力开通，请耐心等待...',
			type: '',//info,warning,success
			//showCancelButton: true,
			confirmButtonColor: '#00af63',
			confirmButtonText: '知道了',
			// closeOnConfirm: false
		});
		// swal('目前只开通了广州地区的服务', '其它地区正在努力开通，请耐心等待...');
	});
	
	//二维码
	var code = $('#code_pic');
	$('.q_code_applnk').hover(function(){
		code.css('top', $(document).scrollTop());
		code.slideDown('fast');
	}, function(){
		code.slideUp('fast');
	});
");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' - '.Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>

<body id="<?= Yii::$app->controller->id ?>-<?= Yii::$app->controller->action->id ?>">
    <?php $this->beginBody() ?>
    <div id="header">
    	<div id="code_pic"><img src="<?php echo Yii::getAlias('@web/images/')?>code.png" /></div>
    	
	    <div class="header_top">
		    <div class="header_top_center">
		        <div class="header_top_right">
		        	<?php if(Yii::$app->getUser()->isGuest) { ?>
	                    <?= Html::a('登录', ['/account/common/login'], ['rel'=>'nofollow', 'class'=>('account/common/login' == Yii::$app->requestedRoute)?'active':'']) ?>
	                    <span class="htr_line"></span>
	                    <?= Html::a('注册', ['/account/common/signup'], ['rel'=>'nofollow', 'class'=>('account/common/signup' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <?php } else { ?>
                    	<?= Html::a('您好：'.Yii::$app->getUser()->getIdentity()->username, ['/account/common/center'], ['rel'=>'nofollow', 'class'=>('account/common/center' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <?php } ?>
                    <span class="htr_line"></span>
                    <?= Html::a('快速下单', ['/site/order/qick-order'], ['class'=>('site/order/qick-order' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <span class="htr_line"></span>
                    <?= Html::a('服务流程', ['/site/page/view', 'name'=>'service'], ['class'=>('site/page/view' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <span class="htr_line"></span>
                    <?= Html::a('新闻中心', ['/site/news/list'], ['class'=>('site/news/list' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <span class="htr_line"></span>
                    <?= Html::a('搬家百科', ['/site/baike/list'], ['class'=>('site/baike/list' == Yii::$app->requestedRoute)?'active':'']) ?>
                    <?php 
                    if(!Yii::$app->getUser()->isGuest) {
                    	echo '<span class="htr_line"></span>';
                    	echo Html::a('[退出]', ['/account/common/logout']);
                    }
                    ?>
		        </div>
		        
		        <div class="header_top_left">
                    <span><i class="fa fa-map-marker"></i> 广州</span>
                    <a rel="nofollow" href="javascript:;">[切换]</a>
		        </div>
		    </div>
		</div>
		
    	<div class="header_wrapper">
			<div class="logo_layout">
				<?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class'=>'logo'])?>
			</div>
			
			<div class="top_menu">
			    <div class="menu">
		    		<?php
		    		$mainMenu = (new Nav)->TgetNav('main');
		    		$items = [];
		    		foreach ($mainMenu as $key=>$menu) {
		    			$items[$key]['label'] = $menu->name;
		    			//这里要作url解析
		    			$url = General::parseUrl($menu->link_url);
		    			$items[$key]['url'] = empty($menu->re_link_url)?$url:$menu->re_link_url;
		    		}
		    		$items = ArrayHelper::merge([['label'=>'首页', 'url'=>['/site/home/index']]], $items);//Yii::$app->homeUrl
					echo Menu::widget([
						'items' => $items,
						'options' => ['id'=>'nav-header', 'class'=>'reset'],
					]);
					?>
			        <div class="q_code">
			            <a rel="nofollow" class="q_code_applnk" href="javascript:;"></a>
			        </div>
			    </div>
			</div>

    	</div>
    </div>
    
    <div class="content container">
	    <?php
	    if (!empty($this->params['breadcrumbs'])) {
			$params = [
				'tag' => 'ul',
				'encodeLabels' => false, // 不转义
				'itemTemplate' => "<li>{link}<span class=\"jian\">></span></li>\n",
				'options' => ['class' => 'breadcrumb clearfix'],
				'homeLink' => [
					'label' => '首页',//<i class="fa fa-dashboard"></i> 
					'url' => Yii::$app->homeUrl
				],
				'links' => $this->params['breadcrumbs'],
			];
			
			echo Breadcrumbs::widget($params);
		}
		?>
		
        <?= $content ?>
	</div>
	
	<div class="blue-foot clearfix mar-t18">
	    <div class="n_foot-box clearfix">
	    <!-- 
	        <h3 class="f-tit-h3">
	            合作伙伴
	        </h3>
	        <ul class="blue-pic-ul clearfix">
	            <li>
	                <a target="_blank" href="http://www.aliyun.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>aliyun.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.baidu.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>baidu.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="https://www.teambition.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>teambition.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.qq.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>txw.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.cn.jooble.org">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>jooble.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.kankan.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>xunlei.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://www.upyun.com">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>youpaiyun.png">
	                </a>
	            </li>
	            <li>
	                <a target="_blank" href="http://job.zcool.com.cn">
	                    <img height="60px" src="<?php echo Yii::getAlias('@web/upload/link/')?>zcool.png">
	                </a>
	            </li>
	        </ul>
	         -->
	        
	        <h3 class="f-tit-h3 mar-t5">
	            友情链接
	        </h3>
	        <div class="blue-link-box clearfix">
	            <ul class="clearfix">
	                <li>
	                    <a target="_blank" href="http://www.woshipm.com">
	                        人人都是产品经理
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.qidianla.com">
	                        起点学院
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://wenda.woshipm.com">
	                        天天问
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.zhaopins.com">
	                        产品经理招聘
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://dh.woshipm.com">
	                        产品经理导航
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.yiyebang.com">
	                        异业邦
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.xmpig.com">
	                        厦门小猪网
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.izhaowo.com">
	                        找我网
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="https://www.mockplus.cn">
	                        Mockplus原型
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.pmtown.com">
	                        泡面小镇
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.25xt.com">
	                        25学堂
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.jikexueyuan.com">
	                        极客学院
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://bbs.maxpda.com">
	                        黑莓论坛
	                    </a>
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.zn8.com">
	                        智能电视
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.zzjidi.com">
	                        站长基地
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.fjii.com">
	                        览潮网
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.31huiyi.com">
	                        31会议
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.yopai.com/">
	                        优派网
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	                <li>
	                    <a target="_blank" href="http://www.ciaapp.cn/">
	                        CIA身份验证
	                    </a>
	                    &nbsp;&nbsp;
	                </li>
	            </ul>
	        </div>
	    </div>
	    <!--foot-box-->
	</div>
	
	<div class="black-foot footer">
	    <div style="overflow:hidden;" class="n_foot-box">
	        <div class="black-left">
	            <p style="margin-bottom:10px;">
	                <a class="f-logo" href="#">快兔搬家</a>
	            </p>
	            <a class="a-font mar-r27" target="_blank" href="/sys/about.html">关于我们</a>
	            <a class="a-font" target="_blank" href="/sys/contact.html">联系我们&nbsp;</a>
	            <br>
	            <a class="a-font mar-r27" href="/sys/api.html">开放API</a>
	            <a class="a-font" target="_blank" href="/sys/declaration.html">免责声明</a>
	        </div>
	        <div class="black-center">快兔搬家网是集方科技有限公司旗下的便民服务平台，专注于大众化搬家服务。依托于中国专业网络技术公司--集方科技有限公司（www.jifang.com），整合业内资源，为大众提供专业，极速的信息服务，为客户提供精准，优质的搬家等装卸服务，保证最好的态度与最专业的技术让每位客户满意。</div>
	        <div class="black-right">
	            <dl class="foot_r_dl">
	                <dd></dd>
	                <dt>
	                    <p class="n_blue_font">
	                        <i class="fa fa-qq"></i> 搬家交流群
	                    </p>
	                    <p class="mar-b10">980522557</p>
	                    <p class="n_blue_font">
	                        <i class="fa fa-phone"></i> 商务联系方式
	                    </p>
	                    <p>Jorry：13725514524</p>
	                </dt>
	                <div style="clear: both;"></div>
	            </dl>
	        </div>
	    </div>
	    <!--foot-box-->
	    <div class="n_foot-box">
	        <div class="n_copyright">
	            Copyright &copy; <?= date('Y') ?> - 快兔网-专业的搬家平台 - 粤ICP备14037330号
	            <br>集方科技旗下网站
	        </div>
	        <div style="text-align: center;" class="mar-t10">运行于：
	            <a target="_blank" href="http://www.aliyun.com">
	                <img original="http://www.qidianla.com/assets/images/main/f_aly.png" style="display: inline;"
	                src="http://www.qidianla.com/assets/images/main/f_aly.png">
	            </a>
	            <a target="_blank" href="http://www.upyun.com">
	                <img style="margin-left: 11px; display: inline;" original="http://www.qidianla.com/assets/images/main/f_up.png"
	                src="http://www.qidianla.com/assets/images/main/f_up.png">
	            </a>
	        </div>
	    </div>
	</div>
	
	<div class="ronsever2">
	    <div id="ros_on2" class="ros_m" style="display: block;">
	        <span title="点击收起" onclick="ros_on2.style.display='none';ros_off2.style.display='block';" class="ros_close"></span>
	        <div class="ros_top"></div>
	        <div class="ros_main">
	            <div class="rosm_tel">
	                <p>服务热线</p>
	                <p><b>400-800-0011</b></p>
	            </div>
	            <div class="rosm_qq">
	                <p>业务咨询</p>
	                <p>售后服务</p>
	            </div>
	        </div>
	        <div class="ros_bottom"></div>
	    </div>
	    <div title="点击展开" onclick="ros_on2.style.display='block';ros_off2.style.display='none';" id="ros_off2" style="display: none;" class="ros_butt"></div>
	</div>
	
	<a class="back_top" href="javascript:;">返回顶部</a>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
