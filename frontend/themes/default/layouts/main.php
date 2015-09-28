<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

// use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
	    <div class="header_top">
		    <div class="header_top_center">
		        <div class="header_top_right">
                    <a rel="nofollow" class="htr_login" href="">登录</a>
                    <span class="htr_line"></span>
                    <a rel="nofollow" class="htr_reg" href="">注册</a>
                    <span class="htr_line"></span>
                    <a rel="nofollow" class="nav_fzlink" href="">快速下单</a>
                    <span class="htr_line"></span>
                    <a target="_blank" href="">服务流程</a>
                    <span class="htr_line"></span>
                    <a target="_blank" href="">新闻中心</a>
                    <span class="htr_line"></span>
                    <a target="_blank" href="">搬家百科</a>
		        </div>
		        
		        <div class="header_top_left">
                    <span><i class="fa fa-map-marker"></i> 广州</span>
		        </div>
		    </div>
		</div>
		
    	<div class="header_wrapper">
			<div class="logo_layout">
				<a class="logo" href="">快兔搬家网</a>
			</div>
    		
    		
    		
    		
    		
    		<?php
// 			echo Menu::widget([
// 				'items' => [
// 				    ['label' => Yii::t('common','首页'), 'url' => ['/site/home/index']],
// 				    ['label' => Yii::t('common','关于我们'), 'url' => ['/site/page/about']],
// 				    ['label' => Yii::t('common','搬家流程'), 'url' => ['/account/login'], 'visible' => Yii::$app->user->isGuest],
// 					['label' => Yii::t('common','收费标准'), 'url' => ['product/index']],
// 					['label' => Yii::t('common','案例展示'), 'url' => ['product/index']],
// 					['label' => Yii::t('common','搬家答疑'), 'url' => ['product/index']],
// 					['label' => Yii::t('common','联系我们'), 'url' => ['product/index']],
// 				],
// 				'options' => ['id'=>'nav-header', 'class'=>'reset'],
// 				'activeCssClass' => 'current',
// 			]);
			?>
    	</div>
    </div>
    
    <div class="container">
        <?= $content ?>
	</div>
	
	<div class="footer">
	    <div class="container">
	        <p class="footer-link">
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	            |
	            <a href="">关于我们</a>
	        </p>
	        
	        <p>
	            Copyright
	            <font style="font-family:Arial">
	                &copy;
	            </font>
	            2009-2015
	            <a target="" href="">
	                123.com
	            </a>
	            All Rights Reserved
	        </p>
	        <p>备案/许可证编号：豫ICP备08105333号</p>
	    </div>
	</div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
