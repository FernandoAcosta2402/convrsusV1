<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campaing */

$this->title = Yii::t('app', 'Create Campaing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campaings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campaing-create">

    <h1><?= Html::encode($this->title);?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
    ])?>

</div>
