<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Campaings');

//$this->id = Yii::t('app', 'Campaings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a(Yii::t('app', 'Create Campaing'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_user',
            'nombre',
            'fecha_inicio',
            'fecha_termino',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
