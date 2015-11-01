<?php
/**
 * jorry2008 <980522557@qq.com>
 * 
 * 当前关联同辈类型侧边栏内容排行挂件
 * 
 * 注意：这个挂件只用在cms的列表和详情中，其它地方不生效
 */

namespace frontend\widgets;

use Yii;
use yii\base\InvalidConfigException;
use common\models\cms\Column;
use common\models\cms\Img;
use common\models\cms\Post;
use common\models\cms\Download;

/**
 * 类型如下：
 * n:new最新的[自动]
 * v:view查看次数最多的[自动]
 *
 * h:头条[后台指定]
 * c:推荐[后台指定]
 * a:特荐[后台指定]
 */
class SideCurrentTop extends \yii\base\Widget
{
	const TYPE_N = 'n';
	const TYPE_V = 'v';

	public $title = '热门图文';
	public $short_code = '';//栏目简码
	public $type = 'n';//默认为new
	public $num = 6;//显示六条
	public $length = 14;//截取标题长度
	
	private $id = '';
	private $controllerId = '';
	private $actionId = '';

	//初始化
	public function init()
	{
		parent::init();
		
		if(empty($this->title) || empty($this->num))
			throw new InvalidConfigException('SideImgTop config is error.');
		
		$this->id = Yii::$app->getRequest()->get('id', '');
		$this->controllerId = Yii::$app->controller->id;
		$this->actionId = Yii::$app->controller->action->id;
		
		if(!in_array($this->controllerId, ['img', 'post', 'download']))
			throw new InvalidConfigException('SideImgTop config controller is error.');
		
		if(!in_array($this->actionId, ['list', 'view']))
			throw new InvalidConfigException('SideImgTop config action is error.');
	}

	//执行
	public function run()
	{
		if(!empty($this->id)) {
			//自动寻找类型
			$class = 'common\\models\\cms\\'.ucfirst($this->controllerId);
			$all = $class::find();
			
			//选择栏目
			if(!empty($this->short_code)) {
				$all = $all->select($class::tableName().'.*')->joinWith([
					'column' => function ($query) {
						$query->where([Column::tableName().'.short_code'=>$this->short_code]);
					}
				]);
			}
			
			//自动判断
			if($this->actionId == 'view') {//详情
				$model = $class::findOne($this->id);//在详情中，直接获取栏目
				$all = $all->andWhere(['column_id'=>$model->column_id]);
			} elseif($this->actionId == 'list') {//列表
				$column = Column::findOne($this->id);//在列表中，直接获取栏目
				$all = $all->andWhere(['column_id'=>$column->id]);
			}
				
			//选择类型
			if(!empty($this->type)) {
				if($this->type == static::TYPE_N) {//自动取新
					$all = $all->orderBy($class::tableName().'.created_at DESC');
				} elseif($this->type == static::TYPE_V) {//自动取查看最多
					$all = $all->orderBy($class::tableName().'.hits DESC');
				} else {//后台指定
					$all = $all->andFilterWhere(['like', $class::tableName().'.flag', $this->type]);
				}
			}
				
			//限制数量
			$models = $all->active()->limit($this->num)->all();
				
			return $this->render('side-current-top', [
				'title'=>$this->title,
				'length' => $this->length,
				'models' => $models,
				'type' => $this->controllerId,
			]);
		}
	}
}
