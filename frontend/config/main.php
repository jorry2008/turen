<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
	'name' => Yii::t('common', '集方科技'),
	'version' => '1.0',
	'charset' => 'UTF-8',
	'sourceLanguage' => 'zh-CN', // 默认源语言
	'language' => 'zh-CN', // 默认当前环境使用的语言
    'bootstrap' => ['log'],
	//这个命名空间非常重要，是用来加载控制器类的（本质是用来指定路径的）
    'controllerNamespace' => 'frontend\modules\site\controllers',
	'defaultRoute' => 'site/home/index', // 默认路由
		
	'modules' => [
		'site' => [
			'class' => 'frontend\modules\site\Module',
		],
		'account' => [
			'class' => 'frontend\modules\account\Module',
		],
	],
		
    'components' => [
        'user' => [
            'identityClass' => 'common\models\account\Customer',
            'enableAutoLogin' => true,
        ],
    		
    	// 多语言配置
    	'i18n' => [
    		'translations' => [
    			'*' => [ // 界面翻译
    				'class' => 'yii\i18n\PhpMessageSource',
    				// 'sourceLanguage' => 'en-US',
    				'basePath' => '@app/messages',
    				'fileMap' => [ // 简单的映射
    					'common' => 'common.php',
    					'site' => 'site.php',
    					'account' => 'account.php',
    				]
    			],
    		]
    	],
    	
    	//url规则管理
    	'urlManager' => [
    		'enablePrettyUrl' => true,//开启路由的路径化
// 			'showScriptName' => false,//是否显示入口脚本index.php（This property is used only if [[enablePrettyUrl]] is true.）
// 			'suffix' => '.html',//
    		'rules' => [],
    	],
    	
    	// 错误句柄配置
    	// 这里可以指定也可以默认以优先的方式获取
    	// 注意：如果YII_DEBUG开启，则显示的是异常界面exception，如果关闭正式环境则是报错异常显示界面error
    	// 而如果开启调试则与异常界面无关~
    	// 正常上线：指定显示错误的路径
    	// 优先级：1.errorAction指定在布局内部显示，2.开启调试显示exception，3.关闭调试显示error
    	'errorHandler' => [
    		// use 'site/error' action to display errors
    		// 如果指定了这个路径，则系统还可以参与布局
    		'errorAction' => 'site/home/error' // '@app/manage/default/error',//指定错误显示界面路径site/error
    		// 'adminInfo'=>'980522557@qq.com',
    		// 'maxSourceLines'=>100,
    		// 'maxTraceSourceLines'=>100,
    		// 'discardOutput'=>true,
    	],
    	
    	//主题配置(module目录下的views > 根目录下的views > 主题下的模板)
    	'view' => [
    		'class' => 'yii\web\View',
    		'theme' => [
    			'class' => 'yii\base\Theme',
    			'basePath' => '@app/themes/default',//主题所在文件路径
    			'baseUrl' => '@app/themes/default',//与主题相关的url资源路径
    			'pathMap' => [
    				//这里可以优先使用指定主题，也可以指定最小单位主题
//                     '@app/views' => [
	//                         '@app/themes/default',//替换为default主题
	//                         '@app/themes/classic',//默认主题
	//                     ],
    				'@app/modules' => '@app/themes/default/modules',//模板
    				'@app/widgets' => '@app/themes/default/widgets',//部件
    				'@app/views' => '@app/themes/default',//布局
    			],
    		],
			//'renderers'//定义模板引擎
    	],
    	
    	//日志
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    	
    	//错误句柄
        'errorHandler' => [
            'errorAction' => 'site/home/error',
        ],
    ],
	
    'params' => $params,
];
