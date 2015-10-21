<?php

namespace frontend\modules\site\controllers;

use Yii;

class TestController extends \frontend\components\Controller
{
	public function actionSendMail()
	{
		$form = array();
		$form['name'] = '王老五';
		$form['contact'] = '13725514524';
		
// 		['config_email_host'] => 'smtp.163.com'
// 		['config_email_username'] => 'xiayouqiao2008@163.com'
// 		['config_email_password'] => '13635862687xyqss'
// 		['config_email_port'] => 25
// 		['config_email_to'] => '2971030686@qq.com'
// 		['config_email_bcc'] => '980522557@qq.com'
		
		//, 'html' => 'call-html'
		Yii::$app->mailer->compose(['text' => 'call-text'], ['from' => $form])//内容整合？
			->setFrom([Yii::$app->params['config']['config_email_username']=>Yii::$app->name])//发送来源
			->setSubject('邮件标题')//邮件标题？
			->setTo('2971030686@qq.com')//发送对象邮箱？
			->setBcc(Yii::$app->params['config']['config_email_bcc'])//密送邮箱
			->send();//发送
		
	}
}
