<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Conector".
 *
 * @property int $idConector ID
 * @property int $idEmpresa Empresa
 * @property int $idTipo_Conector Tipo de conector
 * @property string|null $Identificador Identificador
 *
 * @property Empresa $idEmpresa0
 * @property TipoConector $idTipoConector
 */
class Conector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Conector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEmpresa', 'idTipo_Conector'], 'required'],
            [['idEmpresa', 'idTipo_Conector'], 'integer'],
            [['Identificador'], 'string', 'max' => 45],
            [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
            [['idTipo_Conector'], 'exist', 'skipOnError' => true, 'targetClass' => TipoConector::className(), 'targetAttribute' => ['idTipo_Conector' => 'idTipo_Conector']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idConector' => 'Id Conector',
            'idEmpresa' => 'Id Empresa',
            'idTipo_Conector' => 'Id Tipo  Conector',
            'Identificador' => 'Identificador',
        ];
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
     * Gets query for [[IdTipoConector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoConector()
    {
        return $this->hasOne(TipoConector::className(), ['idTipo_Conector' => 'idTipo_Conector']);
    }
}
