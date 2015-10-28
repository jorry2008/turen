<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	
    'components' => [
    	//文件缓存
    	'cache' => [
    		'class' => 'yii\caching\FileCache',
    		'cachePath' => '@common/runtime/cache',//缓存在公共目录
    		'directoryLevel' => 2
    	],
    	
    	//正式环境数据库
    	'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=banjia-la.com',
            'username' => 'pma',
            'password' => 'rL5p2wU6ZEaLxmbd',
            'tablePrefix' => 't_',
            'charset' => 'utf8',
        ],
    	
    	//发送邮件配置
    	'mailer' => [
    		'class' => 'yii\swiftmailer\Mailer',//这个类中配置模板
    		'viewPath' => '@common/mail',
    		
    		//开发调试用的
    		'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
    		'fileTransportPath' => '@runtime/mail',//配合FileTransport，指定邮件内容的缓冲位置
    		
//     		'htmlLayout' => 'layouts/html',//默认
//     		'textLayout' => 'layouts/text',//默认
    		
    		'enableSwiftMailerLogging' => true,//开启log
    		'transport' => [
    			'class' => 'Swift_SmtpTransport',
    			'host' => 'smtp.163.com',
    			'username' => 'xiayouqiao2008@163.com',
    			'password' => '13635862687xyqss',
    			'port' => '25',
    			'encryption' => 'tls',//tls or ssl(可以认为tls为ssl的升级版)
    		],
    		'messageConfig'=>[//这部分可以在send发邮件时临时配置！！！！
//     			'class' => 'yii\mail\BaseMessage',
    			'charset'=>'UTF-8',
//     			'from'=>['xiayouqiao2008@163.com'=>'jorry2008'],
//     			'bcc' => ['980522557@qq.com'=>'夏又桥'],//加密超送，(cc为普通超送)
    		],
    	],
    ],
];
