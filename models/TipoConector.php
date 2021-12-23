<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tipo_Conector".
 *
 * @property int $idTipo_Conector ID
 * @property string $plataforma Plataforma
 * @property string|null $controlador Controllador
 *
 * @property Conector[] $conectors
 */
class TipoConector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tipo_Conector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plataforma'], 'required'],
            [['plataforma'], 'string', 'max' => 100],
            [['controlador'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipo_Conector' => 'Id Tipo  Conector',
            'plataforma' => 'Plataforma',
            'controlador' => 'Controlador',
        ];
    }

    /**
     * Gets query for [[Conectors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConectors()
    {
        return $this->hasMany(Conector::className(), ['idTipo_Conector' => 'idTipo_Conector']);
    }
}
