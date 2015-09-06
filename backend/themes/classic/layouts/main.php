<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use backend\assets\SlimScrollAsset;

/* @var $this \yii\web\View */
/* @var $content string */

SlimScrollAsset::register($this);

//$baseUrl = $this->context->baseUrl;
$baseUrl = Yii::getAlias('@web');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' - '.Yii::$app->name)?></title>
    <?php $this->head() ?>
</head>
<!-- <body class="sidebar-mini fixed skin-green-light"> -->
<body class="skin-blue sidebar-mini fixed">
    <?php $this->beginBody() ?>
    
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?= Yii::$app->homeUrl ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <b>土</b>
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                    	<?php 
                    	$env = 'Prod';
                    	if(YII_ENV_DEV)
                    		$env = 'Dev';
                    	elseif(YII_ENV_TEST)
                    		$env = 'Test';
                    	?>
                        <b>土人系统 <span class="label label-warning" style="font-size: 10px; padding: 1px;"><?= $env?></span></b>
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">切换</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        	
                        	<!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">1</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">您有一个通知</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-users text-aqua"></i>今天有5个会员加入
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="javascript:;">查看所有</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="notifications-menu">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-comment-o"></i>
                                    <span class="label label-warning">6</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/turen-one/turen" target="_blank">
                                    <i class="fa fa-github"></i>
                                    <span class="label label-warning">hot</span>
                                </a>
                            </li>
                            
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" aria-expanded="false">
                                    <?= Html::img($baseUrl.'/images/user/user2-160x160.jpg', ['class'=>'user-image', 'alt'=>'User Image'])?>
                                    <span class="hidden-xs">
                                    <?php
                                    if(Yii::$app->getUser()->isGuest)
                                        echo Yii::t('common', 'Guest');
                                    else 
                                        echo Yii::$app->getUser()->identity->username;
                                    ?>
                                    </span><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo Html::a('<i class="fa fa-user"></i>管理员管理', ['/user/user/index'], ['tabindex'=>-1])?>
                                    </li>
                                    <li>
                                        <?php echo Html::a('<i class="fa fa-power-off"></i>退出登录', ['/user/common/logout'], ['tabindex'=>-1])?>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?= Html::img($baseUrl.'/images/user/user2-160x160.jpg', ['class'=>'img-circle', 'alt'=>'User Image'])?>
                        </div>
                        <div class="pull-left info">
                            <p><?php
                            if(Yii::$app->getUser()->isGuest)
                                echo Yii::t('common', 'Guest');
                            else 
                                echo Yii::$app->getUser()->identity->username;
                            ?></p>
                            <a href="javascript:;">
                                <i class="fa fa-circle text-success"></i><?= Yii::t('common', 'Online')?>
                            </a>
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php 
                    //使用路由写法，能自动激活active,Yii::$app->getHomeUrl()
                    echo Menu::widget([
                    	//全局设置
                    	'encodeLabels' => false,
                    	'submenuTemplate' => '<ul class="treeview-menu">{items}</ul>',
                    	'options' => ['class' => 'sidebar-menu'],
                    	'itemOptions' => ['class' => 'treeview'],
                    	
                    	//局部设置
                    	'items' => [
                    		['label' => '<i class="fa fa-dashboard"></i><span>后台首页</span>', 'url' => ['/user/common/default']],
                    		['label' => '<i class="fa fa-wordpress"></i><span>内容管理</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                    			'items' => [
                    				['label' => '<i class="fa fa-th-large"></i><span>栏目管理</span>', 'url' => ['/cms/column/index']],
                    				['label' => '<i class="fa fa-file-text-o"></i><span>单页面信息管理</span>', 'url' => ['/cms/page/index']],
                    				['label' => '<i class="fa fa-list"></i><span>列表信息管理</span>', 'url' => ['/cms/post/index']],
                    				['label' => '<i class="fa fa-picture-o"></i><span>图片信息管理</span>', 'url' => ['/cms/img/index']],
                    				['label' => '<i class="fa fa-arrow-circle-o-down"></i><span>资源下载管理</span>', 'url' => ['/cms/download/index']],
                    				// ['label' => '<i class="fa fa-cube"></i><span>产品信息管理</span>', 'url' => ['/cms/product/index']],
                    				// ['label' => '<i class="fa fa-leaf"></i><span>数据碎片管理</span>', 'url' => ['/cms//']],
                    			]
                    		], ['label' => '<i class="fa fa-film"></i><span>广告管理</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                    			'items' => [
                    					['label' => '<i class="fa fa-bars"></i><span>广告位管理</span>', 'url' => ['/cms/ad-type/index']],
                    					['label' => '<i class="fa fa-file-image-o"></i><span>广告管理</span>', 'url' => ['/cms/ad/index']],
                    					['label' => '<i class="fa fa-line-chart"></i><span>广告统计</span>', 'url' => ['/cms//']],
                    			]
                    		],
                            ['label' => '<i class="fa fa-cubes "></i><span>产品&分类</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                                'items' => [
                                    ['label' => '<i class="fa fa-leaf"></i><span>产品管理</span>', 'url' => ['/catalog/product/index']],
                                    ['label' => '<i class="fa fa-leaf"></i><span>分类管理</span>', 'url' => ['/catalog/category/index']],
                                    ['label' => '<i class="fa fa-leaf"></i><span>品牌管理</span>', 'url' => ['/catalog/brand/index']],
                                ]
                            ],
                    		['label' => '<i class="fa fa-leaf"></i><span>扩展模块</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                    			'items' => [
                    				['label' => '<i class="fa fa-leaf"></i><span>评论管理</span>', 'url' => ['/comment/product/index']],
                    				['label' => '<i class="fa fa-leaf"></i><span>友情链接管理</span>', 'url' => ['/link/product/index']],
                    				['label' => '<i class="fa fa-leaf"></i><span>客户留言管理</span>', 'url' => ['/message/product/index']],
                    			]
                    		],
                            ['label' => '<i class="fa fa-user-plus"></i><span>用户&地址</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                                'items' => [
                                    ['label' => '<i class="fa fa-user"></i><span>用户列表</span>', 'url' => ['/customer/customer/index']],
                                    ['label' => '<i class="fa fa-users"></i><span>用户组列表</span>', 'url' => ['/customer/customer-group/index']],
                                    ['label' => '<i class="fa fa-map-marker"></i><span>地址批量管理</span>', 'url' => ['/customer/customer-address/index']],
                                ]
                            ],
							['label' => '<i class="fa fa-leaf"></i><span>微信公众平台</span><i class="fa fa-angle-left pull-right"></i>', 'url' => ['###']],
                    		['label' => '<i class="fa fa-leaf"></i><span>土人帮助系统</span><i class="fa fa-angle-left pull-right"></i>', 'url' => ['###']],
                    		['label' => '<i class="fa fa-users"></i><span>管理员管理</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                        		'items' => [
                            		['label' => '<i class="fa fa-user"></i><span>管理员列表</span>', 'url' => ['/user/user/index']],
                            		['label' => '<i class="fa fa-users"></i><span>管理组列表</span>', 'url' => ['/user/user-group/index']],
                            		['label' => '<i class="fa fa-filter"></i><span>授权操作</span>', 'url' => ['/auth/auth/index']],
                            		['label' => '<i class="fa fa-filter"></i><span>权限项管理</span>', 'url' => ['/auth/auth-item/index']],
                        		]
                    		],
                    		['label' => '<i class="fa fa-gears"></i><span>系统管理</span><i class="fa fa-angle-left pull-right"></i>', 'url' => 'javascript:;',
                        		'items' => [
                            		['label' => '<i class="fa fa-gear"></i><span>系统配置</span>', 'url' => ['/system/config/config']],
                            		['label' => '<i class="fa fa-folder-open-o"></i><span>缓存管理</span>', 'url' => ['/system/cache/index']],
                            		['label' => '<i class="fa fa-database"></i><span>数据库管理</span>', 'url' => ['/system/db/index']],
                            		['label' => '<i class="fa fa-folder-open-o"></i><span>公共数据</span>', 'url' => ['/system/cascade-data/index']],
                            		['label' => '<i class="fa fa-folder-open-o"></i><span>菜单系统</span>', 'url' => ['/system/menu/index']],
                            		['label' => '<i class="fa fa-folder-open-o"></i><span>操作日志</span>', 'url' => ['/system/log/index']],
                        		    ['label' => '<i class="fa fa-trash-o"></i><span>回收总站</span>', 'url' => ['/system/trash/index']],
                        		]
                    		],
                    		['label' => '<i class="fa fa-flag-o"></i><span>关于我们</span>', 'url' => ['/user/common/about']],
                    	],
                    ]);
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
	    		<?php 
	    		if(!empty(Yii::$app->getSession()->getFlash('danger'))) {
                    echo '<div class="box-body"><div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i>'.Yii::$app->getSession()->getFlash('danger').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
                } elseif (!empty(Yii::$app->getSession()->getFlash('info'))) {
                    echo '<div class="box-body"><div class="alert alert-info alert-dismissable"><i class="icon fa fa-info"></i>'.Yii::$app->getSession()->getFlash('info').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
                } elseif (!empty(Yii::$app->getSession()->getFlash('warning'))) {
                    echo '<div class="box-body"><div class="alert alert-warning alert-dismissable"><i class="icon fa fa-warning"></i>'.Yii::$app->getSession()->getFlash('warning').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
                } elseif (!empty(Yii::$app->getSession()->getFlash('success'))) {
                    echo '<div class="box-body"><div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i>'.Yii::$app->getSession()->getFlash('success').'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div></div>';
                }
	    		?>
    			
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?= Html::encode($this->title) ?><small>版本 v<?= Yii::$app->version?></small></h1>
                    
                    <?php
                    if (isset($this->params['breadcrumbs'])) {
                        $params = [
                            'tag' => 'ol',
                            'encodeLabels' => false, // 不转义
                            'homeLink' => [
                                'label' => '<i class="fa fa-dashboard"></i>' . Yii::t('common', 'Home'),
                                'url' => Yii::$app->homeUrl
                            ],
                            'links' => $this->params['breadcrumbs'],
                        ];
                        
                        echo Breadcrumbs::widget($params);
                    }
                    ?>
                </section>
                <!-- Main content -->
                <section class="content">
                    <a name="home" id="mark_home"></a>
                    <?= $content ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>版本</b><?= Yii::$app->version?> <?= Yii::powered(); ?>
                </div>
                <i>
                    Copyright &copy; <?= date('Y'); ?>
                </i>
            </footer>
        </div>
        <!-- ./wrapper -->
    
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
