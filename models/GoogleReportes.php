<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GoogleReportes".
 *
 * @property int $idGoogleReportes
 * @property string|null $Nombre
 *
 * @property GoogleData[] $googleDatas
 */
class GoogleReportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'GoogleReportes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGoogleReportes' => 'Id Google Reportes',
            'Nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[GoogleDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoogleDatas()
    {
        return $this->hasMany(GoogleData::className(), ['idGoogleReportes' => 'idGoogleReportes']);
    }
}
