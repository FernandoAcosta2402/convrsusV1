<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\HtmlPurifier;


//use app\models\Users;
//use yii\widgets\DetailView;
//$model=Users::model()->findAllByAttributes(array('id'=>Yii::app()->users->getId()));


/* @var $this yii\web\View */
/* @var $model app\models\Campaing */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="campaing-form">

    <?php $form = ActiveForm::begin();?>

    
    <?= $form->field($model, 'id_user')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->id]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_termino')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
         ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
