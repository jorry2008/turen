<?php
$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'), 
    require (__DIR__ . '/../../common/config/params-local.php'), 
    require (__DIR__ . '/params.php'), 
    require (__DIR__ . '/params-local.php')
);

// 参数的使用方法如下：
// echo \Yii::$app->params['adminEmail'];

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'name' => Yii::t('common', 'turen'),
    'version' => '1.0',
    'charset' => 'UTF-8',
    'sourceLanguage' => 'en-US', // 默认源语言
    'language' => 'zh-CN', // 默认当前环境使用的语言
    'controllerNamespace' => 'backend\modules\user\controllers',//默认预加载控制器类的命名空间()
    'defaultRoute' => 'user/common/default', // 默认路由，后台默认首页
    
    'layout' => 'main', // 默认布局
//     'viewPath' => '@app/themes/classic',
//     'layoutPath' => '@app/themes/classic/layouts',
    
    /*
     * - 指定的组件id - 指定的modules id - 类名 - 配置数组
     */
    'bootstrap' => [
        'log', // 以id的方式引入一个类
        // 详情查看：yii\base\Application::init();
        'common\components\InitSystem', // 引入一个配置类，用户初始化系统Yii::$app->params
        
//         'backend\components\Test', // 以命名空间的方式引入一个类到系统
//         [ // 带参数的方式引入一个类
//             'class' => 'backend\components\Test2',
//             'prop1' => 'value1',
//             'prop2' => 'value2'
//         ],
//         'backend\components\Test2Boot' // 实现bootstrap接口的类引入
    ],
    
    // 模块配置
    'modules' => [
        'auth' => [ // 权限模块
            'class' => 'backend\modules\auth\AuthModule'
        ],
        'user' => [ // 管理员模块
            'class' => 'backend\modules\user\UserModule',
            //'viewPath' => '@app/themes/classic/user',//强制模块的主题
            //'controllerNamespace' => ''//优先使用默认命名空间
        ],
        'system' => [//系统核心模块
            'class' => 'backend\modules\system\SystemModule',
        ],
        'customer' => [// 会员模块
            'class' => 'backend\modules\customer\CustomerModule',
        ],
        'catalog' => [
            'class' => 'backend\modules\catalog\CatalogModule',
        ],
        'cms' => [
            'class' => 'backend\modules\cms\CmsModule',
        ],
    ],
    
    // 配置维护模式配置
    // 'catchAll'=>[
    // 'offline/notice',
    // 'param1'=>'value1',
    // 'param2'=>'value2',
    // ],
    
    'components' => [
        // 用户持久组件配置
        'user' => [
            // 'class' => 'yii\web\User',//默认
            // 指定认证类，这个为可以由模型实现
            'identityClass' => 'common\models\user\User',
            // 重点，当开始基于cookie登录时，这个数组就是初始化系列化持久的cookie初始值
            // 即专为身份验证的cookie配置专用的cookie对象，以下就是对象的初始化参数
            'identityCookie' => [
                'name' => '_turen_identity',
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
                '/user/common/login'
            ],
            
            // 以下是以session来存储相关的参数值的
            'authTimeoutParam' => '__turen_expire', // 过期时间session标识
            'idParam' => '__id', // 用户登录会话id的session标识
            'absoluteAuthTimeoutParam' => '__turen_absoluteExpire',
            'returnUrlParam' => '__turen_returnUrl' // 这个是重点，实现无权访问再登录后跳转到原来的rul，这个url就是__returnUrl，记录在session中
        ],
        
        //主题配置(module目录下的views > 根目录下的views > 主题下的模板)
        'view' => [
            'class' => 'yii\web\View',
            'theme' => [
                'class' => 'yii\base\Theme',
                'basePath' => '@app/themes/classic',//主题所在文件路径
                'baseUrl' => '@app/themes/classic',//与主题相关的url资源路径
                'pathMap' => [
                        //这里可以优先使用指定主题，也可以指定最小单位主题
//                     '@app/views' => [
//                         '@app/themes/default',//替换为default主题
//                         '@app/themes/classic',//默认主题
//                     ],
                    '@app/modules' => '@app/themes/classic/modules',//模板
                    '@app/widgets' => '@app/themes/classic/widgets',//部件
                    '@app/views' => '@app/themes/classic',//布局
                ],
            ],
            //'renderers'//定义模板引擎
        ],
        
        // 多语言组件配置
        'i18n' => [
            'translations' => [
                '*' => [ // 界面翻译
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                    'fileMap' => [ // 简单的映射
                        'common' => 'common.php',
                        'user-group' => 'user-group.php',
                        'user' => 'user.php',
                        'yii' => 'yii.php',
                    ]
                ],
            ]
        ],
        
        // 处理本地化格式，包括时间、货币、语言习惯
        'formatter' => [
            'timeZone' => 'Asia/Shanghai', // 上海时间
            'defaultTimeZone' => 'UTC', // 使用协调世界时
            'nullDisplay' => 0,//未设置时的默认值
            'dateFormat' => 'short',
            'timeFormat' => 'short',
            'datetimeFormat' => 'short'
        // currencyCode
        ],
        
        // 文件缓存
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'directoryLevel' => 2
        ],
        
        // session配置
        'session' => [
            'class' => 'yii\web\DbSession',//也可以转移到memcache缓存，CacheSession
            'name' => 'turen_session',
            'sessionTable' => '{{%session}}',
            'timeout' => 3600 // 超时设置
        ],
        
        // rbac权限配置
        'authManager' => [
            'class' => 'backend\components\DbManager',
            //'defaultRoles'=>[],//这里指定默认被开放访问的角色
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}'
            // 'cache' => 'cache',//see yii\rbac\DbManager默认不启用缓存
        ],
        
        //url规则管理
        'urlManager' => [
            'enablePrettyUrl' => true,//开启路由的路径化
            'showScriptName' => false,//是否显示入口脚本index.php（This property is used only if [[enablePrettyUrl]] is true.）
            // 'suffix' => '.html',//
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
            'errorAction' => 'user/common/error' // '@app/manage/default/error',//指定错误显示界面路径site/error
             // 'adminInfo'=>'980522557@qq.com',
             // 'maxSourceLines'=>100,
             // 'maxTraceSourceLines'=>100,
             // 'discardOutput'=>true,
        ],
        
        // 日志配置
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ]
    
    // 加入一个自定义组件
    // 'testDemo' => [
    // 'class' => 'backend\components\testDemo',
    // ],
    
    // 这是一个更高效的方法
    // 'testDemo' => function() {
    // return new \backend\components\TestDemo;
    // },
    ],
    
    'params' => $params // 自定义参数
];




 //拓展库
 /*
'extensions' => [
    'name' => 'extension name',
    'version' => 'version number',
    'bootstrap' => 'BootstrapClassName',// optional, may also be a configuration array
    'alias' => [
        '@alias1' => 'to/path1',
        '@alias2' => 'to/path2',
    ],
],
*/
//例如：
/*
'yiisoft/yii2-gii' => 
[
    'name' => 'yiisoft/yii2-gii',
    'version' => '2.0.4.0',
    'bootstrap' => '',
    'alias' => [
        '@yii/gii' => $vendorDir . '/yiisoft/yii2-gii',
    ],
]
*/

//以下核心服务于控制台和website网站中
// 'log' => ['class' => 'yii\log\Dispatcher'],
// 'view' => ['class' => 'yii\web\View'],
// 'formatter' => ['class' => 'yii\i18n\Formatter'],
// 'i18n' => ['class' => 'yii\i18n\I18N'],
// 'mailer' => ['class' => 'yii\swiftmailer\Mailer'],
// 'urlManager' => ['class' => 'yii\web\UrlManager'],
// 'assetManager' => ['class' => 'yii\web\AssetManager'],
// 'security' => ['class' => 'yii\base\Security'],

//以下核心服务于website网站中
// 'request' => ['class' => 'yii\web\Request'],
// 'response' => ['class' => 'yii\web\Response'],
// 'session' => ['class' => 'yii\web\Session'],
// 'user' => ['class' => 'yii\web\User'],
// 'errorHandler' => ['class' => 'yii\web\ErrorHandler'],

//非核心必要组件（与核心组件不同的是以下组件基本都是工厂化接口）
// 'authManager' => ['class' => 'yii\rbac\DbManager'],
// 'db' => ['class' => 'yii\db\Connection'],
// 'mailer' => ['class' => 'yii\swiftmailer\Mailer'],
// 'cache' => ['class' => 'yii\caching\FileCache'],

// 小结一下，默认预定义别名一共有12个，其中路径别名11个，URL别名只有 @web 1个：
// @yii 表示Yii框架所在的目录，也是 yii\BaseYii 类文件所在的位置；
// @app 表示正在运行的应用的根目录，一般是 digpage.com/frontend ；
// @vendor 表示Composer第三方库所在目录，一般是 @app/vendor 或 @app/../vendor ；
// @bower 表示Bower第三方库所在目录，一般是 @vendor/bower ；
// @npm 表示NPM第三方库所在目录，一般是 @vendor/npm ；
// @runtime 表示正在运行的应用的运行时用于存放运行时文件的目录，一般是 @app/runtime ；
// @webroot 表示正在运行的应用的入口文件 index.php 所在的目录，一般是 @app/web；
// @web URL别名，表示当前应用的根URL，主要用于前端；
// @common 表示通用文件夹；
// @frontend 表示前台应用所在的文件夹；
// @backend 表示后台应用所在的文件夹；
// @console 表示命令行应用所在的文件夹；
// 其他使用Composer安装的Yii扩展注册的二级别名。