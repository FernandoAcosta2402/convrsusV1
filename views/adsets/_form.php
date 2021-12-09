<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Campaing;


/* @var $this yii\web\View */
/* @var $model app\models\Adsets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adsets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_campaing')->dropDownList(\yii\helpers\ArrayHelper::map(Campaing::find()->all(), 'id', 'nombre'), ['prompt' => 'Selecciona la campania']); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presupuesto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
