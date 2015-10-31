<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

use common\helpers\General;
use common\models\extend\Nav;
use common\models\extend\LinkType;
use common\models\extend\Link;
// use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

//使用插件
$this->registerJs("
	//返回顶部
	$('.back_top').toTop({
		autohide: true,  //boolean 'true' or 'false'
		offset: 200,     //numeric value (as pixels) for scrolling length from top to hide automatically
		speed: 500,      //numeric value (as mili-seconds) for duration
		position:true,   //boolean 'true' or 'false'. Set this 'false' if you want to add custom position with your own css
		right: 30,       //numeric value (as pixels) for position from right. It will work only if the 'position' is set 'true'
		bottom: 100       //numeric value (as pixels) for position from bottom. It will work only if the 'position' is set 'true'
	});
	
	//弹出窗口
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
    	<div id="code_pic">
    		<img width="128px;" src="<?= Yii::$app->params['config']['config_pic_url'].'/upload/common/code.png' ?>" />
    	</div>
    	
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
                    <?= Html::a('新闻中心', ['/site/post/list', 'name'=>'news'], ['class'=>('site/post/list' == Yii::$app->requestedRoute && Yii::$app->getRequest()->get('name') == 'news')?'active':'']) ?>
                    <span class="htr_line"></span>
                    <?= Html::a('搬家百科', ['/site/post/list', 'name'=>'baike'], ['class'=>('site/post/list' == Yii::$app->requestedRoute && Yii::$app->getRequest()->get('name') == 'baike')?'active':'']) ?>
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
		    			$items[$key]['url'] = empty($menu->re_link_url)?General::parseUrl($menu->link_url):$menu->re_link_url;
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
	
	<div class="foot-top clearfix mar-t18">
		<div class="foot-top-content clearfix">
			<div class="n_foot-box">
		    	<?php 
		    	$links = Link::find()->select(Link::tableName().'.*')->joinWith([
		    			'linkType' => function ($query) {
		    				$query->where([LinkType::tableName().'.short_code'=>'site_links']);
		    			}
		    	])->active()->all();//友情链接
		    	?>
		        <ul class="tit_tab clearfix">
		        	<li class="on">友情链接</li>
		        </ul>
		        <div class="main-link-box clearfix">
		            <ul class="clearfix">
		            	<?php foreach ($links as $link) { ?>
		                <li>
		                    <?= Html::a($link->name, [$link->link_url], ['target'=>'_blank']) ?>
		                </li>
		                <?php } ?>
		            </ul>
		        </div>
		    </div>
		    
		    <div class="m_foot-box">
				<div class="ftc_right">
					<dl>
						<dt>扫码进手机版</dt>
						<dd><img width="100px;" src="<?= Yii::$app->params['config']['config_pic_url'].'/upload/common/code.png' ?>" /></dd>
					</dl>
				</div>
		    </div>
		</div>
	</div>
	
	<div class="black-foot footer">
		
		<div class="footer_bottom_container">
		    <div class="fbc_menu">
		        <ul>
		        <?php 
		        $subMenus = (new Nav)->TgetNav('sub-main');
		        $count = count($subMenus);fb($count);
		        foreach ($subMenus as $key=>$menu) {
		        	$url = empty($menu->re_link_url)?General::parseUrl($menu->link_url):$menu->re_link_url;
		        ?>
		        	<li>
		        	<?= Html::a($menu->name, $url) ?>
		        	<?= ($count == ($key+1))?'':'<span></span>' ?>
		            </li>
		        <?php 
		        }
		        ?>
		        </ul>
		    </div>
		</div>
		
        <div class="n_copyright">
        	<div class="row">免责声明：本网站部分内容来自互联网，如权利人发现存在误传其作品情形，请及时与本站联系。</div>
            <div class="row">Copyright &copy; <?= date('Y') ?> - <?= Yii::$app->params['config']['config_base_name'] ?>-专业搬家网 - 粤ICP备198637330号</div>
            <div class="row"><?= Yii::$app->params['config']['config_base_company'] ?>旗下网站</div>
            <div class="row">
				
				<div class="f_icpico">
					<?php $url = Yii::$app->params['config']['config_pic_url']; ?>
					<?= Html::a(Html::img($url.'/upload/common/jingcha.jpg', ['height'=>'32px']), 'javascript:;', ['rel'=>'nofollow']) ?>
					<?= Html::a(Html::img($url.'/upload/common/chengxin.jpg', ['height'=>'32px']), 'javascript:;', ['rel'=>'nofollow']) ?>
					<?= Html::a(Html::img($url.'/upload/common/cnnic.png', ['height'=>'32px']), 'javascript:;', ['rel'=>'nofollow']) ?>
					<?= Html::a(Html::img($url.'/upload/common/beian.jpg', ['height'=>'32px']), 'javascript:;', ['rel'=>'nofollow']) ?>
			    </div>
				
			</div>
        </div>
	</div>
	
	<div class="ronsever2">
	    <div id="ros_on2" class="ros_m" style="display: block;">
	        <span title="点击收起" onclick="ros_on2.style.display='none';ros_off2.style.display='block';" class="ros_close"></span>
	        <div class="ros_top"></div>
	        <div class="ros_main">
	            <div class="rosm_tel">
	                <p class="title">服务热线</p>
	                <p>
	                	<?php 
	                	$tels = Yii::$app->params['config']['config_site_contact_tel'];
	                	if(!empty($tels)) {
	                		$tels = explode(',', $tels);
	                		foreach ($tels as $tel) {
	                			echo '<b>'.$tel.'</b><br />';
	                		}
	                	}
	                	?>
	                </p>
	            </div>
	            
	            <?php $url = Yii::$app->params['config']['config_pic_url']; ?>
	            <div class="rosm_qq">
	                <p class="title">业务咨询</p>
	                <p>
	                	<?php 
	                	$qqs = Yii::$app->params['config']['config_site_contact_qq'];
	                	if(!empty($qqs)) {
	                		$qqs = explode(',', $qqs);
	                		foreach ($qqs as $qq) {
	                			echo Html::a(Html::img($url.'/upload/common/qq_online.gif', ['alt'=>'在线咨询', 'title'=>'在线咨询']), 'http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes', ['target'=>'_blank']);
	                		}
	                	}
	                	?>
	                </p>
	                <p class="title">售后服务</p>
	                <p>
	                	<?php 
	                	$qqs = Yii::$app->params['config']['config_site_shouhou_qq'];
	                	if(!empty($qqs)) {
	                		$qqs = explode(',', $qqs);
	                		foreach ($qqs as $qq) {
	                			echo Html::a(Html::img($url.'/upload/common/qq_online.gif', ['alt'=>'在线咨询', 'title'=>'在线咨询']), 'http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes', ['target'=>'_blank']);
	                		}
	                	}
	                	?>
	                </p>
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
