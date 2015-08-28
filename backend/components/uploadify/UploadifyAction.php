<?php

namespace backend\components\uploadify;

use Yii;
use yii\base\Action;
// use yii\base\InvalidConfigException;
// use yii\helpers\Url;
// use yii\web\Response;
// use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use common\components\helpers\General;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
// use yii\helpers\FileHelper;

class UploadifyAction extends Action
{
    public $uniqueSalt = '980522557@qq.com(jorry)';//自定义
    public $timeOut = 600;//超时限制，默认十分钟
    private $fileData = 'Filedata';//这个可以设计成变化的因素
    
    public function init()
    {
        //仅删除图片操作
        if(Yii::$app->getRequest()->get('action', '') == 'del') {
            if(Yii::$app->getRequest()->get('filename', false)) {
                $fileName = Yii::$app->getRequest()->get('filename');
                $path = Yii::getAlias('@webroot').$fileName;
                if(is_file($path) && unlink($path)) {
                    @unlink(str_replace('origin/', '', $path));//尝试删除缓存
                    Json::encode(['status'=>0, 'msg'=>Yii::t('uploadify', 'Delete File Success')]);
                }
            }
            Yii::$app->end();
        }
        
        if(Yii::$app->getRequest()->isPost) {
            $this->initCsrf();//临时关闭csrf并校验session id（客户端组件不支持）
            
            //风险控制
            switch (false) {
                case $this->checkTimeOut():
                    echo Yii::t('uploadify', 'Upload timeout,Please refresh Page!');
                    break;  
                case $this->checkSalt():
                    echo Yii::t('uploadify', 'Salt no pass,Invalid Data!');
                    break;
                case $this->checkSession():
                    echo Yii::t('uploadify', 'Session no pass,Invalid Data!');
                    break;
                default:
                    //开始上传
                    //Yii::$app->getRequest()->post('iswatermark')//水印
                    $file = UploadedFile::getInstanceByName($this->fileData);
                    $result = General::uploadToWebFilePath([$file], Yii::$app->getRequest()->post('dir'));
                    if(is_array($result)) {
                        echo $result['error'];
                        //Json::encode(['status'=>0, 'msg'=>$result['error']]);
                    } else {
                        $pathInfo = $result;
                        
                        //调试
                        //file_put_contents(Yii::getAlias('@runtime').DIRECTORY_SEPARATOR.'test.txt', $pathInfo);
                        
                    }
                    echo $pathInfo;
                    //Json::encode(['status'=>0, 'msg'=>$pathInfo]);
            }
            
            Yii::$app->end();
        }
        
        parent::init();
    }

    public function run()
    {
        $params = Yii::$app->getRequest()->getQueryParams();
        if(empty($params['dir'])) {
            throw new BadRequestHttpException(Yii::t('uploadify', 'dir parameter not found'));
        }
        if(empty($params['num'])) {
            throw new BadRequestHttpException(Yii::t('uploadify', 'num parameter not found'));
        }
        if(empty($params['frame'])) {
            throw new BadRequestHttpException(Yii::t('uploadify', 'frame parameter not found'));
        }
        if(empty($params['widget'])) {
            throw new BadRequestHttpException(Yii::t('uploadify', 'widget parameter not found'));
        }
        $fileSize = Yii::$app->params['config']['config_pic_size'];
        $fileType = implode(';', explode(',', Yii::$app->params['config']['config_pic_extension']));
        
        //重置loyout
        $this->controller->layout = '@app/components/uploadify/views/upload_main';
        //渲染内容
        return $this->controller->render('@app/components/uploadify/views/upload', ['fileData'=>$this->fileData, 'widget'=>$params['widget'], 'uniqueSalt'=>$this->uniqueSalt, 'dir'=>$params['dir'], 'frame'=>$params['frame'] ,'num'=>$params['num'], 'fileSize'=>$fileSize, 'fileType'=>$fileType]);
    }
    
    /**
     * 处理csrf，并验证session
     */
    private function initCsrf()
    {
        //verify csrf in session
        Yii::$app->request->enableCsrfValidation = true;
        Yii::$app->request->enableCsrfCookie = false;
    }
    
    /**
     * 校验session
     */
    protected function checkSession()
    {
        $session = Yii::$app->getSession();
        $request = Yii::$app->getRequest();
        
        $session->open();
        $sessionName = $session->getName();
        $sessionId = $session->getId();
        $postSessionId = $request->post($sessionName);
        
        return $sessionId == $postSessionId;
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
    
    /**
     * 超时校验
     */
    protected function checkTimeOut()
    {
        $request = Yii::$app->getRequest();
        $time = $request->post('timestamp');
        return $this->timeOut > (time()-$time);
    }
}
