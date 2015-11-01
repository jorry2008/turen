<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 热门图片类型侧边栏挂件
 */

namespace frontend\widgets;

use common\models\cms\Img;
use common\models\cms\Column;

/**
 * 类型如下：
 * n:new最新的[自动]
 * v:view查看次数最多的[自动]
 *
 * h:头条[后台指定]
 * c:推荐[后台指定]
 * a:特荐[后台指定]
 */
class SideImgTop extends \yii\base\Widget
{
	const TYPE_N = 'n';
	const TYPE_V = 'v';

	public $title = '热门图文';
	public $short_code = '';//栏目简码
	public $type = 'n';//默认为new
	public $num = 6;//显示六条
	public $length = 14;//截取标题长度

	//初始化
	public function init()
	{
		parent::init();

		if(empty($this->title) || empty($this->num))
			throw new InvalidConfigException('SideImgTop config is error.');
	}

	//执行
	public function run()
	{
		$img = Img::find();
		 
		//选择栏目
		if(!empty($this->short_code)) {
			$img = $img->select(Img::tableName().'.*')->joinWith([
					'column' => function ($query) {
						$query->where([Column::tableName().'.short_code'=>$this->short_code]);
					}
			]);
		}
		 
		//选择类型
		if(!empty($this->type)) {
			if($this->type == static::TYPE_N) {//自动取新
				$img = $img->orderBy(Img::tableName().'.created_at DESC');
			} elseif($this->type == static::TYPE_V) {//自动取查看最多
				$img = $img->orderBy(Img::tableName().'.hits DESC');
			} else {//后台指定
				$img = $img->andFilterWhere(['like', Img::tableName().'.flag', $this->type]);
			}
		}
		 
		//限制数量
		$models = $img->active()->limit($this->num)->all();
//     	fb($models);
		
		if($models) {
			return $this->render('side-img-top', [
				'title'=>$this->title,
				'length' => $this->length,
				'models' => $models,
			]);
		}
	}
}
