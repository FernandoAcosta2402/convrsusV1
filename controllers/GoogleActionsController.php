<?php

namespace app\controllers;

use yii\web\Controller;
use app\utils\GoogleApi;
use Yii;

class GoogleActionsController extends \yii\web\Controller
{
    public function actionGetrefreshtoken()
    {
        return "<pre>".print_r(GoogleApi::getRefreshTocken($_GET["code"]), true)."</pre>";
        /*
         Array
        (
            [access_token] => ya29.a0ARrdaM_XMLX4-3_iMTIUhB34ZliyEPrGQP8uCL2OmLN1FsX0rwjph9MKnTnqZwfr7AItaiYfVCqutOCTnZpRLobMP_iu9Ne2XUq5cchFL6Q0JLukBh64Yrk8kStHeOQ4162zG4bxnsvCvwbSD-ysyaYZAaC6
            [expires_in] => 3599
            [refresh_token] => 1//0fK13KtZtl2AoCgYIARAAGA8SNwF-L9IrPBU0dp-2IuuPfmgQX69GD4cEldEtolcYt0Jc5Gb_ko4aSm-aiGq1N9zXkioVxXwxJRQ
            [scope] => https://www.googleapis.com/auth/adwords
            [token_type] => Bearer
        )
         */
    }

    public function actionLogin()
    {
        return GoogleApi::login();
    }

    public function actionSelectaccount()
    {
        $google = new GoogleApi();

        return "<pre>".$google->getAccountHierachi()."<pre>";
        //return $this->render('selectaccount');
    }

}
