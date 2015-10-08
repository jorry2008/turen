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
	'name' => Yii::t('common', '默认系统名'),
	'version' => '1.0',
	'charset' => 'UTF-8',
	'sourceLanguage' => 'en-US', // 默认源语言
	'language' => 'zh-CN', // 默认当前环境使用的语言
	//这个命名空间非常重要，是用来加载控制器类的（本质是用来指定路径的）
    'controllerNamespace' => 'frontend\modules\site\controllers',
	'defaultRoute' => 'site/home/index', // 默认路由
	
	'bootstrap' => [
		'log',
		// 详情查看：yii\base\Application::init();
		'common\components\InitSystem', // 引入一个配置类，用户初始化系统Yii::$app->params
	],
	
	'modules' => [
		'site' => [
			'class' => 'frontend\modules\site\Module',
		],
		'account' => [
			'class' => 'frontend\modules\account\Module',
		],
	],
		
    'components' => [
    	//前台用户组件
    	'user' => [
//     		'class' => 'yii\web\User',//默认
    		// 指定认证类，这个为可以由模型实现
    		'identityClass' => 'common\models\account\Customer',
    		// 重点，当开始基于cookie登录时，这个数组就是初始化系列化持久的cookie初始值
    		// 即专为身份验证的cookie配置专用的cookie对象，以下就是对象的初始化参数
    		'identityCookie' => [
    			'name' => '_frontend_identity',
    			'httpOnly' => true
   			], // 可以实现如子站点同时登录
    		// 是否启用基于cookie的登录，即保持cookie和session的相互恢复，所以它是基于session
    		'enableAutoLogin' => true,
    		// 是否基于会话，如果是restful，那么关闭使用无状态验证访问
    		'enableSession' => true,
    		// 登录的有效时间，也叫验证的有效时间，如果没有设置则以seesion过期时间为准
    		// 即，用户在登录状态下未操作的时间间隔有效为authTimeout，超过就退出，Note that this will not work if [[enableAutoLogin]] is true.
    		'authTimeout' => null,
    		// 设置一个绝对的登出时间
    		'absoluteAuthTimeout' => null,
    		// 持久层是否延续最新时间，使cookie保持最新
    		'autoRenewCookie' => true,
    		// 基于loginRequired()，不可为null
    		'loginUrl' => [
    			'/account/common/login'
    		],
    		
    		// 以下是以session来存储相关的参数值的
    		'authTimeoutParam' => '__frontend_expire', // 过期时间session标识
    		'idParam' => '__frontend_id', // 用户登录会话id的session标识
    		'absoluteAuthTimeoutParam' => '__frontend_absoluteExpire',
    		'returnUrlParam' => '__frontend_returnUrl' // 这个是重点，实现无权访问再登录后跳转到原来的rul，这个url就是__returnUrl，记录在session中
    	],
    		
    	// 多语言配置
    	'i18n' => [
    		'translations' => [
    			'*' => [ // 界面翻译
    				'class' => 'yii\i18n\PhpMessageSource',
    				// 'sourceLanguage' => 'en-US',
    				'basePath' => '@app/messages',
//     				'fileMap' => [ // 简单的映射
//     					'common' => 'common.php',
//     					'site' => 'site.php',
//     					'account' => 'account.php',
//     					'customer' => 'customer.php',
//     					'user' => 'user.php',
//     				]
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
    	
    	//资源组件配置
    	'assetManager' => [
    		'bundles' => [
    			'yii\web\JqueryAsset' => false,//禁用原生的jquery版本
    		],
    	],
    	
    	//日志组件配置
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
