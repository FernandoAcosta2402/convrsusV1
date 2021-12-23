<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Marca".
 *
 * @property int $idMarca ID
 * @property int $idEmpresa Empresa
 * @property string|null $nombre Nombre
 * @property string|null $logo Logotipo
 *
 * @property Campaign[] $campaigns
 * @property Empresa $idEmpresa0
 * @property Usuario[] $usuarios
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Marca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEmpresa'], 'required'],
            [['idEmpresa'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['logo'], 'string', 'max' => 250],
            [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMarca' => 'Id Marca',
            'idEmpresa' => 'Id Empresa',
            'nombre' => 'Nombre',
            'logo' => 'Logo',
        ];
    }

    /**
     * Gets query for [[Campaigns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['idMarca' => 'idMarca']);
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
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idMarca' => 'idMarca']);
    }
}
