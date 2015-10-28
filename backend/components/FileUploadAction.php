<?php

namespace backend\components;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\helpers\Html;

use common\models\system\Explorer;

/**
 * 统一后台文件上传操作
 * @author Jorry <980522557@qq.com>
 *
 */
 
/*
 * 使用方法：
 * public function actions()
 {
	 return [
		 'file-update' => [
			 'class' => 'backend\components\FileUpdateAction',
		 ],
	 ];
 } */
 
class FileUploadAction extends Action
{
	public $uniqueSalt = '980522557@qq.com(jorry)';//自定义
	
	public function init()
	{
		parent::init();
	}
	
	public function run()
	{
		$ds = DIRECTORY_SEPARATOR;
		$basePath = Yii::getAlias('@upload');
		
		//仅删除图片操作
		if(Yii::$app->getRequest()->get('action', '') == 'del') {
			$path = Yii::$app->getRequest()->get('path');
			$field = Yii::$app->getRequest()->get('field');
			$dir = Yii::$app->getRequest()->get('dir');
			
			$filePath = $basePath.$ds.$path;
			if(is_file($filePath)) {
				if(@unlink($filePath)) {
					$data = [
						'action' => 'del',
						'field' => $field,
						'path' => $path,
						'dir' => $dir,
					];
					
					$this->addRecord($data);//删除一条旧记录
				}
			}
// 			fb($filePath);
			echo Json::encode([]);
			Yii::$app->end();
		}

		//上传图片
		if(Yii::$app->getRequest()->isPost) {
			$name = Yii::$app->getRequest()->post('name');
			$field = Yii::$app->getRequest()->post('field');
			$dir = Yii::$app->getRequest()->post('dir');
			$files = UploadedFile::getInstancesByName($name);
			$route = Yii::$app->getRequest()->post('route');
			
			$path = $basePath.$ds.$dir.$ds.date('Y-m');
			if(!is_dir($path) && !FileHelper::createDirectory($path)) {//创建不存在的目录
				//创建失败，权限问题
			}
			
			//存储
			$initialPreview = [];
			$initialPreviewConfig = [];
			foreach ($files as $file) {
				$newName = $file->baseName;//Yii::$app->security->generateRandomString();
				$filePath = $path.$ds.$newName.'.'.$file->extension;
				$file->saveAs($filePath);//生成新的文件名
				
				$key = $newName.'.'.$file->extension;//文件名
				$src = Yii::getAlias('@web').'/'.'upload'.'/'.$dir.'/'.date('Y-m').'/'.$key;
				$url = Url::to([$route, 'action'=>'del', 'dir'=>$dir, 'field'=>$field, 'path'=>$dir.'/'.date('Y-m').'/'.$key]);//删除按钮地址
				$initialPreview[] = Html::img($src, ['class'=>'file-preview-image', 'style'=>'height:160px']);
				$initialPreviewConfig[] = ['caption' => "{$key}", 'width' => '120px', 'url' => $url, 'key' => $key];
				
				$data = [
					'action' => 'ins',
					'field' => $field,
					'path' => $dir.'/'.date('Y-m').'/'.$key,
					'dir' => $dir,
				];
				$this->addRecord($data);//插入一条新记录
			}
			
			echo Json::encode([
				'initialPreview' => $initialPreview,
				'initialPreviewConfig' => $initialPreviewConfig,
				'append' => true
			]);
		}
	}
	
	/**
	 * 资源管理器
	 * @param array $data
	 * 数据：
	 * ['action' => $data['action'],
		'field' => $data['field'],
		'path' => $data['path'],
		'dir' => $data['dir'],]
	 */
	protected function addRecord($data)
	{
		//清除同名文件：
		if(!empty($data['path']))
			Explorer::deleteAll(['path'=>$data['path'], 'status'=>Explorer::STATUS_DRAFT]);
		
		if(!empty($data['field']) && !empty($data['path']) && !empty($data['dir']) && !empty($data['action'])) {
			$newData = [
				'is_exsit' => ($data['action'] == Explorer::ACTION_DEL)?Explorer::EXIST_NO:Explorer::EXIST_YES,
				'status' => Explorer::STATUS_DRAFT,//操作中，草稿状态
				
				'sesstion' => Yii::$app->getSession()->id,//资源限制在当前用户有效
				'action' => $data['action'],
				'field' => $data['field'],
				'path' => $data['path'],
				'dir' => $data['dir'],
			];
			
			$model = new Explorer();
			if($model->load($newData, '') && $model->save()) {
				fb($model->getErrors());
			}
		} else {
			fb('上传资源参数有误。');
		}
	}
	
	/**
	 * 哈希时间验证
	 */
	protected function checkSalt()
	{
		$request = Yii::$app->getRequest();
		if($request->post('token') == md5($this->uniqueSalt.$request->post('timestamp'))) {
			return true;
		} else {
			return false;
		}
	}
}
