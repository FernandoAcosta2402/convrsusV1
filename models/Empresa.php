<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Empresa".
 *
 * @property int $idEmpresa ID
 * @property string|null $nombre Nombre de la empresa
 * @property string|null $direccion Dirección
 * @property string|null $direccion2 Linea de Dirección 2
 * @property string|null $razonsocial Razón Social
 * @property string|null $rfc R.F.C.
 * @property string|null $logo Logotipo
 *
 * @property Conector[] $conectors
 * @property Marca[] $marcas
 * @property Usuario[] $usuarios
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'direccion2', 'razonsocial', 'rfc'], 'string', 'max' => 45],
            [['logo'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEmpresa' => 'Id Empresa',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'direccion2' => 'Direccion2',
            'razonsocial' => 'Razonsocial',
            'rfc' => 'Rfc',
            'logo' => 'Logo',
        ];
    }

    /**
     * Gets query for [[Conectors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConectors()
    {
        return $this->hasMany(Conector::className(), ['idEmpresa' => 'idEmpresa']);
    }

    /**
     * Gets query for [[Marcas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasMany(Marca::className(), ['idEmpresa' => 'idEmpresa']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idEmpresa' => 'idEmpresa']);
    }
}
