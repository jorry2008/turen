<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 热门单页类型侧边栏挂件
 */

namespace frontend\widgets;

class SidePage extends \yii\base\Widget
{
	public $title = '';
	
	//初始化
    public function init()
    {
        parent::init();
        
        
    }
    
    //执行
    public function run()
    {
    	
    	
    	
    	return $this->render('side-page', [
    		'title'=>$this->title
    	]);
    }
}
