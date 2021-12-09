<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Adsets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adsets-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a(Yii::t('app', 'Create Adsets'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_campaing',
            'nombre',
            'presupuesto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
