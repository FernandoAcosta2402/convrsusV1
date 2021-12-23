<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Usuario".
 *
 * @property int $idUsuario ID
 * @property int|null $idEmpresa Empresa
 * @property int|null $idMarca Marca
 * @property int $idTipoUsuario Tipo de Usuario
 * @property string|null $nombre Nombre(s)
 * @property string|null $apellido Apellido(s)
 * @property string|null $email E-Mail
 * @property int|null $telefono Número Telefónico
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $activate
 *
 * @property ConfiguracionUsuario[] $configuracionUsuarios
 * @property Empresa $idEmpresa0
 * @property Marca $idMarca0
 * @property TipoUsuario $idTipoUsuario0
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEmpresa', 'idMarca', 'idTipoUsuario', 'telefono', 'activate'], 'integer'],
            [['password', 'authKey', 'accessToken'], 'required'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['password'], 'string', 'max' => 32],
            [['authKey', 'accessToken'], 'string', 'max' => 250],
            [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
            [['idMarca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['idMarca' => 'idMarca']],
            [['idTipoUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['idTipoUsuario' => 'idTipoUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'idEmpresa' => 'Id Empresa',
            'idMarca' => 'Id Marca',
            'idTipoUsuario' => 'Id Tipo Usuario',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'activate' => 'Activate',
        ];
    }

    /**
     * Gets query for [[ConfiguracionUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfiguracionUsuarios()
    {
        return $this->hasMany(ConfiguracionUsuario::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * Gets query for [[IdEmpresa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'idEmpresa']);
    }

    /**
     * Gets query for [[IdMarca0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarca0()
    {
        return $this->hasOne(Marca::className(), ['idMarca' => 'idMarca']);
    }

    /**
     * Gets query for [[IdTipoUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoUsuario0()
    {
        return $this->hasOne(TipoUsuario::className(), ['idTipoUsuario' => 'idTipoUsuario']);
    }
}
