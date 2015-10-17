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
    	$columns = Column::find()->where(['type'=>Column::CMS_TYPE_LIST])->orderBy('order ASC')->all();
    	return $this->render('index', [
    		'columns' => $columns,//推荐栏目到首页
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
