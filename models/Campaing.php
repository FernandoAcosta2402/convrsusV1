<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaing".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nombre
 * @property string $fecha_inicio
 * @property string $fecha_termino
 *
 * @property Adsets[] $adsets
 */
class Campaing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campaing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'nombre', 'fecha_inicio', 'fecha_termino'], 'required'],
            [['id_user'], 'integer'],
            [['fecha_inicio', 'fecha_termino'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nombre' => 'Nombre',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_termino' => 'Fecha Termino',
        ];
    }

    /**
     * Gets query for [[Adsets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdsets()
    {
        return $this->hasMany(Adsets::className(), ['id_campaing' => 'id']);
    }


}



