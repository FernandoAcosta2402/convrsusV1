<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ConfiguracionUsuario".
 *
 * @property int $idConfiguracionUsuario
 * @property int $idUsuario
 * @property string|null $template
 * @property string|null $lenguaje
 *
 * @property Usuario $idUsuario0
 */
class ConfiguracionUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ConfiguracionUsuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario'], 'required'],
            [['idUsuario'], 'integer'],
            [['template', 'lenguaje'], 'string', 'max' => 45],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idConfiguracionUsuario' => 'Id Configuracion Usuario',
            'idUsuario' => 'Id Usuario',
            'template' => 'Template',
            'lenguaje' => 'Lenguaje',
        ];
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
