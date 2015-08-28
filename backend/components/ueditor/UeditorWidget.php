<?php

namespace backend\components\ueditor;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
// use yii\web\View;
use yii\widgets\InputWidget;

class UeditorWidget extends InputWidget
{
    //配置选项，参阅Ueditor官网文档(定制菜单等)
    public $clientOptions = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->id = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->id;
        // 默认配置
        $options = [
            'serverUrl' => Url::to(['ueditor']),//上传配置
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '400',
            'lang' => strtolower(Yii::$app->language),
        ];
        $this->clientOptions = ArrayHelper::merge($options, $this->clientOptions);
        
        parent::init();
    }

    public function run()
    {
        $this->registerClientScript();
        
        if ($this->hasModel()) {
            return Html::activeTextarea($this->model, $this->attribute, ['id' => $this->id, 'style'=>';']);
        } else {
            return Html::textarea($this->id, $this->value, ['id' => $this->id, 'style'=>';']);
        }
        
//         $value = '';
//         if ($this->hasModel()) {
//             $value = Html::getAttributeValue($this->model, $this->attribute);
//         } else {
//             $value = $this->value;
//         }
//         //return Html::tag('script', $value, ['id'=>$this->id, 'type'=>'text/plain']);
//         return Html::script($value, ['id'=>$this->id, 'type'=>'text/plain']);
    }

    /**
     * 注册客户端脚本
     */
    protected function registerClientScript()
    {
        $tokenName = Yii::$app->getRequest()->csrfParam;
        $tokenValue = Yii::$app->getRequest()->getCsrfToken();
        
        UeditorAsset::register($this->view);
        $clientOptions = Json::encode($this->clientOptions);
        $script = "var ue = UE.getEditor('" . $this->id . "', " . $clientOptions . ");";
        $script .= "ue.ready(function() {ue.execCommand('serverparam', {\"{$tokenName}\": \"{$tokenValue}\"});});";
//         if ($this->readyEvent) {
//             $script .= ".ready(function(){{$this->readyEvent}});";
//         }
        $this->view->registerJs($script, yii\web\View::POS_READY);//显示时的效果好一些
    }
}