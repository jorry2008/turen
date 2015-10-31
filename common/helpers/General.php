<?php

namespace common\helpers;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Html;
use yii\base\UnknownClassException;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;

/**
 * 一些通用全局的特殊处理方法
 * @author Jorry
 *
 */
class General
{
	static $tree = [];//菜单静态变量
	
    /**
     * 客户端接收到的数据以指定['/', ' ', '_']整理为'-'
     */
    public static function dateTimeAsInt($data, $modelClassNmae, array $clumns)
    {
        $newData = $data;
        if(isset($data[$modelClassNmae]) && is_array($data[$modelClassNmae])) {
            $datas = $data[$modelClassNmae];
            foreach ($clumns as $clumn) {
                if(isset($datas[$clumn])) {
                    $newData[$modelClassNmae][$clumn] = strtotime(str_replace(['/', ' ', '_'], '-', $datas[$clumn]));
                } else {
                    throw new InvalidParamException("parameter error,Please try again after checking");
                }
            }
        } else {
            throw new InvalidParamException("parameter error,Please try again after checking");
        }
        
        return $newData;
    }
    
    //递归数组
    public static function recursiveArr(array $data, $pid = 0)
    {
        $arr = $row = [];
        foreach($data as $index => $row) {
            if($data[$index]['parent_id'] == $pid) {
                $row = self::recursiveArr($data, $data[$index]['id']);
                $arr[] = $row;
            }
        }
        
        return $arr;
    }
    
    /**
     * 对象无限级递归
     *
     * @param array $models
     * @param int $pid
     * @param int $level
     * @param string $html
     */
    public static function recursiveObj($models, $pid=0, $level=0, $tip='|' ,$line='--.', $is_select = true)
    {
        foreach($models as $model) {
            if($model->parent_id == $pid) {
                if($level != 0) {
                    if($is_select) {
                        $model->name = $tip.str_repeat($line, $level).$model->name;
                    } else {
                        $model->name = $tip.str_repeat($line, $level).'<span class="name">'.$model->name.'</span>';
                    }
                }
    
                self::$tree[] = $model;
                self::recursiveObj($models, $model->id, $level+1, $tip ,$line, $is_select);
            }
        }
        
        return self::$tree;
    }
    
    /**
     * 获取新model的keys
     */
    public static function getModelsKeys(array $models, $key='id')
    {
    	$keys = [];
    	foreach ($models as $model) {
    		$keys[] = $model->$key;
    	}
    	
    	return $keys;
    }
    
    /**
     * 批量上传到指定目录
     * 路径会被打乱，实现文件存储均衡
     * @param UploadedFile $files
     * @param string $dir
     * @param string $mailDir
     * @return string $str
     * web/upload/default/....
     */
    public static function uploadToWebFilePath($files, $dir = 'default', $mailDir = 'upload')
    {
        $pathArr = [];
        foreach ($files as $file) {
            if($file instanceof yii\web\UploadedFile) {
                $baseName = substr($file->name, 0, strpos($file->name, $file->extension)-1);
                if($file->baseName != $baseName) {
                    $file->error = UPLOAD_ERR_PARTIAL;
                }
                
                //格式验证(客户端已做了)
                
                //大小验证(客户端已做了)
                
                //origin为源图路径
                $ds = DIRECTORY_SEPARATOR;
                $basePath = Yii::getAlias('@resource');
                $path = $ds.$mailDir.$ds.'origin'.$ds.$dir.$ds.date('Y-m');
                $fileName = $ds.$file->baseName.'.'.$file->extension;
                if(!is_dir($basePath.$path)) {
                    if(!FileHelper::createDirectory($basePath.$path)) {
                        return ['error'=>Yii::t('common', 'Failed to create the images directory!')];
                    }
                }
                
                if($file->saveAs($basePath.$path.$fileName)) {
                    //Image::thumbnail($path, 100, 30)->save($newPath, ['quality' => 50]);//图片处理
                    //注意：这里非常重要，兼容通用平台
                	$pathArr[] = FileHelper::normalizePath($path.$fileName);
                } else {
                    throw new UnknownClassException(Yii::t('common', 'Please check your upload file or file name!'));
                }
            } else {
                throw new UnknownClassException('Is Not UploadedFile Instance!');
            }
            return $pathArr;
        }
    }
    
    /**
     * 
     * @return string
     */
    public static function generateDatePath($path = '')
    {
        $newPath = '';
        $ds = DIRECTORY_SEPARATOR;
        
        date('Y-M', time());
        
        return $newPath.date('Y-m');
    }
    
    /**
     * 生成指定前缀的单号
     */
    public static function generateStr($prefix='')
    {
        return $prefix.date('Ymdhis');
    }
    
    public function filterImg($str)
    {
    	/*PHP正则提取图片img标记中的任意属性*/
    	$str = '<center><img src="/uploads/images/20100516000.jpg" height="120" width="120"><br />PHP正则提取或更改图片img标记中的任意属性</center>';
    	
    	//1、取整个图片代码
//     	preg_match('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$str,$match);
//     	echo $match[0];
    	
    	//2、取width
//     	preg_match('/<img.+(width=\"?\d*\"?).+>/i',$str,$match);
//     	echo $match[1];
    	
    	//3、取height
//     	preg_match('/<img.+(height=\"?\d*\"?).+>/i',$str,$match);
//     	echo $match[1];
    	
    	//4、取src
//     	preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$match);
//     	echo $match[1];
    	
    	/*PHP正则替换图片img标记中的任意属性*/
    	//1、将src="/uploads/images/20100516000.jpg"替换为src="/uploads/uc/images/20100516000.jpg")
    	print preg_replace('/(<img.+src=\"?.+)(images\/)(.+\.(jpg|gif|bmp|bnp|png)\"?.+>)/i',"\${1}uc/images/\${3}",$str);
    	echo "<hr/>";
    	
    	//2、将src="/uploads/images/20100516000.jpg"替换为src="/uploads/uc/images/20100516000.jpg",并省去宽和高
    	print preg_replace('/(<img).+(src=\"?.+)images\/(.+\.(jpg|gif|bmp|bnp|png)\"?).+>/i',"\${1} \${2}uc/images/\${3}>",$str);
    }
    
    
    /**
     * 解析后台菜单链接地址
     * @param string $link 标准的url
     * @return unknown|multitype:mixed unknown
     */
    public static function parseUrl($link)
    {
    	$url = [];
    	if(empty($link)) {
    		return $url;
    	} else {
    		$str = substr($link, strpos($link, '?')+1);
    		if(empty($str)) return $url;
    		foreach (explode('&', $str) as $v) {
    			list($name, $value) = explode('=', $v);
    			if($name == 'r') {
    				$url[] = '/'.ltrim(str_replace(['/', '\\'], '/', $value), '/');
    			} else {
    				$url[$name] = $value;
    			}
    		}
    		
    		return $url;
    	}
    }
    
    /**
     * 展示uploadfile插件的图片
     */
    public static function showImages($file_str = '')
    {
    	if($file_str) {
    		$arr = explode(',', $file_str);
    		$newArr = [];
    		foreach ($arr as $path) {
    			$src = Yii::getAlias('@web').'/'.'upload'.'/'.$path;
    			$key = basename($path);
//     			$url = Url::to([$route, 'action'=>'del', 'dir'=>$dir, 'field'=>$field, 'path'=>$dir.'/'.date('Y-m').'/'.$key]);//删除按钮地址
    			$newArr[] = Html::img($src, ['class'=>'file-preview-image', 'alt'=>$key, 'title'=>$key, 'style'=>'height:160px;max-width:625px']);
    		}
    		return $newArr;
    	} else {
    		return [];
    	}
    }
    
    /**
     * 展示uploadfile插件删除链接
     */
    public static function showLinks($file_str = '', $field = '', $dir = '', $route = '')
    {
    	if($file_str) {
    		$arr = explode(',', $file_str);
    		$newArr = [];
    		foreach ($arr as $path) {
    			$src = Yii::getAlias('@web').'/'.'upload'.'/'.$path;
    			$key = basename($path);
    			$url = Url::to([$route, 'action'=>'del', 'dir'=>$dir, 'field'=>$field, 'path'=>$path]);//删除按钮地址
    			$newArr[] = ['caption' => "{$key}", 'width' => '120px', 'url' => $url, 'key' => $key];
    		}
    		return $newArr;
    	} else {
    		return [];
    	}
    }
    
    /**
     * 图片展示，通用方法
     * @param string $path 图片相对路径
     * @param string $deal 展示类型，以原图的方式展示'o',以切割处理的方式'c',默认'o'
     * @param string $type 以像素的方式'px'还是以百分比的方式'p'，没有则不加尺寸限制
     * @param int $height 纯数字整型
     * @param int $width 纯数字整型
     * @param string $priority 优先取宽或高 all、w、h
     * @return string <img />
     */
    public static function showImg($path, $deal, $alt, $type, $width, $height, $priority='all')
    {
    	$quality = Yii::$app->params['config']['config_pic_quality'];//图片处理质量
    	$basePath = Yii::getAlias('@backend');
    	$defaultPath = Yii::$app->params['config']['config_pic_no_picture'];//来自后台配置的一张no picture
    	$picUrl = Yii::$app->params['config']['config_pic_url'];//图片请求地址
    	$ds = DIRECTORY_SEPARATOR;
    	
    	$no_pic = !is_file($basePath.$ds.'web'.$ds.'upload'.$ds.$path);
    	
    	if($no_pic)//图片不存在
    		$path = $defaultPath;
    	
    	if($deal == 'c' || $no_pic) {//指定处理或者没有图片时处理
    		$bName = basename($path);
    		$nPath = str_replace($bName, $quality.'-'.$width.'x'.$height.'-'.$bName, $path);//新的文件路径
    		
    		//图片处理后，返回一个新的图片地址
    		$oFile = $basePath.$ds.'web'.$ds.'upload'.$ds.$path;
    		$nFile = $basePath.$ds.'web'.$ds.'upload'.$ds.'new'.$ds.$nPath;
    		
    		$no_nfile = !is_file($nFile);//切割的图片不存在
    		
    		if($type == 'px' && $no_nfile && $width && $height) {
    			if(!is_dir(FileHelper::normalizePath(dirname($nFile))))
    				FileHelper::createDirectory(FileHelper::normalizePath(dirname($nFile)));
    			
    			Image::thumbnail(FileHelper::normalizePath($oFile), $width, $height)
    			->save(FileHelper::normalizePath($nFile), ['quality' => $quality]);
    			
    			//切割后的新图片
    			$src = $picUrl.FileHelper::normalizePath($ds.'upload'.$ds.'new'.$ds.$nPath, '/');
    		} else {//已经存在切割后的图片，或者不满足切割条件
    			if($no_nfile)
    				$src = $picUrl.FileHelper::normalizePath($ds.'upload'.$ds.$path, '/');
    			else //已经存在切割后的图片
    				$src = $picUrl.FileHelper::normalizePath($ds.'upload'.$ds.'new'.$ds.$nPath, '/');
    		}
    	} elseif ($deal == 'o') {//直接展示原图
    		$src = $picUrl.FileHelper::normalizePath($ds.'upload'.$ds.$path, '/');
    	}
    	
    	if($type == 'px') {
    		if($height) $height .= 'px';
    		if($width) $width .= 'px';
    	} elseif($type == 'p') {
    		if($height) $height .= '%';
    		if($width) $width .= '%';
    	} else {
    		$height = $width = '';
    	}
    	
    	if($priority == 'w')
    		$height = '';
    	elseif($priority == 'h') 
    		$width = '';
    	
    	return Html::img($src, ['alt'=>$alt, 'title'=>$alt, 'height'=>$height, 'width'=>$width]);
    }
}














