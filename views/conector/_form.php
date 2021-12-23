<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Conector */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conector-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEmpresa')->textInput() ?>

    <?= $form->field($model, 'idTipo_Conector')->textInput() ?>

    <?= $form->field($model, 'Identificador')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
