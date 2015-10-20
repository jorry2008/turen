<?php
/* @var $this yii\web\View */

use frontend\assets\WanNianLiAsset;

$this->title = '搬家吉日';
$this->params['breadcrumbs'][] = $this->title;

//注册成年历
WanNianLiAsset::register($this);

$baseUrl = Yii::$app->getRequest()->getHostInfo();

$this->registerJs("
	//
");
?>

<script type="text/javascript">
	var jieRi = '2012-5-13|母亲节,2012-6-17|父亲节';
	var fangJia = '';
	//优先级最高
	var shangBan = '2011-12-31|上班,2012-1-21|上班,2012-1-29|上班,2012-3-31|上班,2012-4-1|上班,2012-4-28|上班,2012-9-29|上班';
	var jieQi = '2011-11-22|2011-11-23|小雪';
	var BASE_URL = '<?= $baseUrl ?>';
// 	console.debug(BASE_URL);
</script>

<div class="side">
	<a class="btn_yuyue" rel="nofollow" href="javascript:;">立即预约</a>
	<a class="btn_liuyan" rel="nofollow" href="javascript:;">给我们留言</a>
	
	<div class="side_box">
	    <div class="list_page">
	    	<div id="lr" class="aside">
	            <div id="day-desc">
	                <div style="height:360px;">&nbsp;</div>
	            </div>
	        </div>
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
	
	<h1 style="text-align: center"><?= $this->title ?></h1>
	
	<div id="wrap">
	    <div id="bd">
	        <div class="main">
	            <div class="sift-box">
	                <div class="left">
	                	
<!-- 	                    <input type="button" id="prev-year" class="btn-pre"> -->
	                    <select id="year-selector" style="width:100px;"></select>
<!-- 	                    <input type="button" id="next-year" class="btn-next"> -->
	                    
<!-- 	                    <input type="button" id="prev-month" class="btn-pre"> -->
	                    <select id="month-selector" style="width:60px;"></select>
<!-- 	                    <input type="button" id="next-month" class="btn-next"> -->
	                    
	                </div>
	                <div class="right">
<!-- 	                <select id="holiday-selector" style="width:150px;"></select> -->
	                    <input type="button" class="btn-today" value="今日">
	                </div>
	            </div>
	            
	            <div class="calendar-container" id="calendar-container">
	                <table width="718">
	                    <tr class="wnl-header">
	                        <td>一</td>
	                        <td>二</td>
	                        <td>三</td>
	                        <td>四</td>
	                        <td>五</td>
	                        <td class="weekend">六</td>
	                        <td class="weekend">日</td>
	                    </tr>
	                </table>
	                <table id="rl" width="718">
	                    <script>
	                        var gNum, vHide = "";
	                        for (var i = 0; i < 6; ++i) {
	                            if (i > 4) {
	                                document.write("<tr style='display:none;'>");
	                            } else {
	                                document.write("<tr>");
	                            }
	                            for (var j = 0; j < 7; ++j) {
	                                gNum = i * 7 + j;
	                                document.write('<td><div id="GD' + gNum + '"><span class="dateNum" id="SD' + gNum + '"></span><span id="LD' + gNum + '"></span><label id="FJ' + gNum + '"></label></div></td>');
	                            }
	                            document.write("</tr>");
	                        }
	                    </script>
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
	
	
	
</div>
