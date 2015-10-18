<?php

namespace frontend\modules\site\controllers;

class JoinController extends \frontend\components\Controller
{
	public function actionList()
	{
		return $this->render('list');
	}
	
    public function actionView()
    {
        return $this->render('view');
    }
}
