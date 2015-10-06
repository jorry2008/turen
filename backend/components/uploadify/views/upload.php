<?php
// use yii\helpers\Html;
use backend\components\uploadify\UploadifyAsset;

$this->title = Yii::t('uploadify', 'File Upload');

UploadifyAsset::register($this);

//使用非常到位
$assetUrl = $this->getAssetManager()->getBundle(UploadifyAsset::className())->baseUrl;

$baseUrl = Yii::getAlias('@web');

//临时去掉原生jquery//assets临时处理
Yii::$app->getAssetManager()->assetMap = ['jquery.js' => substr($assetUrl, strpos($assetUrl, '/assets/')+8).'/jquery.min.js'];

$uploaderUrl = Yii::$app->getUrlManager()->createUrl(Yii::$app->requestedRoute);

$csrfParam = Yii::$app->getRequest()->csrfParam;
$csrfValue = Yii::$app->getRequest()->getCsrfToken();

$sessionName = Yii::$app->getSession()->getName();
$sessionId = Yii::$app->getSession()->getId();

$timestamp = time();
$unique_salt = md5($uniqueSalt . $timestamp);

$swf = $assetUrl.'/uploadify.swf';
$btnUrl = $assetUrl.'/select.png';

$failureText = Yii::t('uploadify', 'The temporary file upload failed, not received upload!');
$delText = Yii::t('uploadify', 'Delete');



//使用插件
$this->registerJs("
    //移动窗口效果
	var _move = false;
	var ObjT = \".MainTit\";
	var ObjW = \".Wrap\";

	//鼠标离控件左上角的相对位置
	var _x,_y,_top,_left;

	//初始化窗口位置
	_top  = parseInt($(window.parent.window).height()/2)-208 + $(window.parent.document).scrollTop();
	_left = parseInt($(window.parent.window).width()/2)-245;
	$(ObjW).css({\"top\":_top,\"left\":_left});

	//浏览器窗口发生变化时窗口位置
	$(window).resize(function(){
		_top  = parseInt($(window.parent.window).height()/2)-208 + $(window.parent.document).scrollTop();
		_left = parseInt($(window.parent.window).width()/2)-245;
		$(ObjW).css({\"top\":_top,\"left\":_left});
	});

	//鼠标按下时允许进行移动操作
	$(ObjT).mousedown(function(e){
		_move = true;
		_x = e.pageX - parseInt($(ObjW).css(\"left\"));
		_y = e.pageY - parseInt($(ObjW).css(\"top\"));
	});

	$(document).mousemove(function(e){
		if(_move){
			//移动时根据鼠标位置计算控件左上角的绝对位置
			var x = e.pageX - _x;
			var y = e.pageY - _y;
	
			//控件新位置
			$(ObjW).css({top:y,left:x});
		}
	}).mouseup(function(){
		_move = false;
	});
    
	
    //启动uploadify
    $('#uploadify').uploadify({
		'formData':{
			'$sessionName':'$sessionId',
			'timestamp':'$timestamp',
			'token':'$unique_salt',
			'$csrfParam':'$csrfValue',
			'dir':'$dir',
		},
		'swf':'$swf',
		'buttonImage':'$btnUrl',
		'uploader':'$uploaderUrl',
		//'debug':true,
		'queueSizeLimit':'$num',
		'fileSizeLimit':'$fileSize',
        'fileTypeExts':'$fileType',
		//'fileTypeExts':'',
		//'fileTypeDesc':'',
		'queueID':'$fileData',//fileQueue
		'onUploadStart':function(file){
			$('#uploadify').uploadify('settings', 'formData', {'iswatermark':$(\"#iswatermark\").attr(\"checked\")});
		},
		'onUploadSuccess':function(file, data, response){
		      console.debug(file);//返回文件具体对象
		      console.debug(data);//返回echo出来的数据
		      console.debug(response);//返回响应结果，true、false
            if($num > 1) {
                $(\".fileWarp ul\").append(SetImgContent(data));
            } else {
                $(\".fileWarp ul\").html(SetImgContent(data));
            }
			SetUploadFile();
		}
	});
	
    //点击保存按钮时
    $(\"#SaveBtn\").click(function(){
		var fileurl_tmp = \"\";
		var fileurl_val = new Array();
		var filetxt_val = new Array();
		var list = '';

		$(\"input[name^='fileurl_tmp']\").each(function(i){
			fileurl_val[i] = this.value;
		});

		$(\"input[name^='filetxt_tmp']\").each(function(i){
			filetxt_val[i] = this.value;
		});

		$(\"li.img\").each(function(i){
        	fileurl_tmp += '<li rel=\"'+ fileurl_val[i] +'\"><img height=\"140px\" src=\"$baseUrl'+fileurl_val[i]+'\" /><a href=\"javascript:void(0);\" class=\"delete\" data-url=\"'+fileurl_val[i]+'\">$delText</a></li>';
            list += fileurl_val[i]+',';
        });
        
        var parent = $(window.parent.document);
        if($num > 1) {
            //保存，把图片传递给图片展示框
            parent.find(\"#$widget\").next().find(\"#file_list\").append(fileurl_tmp);//相对位置
            //写入hidden input
            var oldValue = parent.find(\"#$widget\").val();
			if(oldValue == '') {
				var images = list;
			} else {
				var images = oldValue+','+list;
			}
			
			images.
			
			
            parent.find(\"#$widget\").val(images);
        } else {
            //保存，把图片传递给图片展示框
            parent.find(\"#$widget\").next().find(\"#file_list\").html(fileurl_tmp);//相对位置
            //写入hidden input
            parent.find(\"#$widget\").val(list);
        }
        
    	//移除iframe窗口
    	parent.find(\"#$frame\").remove();
    });
	
	//点击关闭或取消按钮时
    //隐藏父框架，清空列队，移除已上传文件样式
    $(\".Close, #CancelBtn\").click(function(){
    	$(\"#$frame\", window.parent.document).remove();
    	$('#uploadify').uploadifyClearQueue();
    	$(\".fileWarp ul li\").remove();
    });
");
?>

<div class="W">
	<div class="Bg">
	</div>
	<div class="Wrap">
		<div class="Title">
			<h3 class="MainTit"><?php echo $this->title; ?></h3>
			<a href="javascript:;" title="<?= Yii::t('uploadify', 'Close')?>" class="Close"> </a>
		</div>
		<div class="Cont">
			<p class="Note"><?php echo Yii::t('uploadify', 'Limit Numer:<strong>{num}</strong>,File Size:<strong>{fileSize}</strong>,Type:<strong>{fileType}</strong>',['num'=>$num, 'fileSize'=>$fileSize, 'fileType'=>$fileType])?></p>
			<div class="flashWrap">
				<input name="uploadify" id="uploadify" type="file" multiple="true" />
				<span><input type="checkbox" name="iswatermark" id="iswatermark"  <?php if(0) echo 'checked="checked"' ?> /><label><?php echo Yii::t('uploadify', 'Set Watermark')?></label></span>
			</div>
			<div class="fileWarp">
				<fieldset>
					<legend><?php echo Yii::t('uploadify', 'File List')?></legend>
					<ul class="clearfix"></ul>
					<div id="<?php echo $fileData;?>"></div>
				</fieldset>
			</div>
			<div class="btnBox">
            	<?php
                if( strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') ) {
					echo '<a href="###" target="_blank" class="browser">'.Yii::t('uploadify', 'Chrome collapse? To solve it').'</a>';
				}
				?>
			    <button class="btn" id="SaveBtn"><?= Yii::t('uploadify', 'Save')?></button>
				&nbsp;
				<button class="btn" id="CancelBtn"><?= Yii::t('uploadify', 'Cancel')?></button>
			</div>
		</div>
		<!--[if IE 6]>
		<iframe frameborder="0" style="width:100%;height:100px;background-color:transparent;position:absolute;top:0;left:0;z-index:-1;"></iframe>
		<![endif]-->
	</div>
</div>

<script type="text/javascript">
//设置上传后样式
function SetImgContent(data)
{
	if(data == '') {
		alert('<?php echo $failureText;?>');
		return;
	} else {
        var sLi = "";
        sLi += '<li class="img">';
        //onerror="this.src=\'nopic.png\'"
        sLi += '<img src="<?php echo $baseUrl;?>'+data+'" width="100" height="100">';
        sLi += '<input type="hidden" name="fileurl_tmp[]" value="' + data + '">';
        sLi += '<input type="text" name="filetxt_tmp[]" class="txt" value="">';
        sLi += '<a href="javascript:void(0);"><?php echo $delText;?></a>';
        sLi += '</li>';
        return sLi;
	}
}

//删除上传元素DOM并清除目录文件
function SetUploadFile()
{
	$("ul li").each(function(l_i){
		$(this).attr("id", "li_" + l_i);
	})
	$("ul li a").each(function(a_i){
		$(this).attr("rel", "li_" + a_i);
	}).click(function(){
		var _this = $(this);
		$.get(
			'<?php echo $uploaderUrl;?>',
			{action:"del", filename:$(this).prev().prev().val()},
			function(data){
				console.debug(data);
				_this.parent().remove();
			}
		);
	})
}
</script>



