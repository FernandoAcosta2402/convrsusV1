<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
//AGREGAR ESTA LINEA
use app\utils\GoogleApi;
class GoogleActionsController extends \yii\web\Controller
{
    public function actionGetrefreshtoken()
    {
        return "<pre>".print_r(GoogleApi::getRefreshTocken($_GET["code"]), true)."</pre>";
        /**
         * Array
         *  (
         *      [access_token] => ya29.a0ARrdaM8stsNeEhOnDkZNS1gwk-Hy1Z0ajW9ds36wKBdCGSVc0zweAaVtsnK_TwpGh3i__zTERoNmmV7IOhwdH82LDJVjrUShTbTVGHwRUAYlJgSSFAYuO59atk8jNsFKo62ZWWZnqnycY-jmxDak42FxC8op
         *      [expires_in] => 3599
         *      [refresh_token] => 1//0ftqF8VritIBQCgYIARAAGA8SNwF-L9IrT_7MsGTN_Qz6tuAwMLSW1aVmX3veD4bvSmgcwr9c-9hRI0bguMFCrx6hToqfTLD14jY
         *      [scope] => https://www.googleapis.com/auth/adwords
         *      [token_type] => Bearer
         *  )
         */
    }

    public function actionLogin()
    {
        return GoogleApi::login();
    }

    public function actionSelectaccount()
    {
        return $this->render('selectaccount');
    }

}
