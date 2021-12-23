<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Campaign */

$this->title = $model->idCampaign;
$this->params['breadcrumbs'][] = ['label' => 'Campaigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="campaign-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idCampaign' => $model->idCampaign], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idCampaign' => $model->idCampaign], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCampaign',
            'idMarca',
            'nombre',
            'IDGoogleAccount',
            'IDGoogle',
            'IDFacebook',
            'fechacreacion',
        ],
    ]) ?>

</div>
