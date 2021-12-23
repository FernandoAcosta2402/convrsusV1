<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Conector */

$this->title = 'Create Conector';
$this->params['breadcrumbs'][] = ['label' => 'Conectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
