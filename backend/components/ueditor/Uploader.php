<?php

namespace backend\components\ueditor;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;

class Uploader {
	private $field; // 文件域名
	private $config; // 配置信息
	
	private $originalName; // 原始文件名
	private $title; // 新文件名
	private $url; // 完整文件名,即从当前配置目录开始的URL
	private $size; // 文件大小
	private $type; // 文件类型
	private $state = 'SUCCESS'; // 上传状态信息,默认为成功
	
	/**
	 * 构造函数
	 * 是否解析base64编码，可省略。若开启，则$field代表的是base64编码的字符串表单名
	 * @param $field 表单名称        	
	 * @param $config 配置项        	
	 * @param string $type
	 */
	public function __construct($field, $config, $mode = 'upload') {
		$this->field = $field;
		$this->config = $config;
		
		if($mode == 'remote') {
			$this->saveRemote();//抓取远程图片
		} else if($mode == 'base64') {
			$this->uploadBase64(); // 涂鸦编码
		} else if($mode == 'upload') {
			$this->uploadFile(); // 正常的文件
		}
	}
	
	/**
	 * 上传文件的主处理方法
	 * @return mixed
	 */
	protected function uploadFile() {
		$uploadedFile = UploadedFile::getInstanceByName($this->field);
		
		//文件未找到
		if(!$uploadedFile) {
			$this->state = Yii::t('ueditor', 'Not found file');
			return false;
		}
		
		//上传过程中的错误
		if($uploadedFile->getHasError()) {
			$this->state = $this->getServerError($uploadedFile->error);
			return false;
		}
		
		//配置文件大小限制
		if($uploadedFile->size > $this->config['maxSize']) {
			$this->state = Yii::t('ueditor', 'File size beyond ueditor limit');
			return false;
		}
		
		//文件类型检查
		if(!in_array('.'.$uploadedFile->getExtension(), $this->config['allowFiles'])) {
			$this->state = Yii::t('ueditor', 'Ueditor not allowed file types');
			return false;
		}
		
		$this->originalName = $uploadedFile->name;
		$this->size = $uploadedFile->size;
		$this->type = $uploadedFile->type;//image/jpeg
		
		$this->url = FileHelper::normalizePath($this->renameFullFile().'.'.$uploadedFile->getExtension());//重命名文件
		$pathinfo = pathinfo($this->url);
		$basePath = Yii::getAlias('@backend/web/');
		$this->filePath = FileHelper::normalizePath($basePath.$pathinfo['dirname'].DIRECTORY_SEPARATOR.$pathinfo['basename']);
		$this->title = $pathinfo['basename'];
		
		//转化为web路径
		$this->url = Yii::getAlias('@web').str_replace('\\', '/', $this->url);//存储入库之前必须要过滤
		
		$dirname = dirname($this->filePath);
		
		// 创建目录失败
		if(!is_dir($dirname) && !FileHelper::createDirectory($dirname)) {
			$this->state = Yii::t('ueditor', 'Failed to create the upload directory');
			return false;
		} else if(!is_writeable($dirname)) {
			$this->state = Yii::t('ueditor', 'Do not write to upload directory');
			return false;
		}
				
		if(!$uploadedFile->saveAs($this->filePath)) {
			$this->state = Yii::t('ueditor', 'Failed to upload file');
			return false;
		}
	}
	
	/**
	 * 处理base64编码的图片上传
	 * 
	 * @return mixed
	 */
	protected function uploadBase64() {
		$base64Data = Yii::$app->getRequest()->post($this->field);
		if($base64Data) {
			$img = base64_decode($base64Data);//图片内容，png
			
			$this->originalName = $this->config['oriName'];//涂鸦原始名称
			$this->size = strlen($img);
			$this->type = 'image/png';
			
			$this->url = FileHelper::normalizePath($this->renameFullFile().'.png');//重命名文件
			$pathinfo = pathinfo($this->url);
			$basePath = Yii::getAlias('@backend/web/');
			$this->filePath = FileHelper::normalizePath($basePath.$pathinfo['dirname'].DIRECTORY_SEPARATOR.$pathinfo['basename']);
			$this->title = $pathinfo['basename'];
			
			//转化为web路径
			$this->url = Yii::getAlias('@web').str_replace('\\', '/', $this->url);//存储入库之前必须要过滤
			
			$dirname = dirname($this->filePath);
			
			//配置文件大小限制
			if($this->size > $this->config['maxSize']) {
				$this->state = Yii::t('ueditor', 'File size beyond ueditor limit');
				return false;
			}
			
			// 创建目录失败
			if(!is_dir($dirname) && !FileHelper::createDirectory($dirname)) {
				$this->state = Yii::t('ueditor', 'Failed to create the upload directory');
				return false;
			} else if(!is_writeable($dirname)) {
				$this->state = Yii::t('ueditor', 'Do not write to upload directory');
				return false;
			}
			
			// 存储涂鸦到指定文件
			if(!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) { // 移动失败
				$this->state = Yii::t('ueditor', 'Failed to upload file');
				return false;
			}
		} else {
			$this->state = Yii::t('ueditor', 'Not found file');
			return false;
		}
	}
	
	/**
	 * 拉取远程图片
	 * 
	 * @return mixed
	 */
	protected function saveRemote() {
		$imgUrl = htmlspecialchars($this->field);
		$imgUrl = str_replace('&amp;', '&', $imgUrl);
		
		// http开头验证
		if(strpos($imgUrl, 'http') !== 0) {
			$this->state = Yii::t('ueditor', 'Http link error');
			return false;
		}
		
		// 获取请求头并检测死链
		//解析http head
		$imgHeader = [];
		$fp = fopen($imgUrl, 'r');
		$heads = stream_get_meta_data($fp);
		$heads = $heads['wrapper_data'];
		
		if(!(stristr($heads[0], '200') && stristr($heads[0], 'OK'))) {
			$this->state = Yii::t('ueditor', 'Http head error');
			return false;
		}
		
		// 格式验证(扩展名验证和Content-Type验证)
		$type = stristr($heads[4], 'image');
		if(empty($type)) {
			$this->state = Yii::t('ueditor', 'Http content type error');
			return false;
		}
		
		$ext = strtolower(strrchr($imgUrl, '.'));
		if(!in_array($ext, $this->config['allowFiles'])) {
			Yii::t('ueditor', 'Ueditor not allowed file types');
			return false;
		}
		
		// 打开输出缓冲区并获取远程图片
		ob_start();
		$context = stream_context_create([ 
				'http' =>[ 
					'follow_location' => false 
				] // don't follow redirects
		]);
		readfile($imgUrl, false, $context);
		$img = ob_get_contents();
		ob_end_clean();
		
		preg_match('/[\/]([^\/]*)[\.]?[^\.\/]*$/', $imgUrl, $m);
		
		$this->originalName = $m?$m[1]:'';
		$this->size = strlen($img);
		$this->type = $type;
		$this->url = FileHelper::normalizePath($this->renameFullFile().$ext);//重命名文件
		$pathinfo = pathinfo($this->url);
		$basePath = Yii::getAlias('@backend/web/');
		$this->filePath = FileHelper::normalizePath($basePath.$pathinfo['dirname'].DIRECTORY_SEPARATOR.$pathinfo['basename']);
		$this->title = $pathinfo['basename'];
			
		//转化为web路径
		$this->url = Yii::getAlias('@web').str_replace('\\', '/', $this->url);//存储入库之前必须要过滤
			
		$dirname = dirname($this->filePath);
			
		//配置文件大小限制
		if($this->size > $this->config['maxSize']) {
			$this->state = Yii::t('ueditor', 'File size beyond ueditor limit');
			return false;
		}
			
		// 创建目录失败
		if(!is_dir($dirname) && !FileHelper::createDirectory($dirname)) {
			$this->state = Yii::t('ueditor', 'Failed to create the upload directory');
			return false;
		} else if(!is_writeable($dirname)) {
			$this->state = Yii::t('ueditor', 'Do not write to upload directory');
			return false;
		}
		
		// 存储远程文件到指定文件
		if(!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) { // 移动失败
			$this->state = Yii::t('ueditor', 'Failed to upload file');
			return false;
		}
	}
	
	/**
	 * 获取服务器级别错误
	 * @param $errCode 来自服务器上的错误代码
	 * @return string
	 */
	private function getServerError($errCode)
	{
		$info = [
			UPLOAD_ERR_OK => Yii::t('ueditor', 'Upload success'),
			UPLOAD_ERR_INI_SIZE => Yii::t('ueditor', 'File size over server size configuration'),
			UPLOAD_ERR_FORM_SIZE => Yii::t('ueditor', 'File size over form size configuration'),
			UPLOAD_ERR_PARTIAL => Yii::t('ueditor', 'Local server error'),
			UPLOAD_ERR_NO_FILE => Yii::t('ueditor', 'Not found upload file'),
			UPLOAD_ERR_NO_TMP_DIR => Yii::t('ueditor', 'Not found tmp file'),
			UPLOAD_ERR_CANT_WRITE => Yii::t('ueditor', 'Tmp file cannot be read'),
			UPLOAD_ERR_EXTENSION => Yii::t('ueditor', 'File type was limited by the server'),
		];
		
		return !empty($info[$errCode])?$info[$errCode]:Yii::t('ueditor', 'Unknown Error');
	}
	
	/**
	 * 重命名文件
	 * 
	 * @return string
	 */
	private function renameFullFile() {
		// 替换日期事件
		$format = $this->config['pathFormat'];
		$format = str_replace('{yyyy}', date('Y'), $format);
		$format = str_replace('{yy}', date('y'), $format);
		$format = str_replace('{mm}', date('m'), $format);
		$format = str_replace('{dd}', date('d'), $format);
		$format = str_replace('{hh}', date('H'), $format);
		$format = str_replace('{ii}', date('i'), $format);
		$format = str_replace('{ss}', date('s'), $format);
		$format = str_replace('{time}', time(), $format);
		
		// 过滤文件名的非法自负,并替换文件名
		$originalName = substr($this->originalName, 0, strrpos($this->originalName, '.'));
		$originalName = preg_replace('/[\|\?\'\<\>\/\*\\\\]+/', '', $originalName);
		$format = str_replace('{title}', $originalName, $format);
		
		// 替换随机字符串
		$randNum = rand(1, 10000000000) . rand(1, 10000000000);
		if(preg_match('/\{rand\:([\d]*)\}/i', $format, $matches)) {
			$format = preg_replace('/\{rand\:[\d]*\}/i', substr($randNum, 0, $matches[1]), $format);
		}
		
		return $format;
	}
	
	/**
	 * 获取当前上传成功文件的各项信息
	 * 
	 * @return array
	 */
	public function getFileInfo() {
		return array(
				'state' => $this->state,//上传状态，上传成功时必须返回'SUCCESS'
				'url' => $this->url,//返回的真实文件地址
				'title' => $this->title,//新文件名
				'original' => $this->originalName,//原始文件名
				'type' => $this->type,//文件类型
				'size' => $this->size, //文件大小
		);
	}
	
	/**
	 * 过滤所有通过此插件上传的文件，
	 * 从而实现localhost和域名的形式都可以正常显示文件
	 */
	public static function filterContentSrc($content)
	{
		
		
		
		
		return $content;
	}
}