<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conector */

$this->title = $model->idConector;
$this->params['breadcrumbs'][] = ['label' => 'Conectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="conector-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idConector' => $model->idConector], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idConector' => $model->idConector], [
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
            'idConector',
            'idEmpresa',
            'idTipo_Conector',
            'Identificador',
        ],
    ]) ?>

</div>
