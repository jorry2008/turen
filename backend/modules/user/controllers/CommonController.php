<?php
namespace backend\modules\user\controllers;

use Yii;
use common\models\user\LoginForm;

// use common\models\user\PasswordResetRequestForm;
// use common\models\user\ResetPasswordForm;
// use common\models\user\SignupForm;
// use common\models\user\ContactForm;
// use yii\base\InvalidParamException;
// use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class CommonController extends \backend\components\Controller
{
    /**
     * 用于自动化处理权限
     * @return multitype:string
     */
    public static function getRbac()
    {
        return ['error', 'captcha'];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'width' => 60,
                'height' => 34,
                'minLength' => 4,
                'maxLength' => 4,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }
    
    /**
     * 默认首页
     * @return string
     */
    public function actionDefault()
    {
        return $this->render('default');
    }
    
    /**
     * 关于我们
     */
    public function actionAbout()
    {
    	return $this->render('about');
    }

    /**
     * 后台登录
     * @return \yii\web\Response|string
     */
    public function actionLogin()
    {
        Yii::$app->layout = 'login_main';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    /**
     * 后台登出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /*
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
                'model' => $model
            ]);
        }
    }
    */

    /*
     * 关闭后台注册和密码找回
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        
        return $this->render('requestPasswordResetToken', [
            'model' => $model
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            
            return $this->goHome();
        }
        
        return $this->render('resetPassword', [
            'model' => $model
        ]);
    }
    */
}
