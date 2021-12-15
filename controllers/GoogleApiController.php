<?php

namespace app\controllers;

class GoogleApiController extends \yii\web\Controller
{
    public function actionGetRefreshToken()
    {
        return $this->render('get-refresh-token');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionSelectAccount()
    {
        return $this->render('select-account');
    }

}
