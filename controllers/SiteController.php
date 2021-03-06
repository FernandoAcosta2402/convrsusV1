<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\LoginForm;
use app\models\FormRegister;
use app\models\Usuario;
use utils\GoogleApi\GoogleApi;
//use utils\GoogleApi\GoogleApi as GoogleApiGoogleApi;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login','error'],
                        'allow' => true,
                    ],

                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                     
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    // ------------------------------- GOOGLE --------------------------------


    // public function actionGoogle()

    //     {
    //         return GoogleApi::login();
    //     }
    
    //   public function actionRedirect()
    //     {
    //         return "<pre>".print_r($_GET, true)."</pre>";
    //     }

    
    // public function actionGoogle(){

    //     $oauth2 = new OAuth2(
    //         [
    //             'clientId' => $clientId,
    //             'clientSecret' => $clientSecret,
    //             'authorizationUri' => self::AUTHORIZATION_URI,
    //             'redirectUri' => $redirectUrl . self::OAUTH2_CALLBACK_PATH,
    //             'tokenCredentialUri' => CredentialsLoader::TOKEN_CREDENTIAL_URI,
    //             'scope' => self::SCOPE,
    //             // Create a 'state' token to prevent request forgery. See
    //             // https://developers.google.com/identity/protocols/OpenIDConnect#createxsrftoken
    //             // for details.
    //             'state' => sha1(openssl_random_pseudo_bytes(1024))
    //         ]
    //     );
    // }


  
//--------------------------------------- REGISTRO CON CONFIRMACION DE CORREO ---------------------------------

private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm()
 {
    $table = new Usuario;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los par??metros get
        $idUser = Html::encode($_GET["idUser"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $idUser)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("idUser=:idUser", [":idUser" => $idUser])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = Usuario::findOne($idUser);
                $activar->activate = 1;

                if ($activar->update())
                {
                    echo "Registro llevado a cabo correctamente, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                    echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
        else //Si id no es un n??mero entero redireccionamos a login
        {
            return $this->redirect(["site/login"]);
        }
    }
 }
 
 public function actionRegister()
 {
  $this->layout = "signup";
  //Creamos la instancia con el model de validaci??n
  $model = new FormRegister;
   
  //Mostrar?? un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validaci??n mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
  //Validaci??n cuando el formulario es enviado v??a post
  if ($model->load(Yii::$app->request->post()))
  {
   if($model->validate())
   {
    //Preparamos la consulta para guardar el usuario
    $table = new Usuario;
   // $table->idTipoUsuario = $model->idTipoUsuario;
    $table->nombre = $model->nombre;
    $table->apellido = $model->apellido;
    $table->email = $model->email;
    $table->telefono=$model->telefono;
    //Encriptamos el password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);

    
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesi??n, esta misma
    //clave ser?? utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso ??nico para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
    if ($table->insert())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $idUsuario = urlencode($user->idUsuario);
     $authKey = urlencode($user->authKey);
      
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
     $body .= "<a href='http://yii.local/index.php?r=site/confirm?id=".$idUsuario."&authKey=".$authKey."'>Confirmar</a>";
      
     //Enviamos el correo
    //  Yii::$app->mailer->compose()
    //  ->setTo($user->email)
    //  ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
    //  ->setSubject($subject)
    //  ->setHtmlBody($body)
    //  ->send();
     
     //$model-> = null;
    // $model->idTipoUsuario = null;
     $model->nombre = null;
     $model->apellido = null;
     $model->email = null;
     $model->telefono = null;
     $model->password = null;
     $model->password_repeat = null;
     
     $msg = "Usuario registrado con exito";
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
     
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }


 


//---------------------------------------FIN DE RESGITRO--------------------------------


 public function actionRegisterEmpresa()
 {
  $this->layout = "registerEmpresa";
  //Creamos la instancia con el model de validaci??n
  $model = new FormRegister;
   
  //Mostrar?? un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validaci??n mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
  //Validaci??n cuando el formulario es enviado v??a post
  if ($model->load(Yii::$app->request->post()))
  {
   if($model->validate())
   {
    //Preparamos la consulta para guardar el usuario
    $table = new Usuario;
   // $table->idTipoUsuario = $model->idTipoUsuario;
    $table->nombre = $model->nombre;
    $table->apellido = $model->apellido;
    $table->email = $model->email;
    $table->telefono=$model->telefono;
    //Encriptamos el password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);

    
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesi??n, esta misma
    //clave ser?? utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso ??nico para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
    if ($table->insert())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $idUsuario = urlencode($user->idUsuario);
     $authKey = urlencode($user->authKey);
      
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
     $body .= "<a href='http://yii.local/index.php?r=site/confirm?id=".$idUsuario."&authKey=".$authKey."'>Confirmar</a>";
      
     //Enviamos el correo
    //  Yii::$app->mailer->compose()
    //  ->setTo($user->email)
    //  ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
    //  ->setSubject($subject)
    //  ->setHtmlBody($body)
    //  ->send();
     
     //$model-> = null;
    // $model->idTipoUsuario = null;
     $model->nombre = null;
     $model->apellido = null;
     $model->email = null;
     $model->telefono = null;
     $model->password = null;
     $model->password_repeat = null;
     
     $msg = "Usuario registrado con exito";
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
     
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }


//-----------------------------------------REGISTRO DE EMPRESA -----------------------------------





//--------------------------------------------------------------------------------


//-------------------------------------------CONTROLADOR LOGIN
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        $this->layout = "login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        
//-----------------------------------------------
    

        return $this->render('login', [
                    'model' => $model
        ]);
    }



    //-----------------------------CONTROLADOR LOGOUT----------------------
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */




     //-----------------------------------------------CONTROLADOR PAGINA ABOUT 

    /**
     * Displays about page.
     *
     * @return string
     */
    // public function actionAbout() {
    //     return $this->render('about');
    // }

}