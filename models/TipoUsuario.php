<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoUsuario".
 *
 * @property int $idTipoUsuario ID
 * @property string $tipousuario Tipo de usuario
 * @property string|null $permisos Permisos
 *
 * @property Usuario[] $usuarios
 */
class TipoUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TipoUsuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipousuario'], 'required'],
            [['tipousuario'], 'string', 'max' => 45],
            [['permisos'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoUsuario' => 'Id Tipo Usuario',
            'tipousuario' => 'Tipousuario',
            'permisos' => 'Permisos',
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idTipoUsuario' => 'idTipoUsuario']);
    }
}
