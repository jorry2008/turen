<?php
namespace frontend\modules\site\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
// use yii\filters\VerbFilter;
// use yii\filters\AccessControl;

use common\models\account\LoginForm;
use common\models\account\PasswordResetRequestForm;
use common\models\account\ResetPasswordForm;
use common\models\account\SignupForm;
use common\models\account\ContactForm;
use common\models\cms\Column;
use common\models\cms\Page;
use common\models\cms\Ad;
use common\models\cms\AdType;
use common\models\cms\Img;

/**
 * Site controller
 */
class HomeController extends \frontend\components\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'jorry' : null,
            ],
        ];
    }

    public function actionIndex()
    {
    	$columns = Column::find()->where(['type'=>Column::CMS_TYPE_LIST])->orderBy('order ASC')->active()->all();
    	$about = Column::find()->where(['short_code'=>'about-brief'])->active()->one();
    	$mainAdType = AdType::find()->with('ad')->where(['short_code'=>'home_main'])->active()->one();//in查询
    	$adBottom = Ad::find()->where(['short_code'=>'home_bottom'])->active()->one();
    	$scenes = Img::find()->select(Img::tableName().'.*')->where(['like', Img::tableName().'.flag', 'c'])->joinWith([
			'column' => function ($query) {
				$query->where([Column::tableName().'.short_code'=>'xianchang']);
			}
		])->active()->all();//搬家现场推荐
    	
//     	$links = '';
// 		$subNav = '';
    	
    	return $this->render('index', [
    		'columns' => $columns,//推荐栏目到首页
    		'about' => $about,
    		'mainAdType' => $mainAdType,
    		'adBottom' => $adBottom,
    		'scenes' => $scenes,
//     		'links' => $links,
//     		'subNav' => $subNav,
    	]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
