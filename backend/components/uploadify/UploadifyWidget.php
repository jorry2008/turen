<?php

namespace backend\components\uploadify;

use Yii;
// use yii\helpers\Json;
use yii\helpers\Html;
// use yii\web\View;
use yii\widgets\InputWidget;


/**
 * Upload Widget
 *
 */
class UploadifyWidget extends InputWidget {
    /**
     * 指定当前使用上传组件的路由地址
     * @var string $route
     */
    public $route = '';
    
    /**
     * 图片上传到指定的目录
     * @var string $dir
     */
    public $dir = 'default';
    
    /**
     * 一次上传的文件数
     * @var int $num
     */
    public $num = 1;
    
    /**
     * 上传类型：单图或多图
     * @var string
     */
    public $type = 'multi';//or single
    
    /**
     * 触发的按键类名
     * @var string
     */
    public $btnClassName = 'file_add_button';
    
    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run() {
        $this->registerScripts();
        echo $this->renderTag();
        
//         if($this->type == 'multi') {
//         	echo $this->render('@app/components/uploadify/views/widget_upload', $params);
//         } elseif($this->type == 'single') {
//         	//nothing
//         }
    }

    /**
     * render file input tag
     * @return string
     */
    private function renderTag() {
        //兼容普通模式和模型模式两种
        if($this->type == 'multi') {
//         	if ($this->hasModel()) {
//         		return Html::activeHiddenInput($this->model, $this->attribute, $this->options);
//         	} else {
//         		return Html::hiddenInput($this->id, $this->value, $this->options);
//         	}
        } elseif($this->type == 'single') {
        	$attr = 'data-widget="'.$this->options['id'].'" data-frame="'.$this->attribute.'_frame" data-dir="'.$this->dir.'" data-num="'.$this->num.'" data-url="'.Yii::$app->getUrlManager()->createUrl($this->route).'" baseUrl="'.Yii::getAlias('@web').'"';
        	if ($this->hasModel()) {
        		return '<div class="input-group">'.Html::activeTextInput($this->model, $this->attribute, ['class'=>'form-control']).'<span class="input-group-addon '.$this->btnClassName.'" '.$attr.'><span title="'.Yii::t('uploadify', 'Upload picture').'"><i class="fa fa-upload"></i></span></div>';
        	} else {
        		throw new \Exception('请使用boostrap开发图片上传ui');
        	}
        }
    }

    /**
     * register script
     */
    private function registerScripts() {
        //$jsonOptions = Json::encode([]);
        //$('#{$this->id}').uploadify({$jsonOptions});
        $uploaderUrl = Yii::$app->getUrlManager()->createUrl($this->route);
        
        $script = <<<EOF
/*
 * 获取上传窗口函数
 * @access   public
 * @frame    string  调用iframeID
 * @title    string  弹出窗口标题
 * @num      string  可上传数量
 * @area     string  多附件时返回的内容区域
 */
function GetUploadify(url, frame, dir, num, widget)
{
    var src = '';
    if(url.indexOf("?") > 0 ) {
        src = url+'&dir='+dir+'&num='+num+'&frame='+frame+'&widget='+widget;
    } else {
        src = url+'?dir='+dir+'&num='+num+'&frame='+frame+'&widget='+widget;
    }
    
	$("body").append('<iframe frameborder="0" id="'+ frame +'" src="'+src+'" allowtransparency="true" style="position:absolute;top:0;left:0;width:100%;height:100%;display:none;z-index:9999;" scrolling="no"></iframe>');
	$("#" + frame).css("height",$(document).height()).show();
	$(window).resize(function(){
		$("#" + frame).css("height",$(document).height()).show();
	});
}

//操作代码
$(document).on('click', '.{$this->btnClassName}', function() {
    var frame = $(this).attr('data-frame');
    var url = $(this).attr('data-url');
    var dir = $(this).attr('data-dir');
    var num = $(this).attr('data-num');
    var widget = $(this).attr('data-widget');
    
    GetUploadify(url, frame, dir, num, widget);
});

//删除操作
$(document).on('click', '#file_list li a.delete', function() {
    var _this = $(this);
	$.get(
		'{$uploaderUrl}',
		{action:"del", filename:$(this).attr("data-url")},
		function(data){
			//console.debug(data);
		    //将当前的hidden表单的内容修改并整理
		    
			_this.parent().remove();
		}
	);
});
EOF;
        $this->getView()->registerJs($script);//, View::POS_LOAD
    }
}


