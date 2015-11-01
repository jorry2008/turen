<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 广告类型侧边栏挂件
 * 只需给一个合适的高或者合适的宽，输出的图片就大小不失真
 */

namespace frontend\widgets;

use Yii;
use yii\base\InvalidConfigException;
use common\models\cms\Ad;
use common\helpers\General;

class SideAd extends \yii\base\Widget
{
// 	const TYPE_S = 'S';//单广告类型
// 	const TYPE_M = 'M';//多广告类型
	
// 	public $type = 'S';//默认为单广告

	public $width = 0;
	public $height = 0;
	public $short_code = '';
	
	//初始化
    public function init()
    {
        parent::init();
        
        if(empty($this->width) || (empty($this->height) && empty($this->short_code))) {
        	throw new InvalidConfigException('SideAd config is error.');
        }
    }
    
    //执行
    public function run()
    {
    	$uploadPath = Yii::getAlias('@backend').'/web/upload';
    	$model = Ad::findOne(['short_code'=>$this->short_code]);
    	if($model && is_file($uploadPath.'/'.$model->pic_url)) {
    		list($width, $height, $type, $attr) = getimagesize($uploadPath.'/'.$model->pic_url);
    		if($this->height && $this->width) {
    			//nothing
    		} elseif ($this->height) {
    			$this->width = floor($this->height*$width/$height);
    		} elseif ($this->width) {
    			$this->height = floor($this->width*$height/$width);
    		}
    		
    		$img = General::showImg($model->pic_url, 'c', $model->title, 'px', $this->width, $this->height);
    		return $this->render('side-ad', [
    			'model' => $model,
    			'img' => $img,
    		]);
    	} else {
    		return '';
    	}
    }
}
