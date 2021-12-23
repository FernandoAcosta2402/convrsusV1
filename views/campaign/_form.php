<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Campaign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMarca')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDGoogleAccount')->textInput() ?>

    <?= $form->field($model, 'IDGoogle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IDFacebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechacreacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
