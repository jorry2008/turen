<?php

namespace frontend\modules\site\controllers;

class MessageController extends \frontend\components\Controller
{
	/**
	 * 联系我们
	 */
    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * 给我留言
     */
    public function actionComment()
    {
    	return $this->render('comment');
    }
}
