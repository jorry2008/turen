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
    'bootstrap' => ['log'],
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
            'identityClass' => 'common\models\account\User',
            'enableAutoLogin' => true,
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
    	
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    	
        'errorHandler' => [
            'errorAction' => 'site/home/error',
        ],
    ],
	
    'params' => $params,
];
