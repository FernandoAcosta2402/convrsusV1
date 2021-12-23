<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Campaign".
 *
 * @property int $idCampaign ID
 * @property int $idMarca
 * @property string $nombre Nombre
 * @property int|null $IDGoogleAccount
 * @property string|null $IDGoogle Google Campaign ID
 * @property string|null $IDFacebook Facebook Campaign ID
 * @property string $fechacreacion Fecha de Creación
 *
 * @property Marca $idMarca0
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Campaign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMarca', 'nombre'], 'required'],
            [['idMarca', 'IDGoogleAccount'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['nombre'], 'string', 'max' => 145],
            [['IDGoogle', 'IDFacebook'], 'string', 'max' => 45],
            [['idMarca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['idMarca' => 'idMarca']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCampaign' => 'Id Campaign',
            'idMarca' => 'Id Marca',
            'nombre' => 'Nombre',
            'IDGoogleAccount' => 'Id Google Account',
            'IDGoogle' => 'Id Google',
            'IDFacebook' => 'Id Facebook',
            'fechacreacion' => 'Fechacreacion',
        ];
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
}
