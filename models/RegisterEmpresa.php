<?php

 namespace app\models;
 use yii;
 use yii\base\Model;
 use app\models\Usuario;

class FormRegister extends Model{
 
    // public $idUsuario;
    public $idEmpresa;
    public $nombre;
    public $direccion;
    public $direccion2;
    public $razonsocial;
    public $rfc;
    public $logo;
    //public $CONDICIONES = true;
    
    
    public function rules()
    {
        return [

          //[['idTipoUsuario','nombre', 'apellido', 'email', 'telefono','password', 'password_repeat'], 'required', 'message' => 'Campo requerido'],
        [['nombre', 'direccion', 'direccion2', 'razonsocial','rfc', 'logo'], 'required', 'message' => 'Campo requerido'],
         // ['nombre', 'apellido'], 'string', 'max' => 100],
         // ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['nombre', 'match', 'pattern' => "/^.{2,30}$/", 'message' => 'Mínimo 2 y máximo 30 caracteres'],
         
        //  ['email', 'email', 'message' => 'Formato no válido'],
        //   ['email', 'email_existe'],
        //   ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
        //   ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
          // [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
          // [['idMarca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['idMarca' => 'idMarca']],
          // [['idTipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['idTipoUsuario' => 'idTipoUsuario']],
         // ['rememberMe', 'boolean'],

          
            // [['username','full_name','last_name', 'email','phone', 'password', 'password_repeat'], 'required', 'message' => 'Campo requerido'],
            // ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            // ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            // ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            // ['email', 'email', 'message' => 'Formato no válido'],
            // ['email', 'email_existe'],
            // ['password', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 8 y máximo 16 caracteres'],
            // ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            // ['rememberMe', 'boolean'],
            
        ];
    }
    
    public function email_existe($attribute, $params)
    {
  
  //Buscar el email en la tabla
  $table = Usuario::find()->where("email=:email", [":email" => $this->email]);
  
  //Si el email existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El email seleccionado existe");
  }
    }
 
  //   public function username_existe($attribute, $params)
  
  //   {
  // //Buscar el correo en la tabla
  // $table = Users::find()->where("username=:username", [":username" => $this->username]);
  
  // //Si el username existe mostrar el error
  // if ($table->count() == 1)
  // {
  //               $this->addError($attribute, "El usuario seleccionado existe");
  // }
  //   }
 
}