<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    
    // public $id;
    // public $username;
    // public $full_name;
    // public $last_name;
    // public $email;
    // public $phone;
    // public $password;
    // public $authKey;
    // public $accessToken;
    // public $activate;

    public $idUsuario;
    public $idEmpresa;
    public $idMarca;
    public $idTipoUsuario;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $password;
    public $authKey;
    public $accessToken;
    public $activate;

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */
    public static function findIdentity($idUsuario)
    {
        
        $user = Usuario::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("idUsuario=:idUsuario", ["idUsuario" => $idUsuario])
                ->one();
        
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Usuario::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($Usuario as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

 
    
    // Busca la identidad del usuario a través del email 
    public static function findByEmail($email)
    {
        $usuario = Usuario::find()
                ->where("activate=:activate", ["activate" => 1])
                ->andWhere("email=:email", [":email" => $email])
                ->all();
        
        foreach ($usuario as $user) {
            if (strcasecmp($user->email, $email) === 0) {
                return new static($user);
            }
        }

        return null;
    }


    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->idUsuario;
        
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if (crypt($password, $this->password) == $this->password)
        {
        return $password === $password;
        }
    }
}