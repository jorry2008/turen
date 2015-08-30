<?php

namespace common\components\helpers;

use Yii;
use yii\base\InvalidParamException;
// use yii\helpers\StringHelper;
// use yii\imagine\Image;
use yii\base\UnknownClassException;
use yii\helpers\FileHelper;

/**
 * 一些通用全局的特殊处理方法
 * @author Jorry
 *
 */
class General
{
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
     * @param UserGroup $models
     * @param int $pid
     * @param int $level
     * @param string $html
     */
    public static function recursiveObj($models, $pid=0, $level=0, $tip='|' ,$line='--.', $is_select = true)
    {
        static $tree = array();
        foreach($models as $model) {
            if($model->parent_id == $pid) {
                if($level != 0) {
                    if($is_select) {
                        $model->name = $tip.str_repeat($line, $level).$model->name;
                    } else {
                        $model->name = $tip.str_repeat($line, $level).'<span class="name">'.$model->name.'</span>';
                    }
                }
    
                $tree[] = $model;
                self::recursiveObj($models, $model->id, $level+1, $tip ,$line, $is_select);
            }
        }
        return $tree;
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
     * web/images/default/....
     */
    public static function uploadToWebFilePath($files, $dir = 'default', $mailDir = 'images')
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
                $basePath = Yii::getAlias('@webroot');
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
                    $pathArr[] = str_replace('\\', '/', $path.$fileName);
                } else {
                    return ['error'=>Yii::t('common', 'Please check your upload file or file name!')];
                }
            } else {
                throw new UnknownClassException('Is Not UploadedFile Instance!');
            }
            return implode(',', $pathArr);
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
    
}














