<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GoogleData".
 *
 * @property string $idGoogleData
 * @property int $idGoogleReportes
 * @property int|null $idcampaign
 * @property int|null $idadset
 * @property string|null $fecha
 * @property string|null $campaignname
 * @property string|null $adsetname
 * @property float|null $coste
 * @property int|null $clicks
 * @property int|null $impresiones
 * @property float|null $ctr
 * @property float|null $cpc
 * @property float|null $cpm
 * @property int|null $conversiones
 * @property float|null $cpa
 * @property string|null $keyword
 * @property string|null $searchterm
 *
 * @property GoogleReportes $idGoogleReportes0
 */
class GoogleData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'GoogleData';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idGoogleData', 'idGoogleReportes'], 'required'],
            [['idGoogleReportes', 'idcampaign', 'idadset', 'clicks', 'impresiones', 'conversiones'], 'integer'],
            [['fecha'], 'safe'],
            [['coste', 'ctr', 'cpc', 'cpm', 'cpa'], 'number'],
            [['idGoogleData'], 'string', 'max' => 40],
            [['campaignname', 'adsetname'], 'string', 'max' => 150],
            [['keyword', 'searchterm'], 'string', 'max' => 100],
            [['idGoogleData'], 'unique'],
            [['idGoogleReportes'], 'exist', 'skipOnError' => true, 'targetClass' => GoogleReportes::className(), 'targetAttribute' => ['idGoogleReportes' => 'idGoogleReportes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGoogleData' => 'Id Google Data',
            'idGoogleReportes' => 'Id Google Reportes',
            'idcampaign' => 'Idcampaign',
            'idadset' => 'Idadset',
            'fecha' => 'Fecha',
            'campaignname' => 'Campaignname',
            'adsetname' => 'Adsetname',
            'coste' => 'Coste',
            'clicks' => 'Clicks',
            'impresiones' => 'Impresiones',
            'ctr' => 'Ctr',
            'cpc' => 'Cpc',
            'cpm' => 'Cpm',
            'conversiones' => 'Conversiones',
            'cpa' => 'Cpa',
            'keyword' => 'Keyword',
            'searchterm' => 'Searchterm',
        ];
    }

    /**
     * Gets query for [[IdGoogleReportes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdGoogleReportes0()
    {
        return $this->hasOne(GoogleReportes::className(), ['idGoogleReportes' => 'idGoogleReportes']);
    }
}
