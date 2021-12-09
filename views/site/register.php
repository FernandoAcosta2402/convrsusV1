<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h3><?= $msg ?></h3>

<h1>Registro de nuevos usuarios</h1>
<?php $form = ActiveForm::begin([
        // "method"=>"post",
        // 'enableClientValidation'=>true,
    
    'method' => 'post',
    'id' => 'formulario',
    'enableClientValidation' => false, //
    'enableAjaxValidation' => true,// validacion ajax para confirmar si existen usuario y email en la tabla users
]);
?>
<div class="form-group">
 <?= $form->field($model, "username")->label('Nombre de usuario') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "full_name")->label('Nombre completo') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "last_name")->label('Apellidos') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "email")->input("email")->label('Correo') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "phone")->input("text")->label('Telefono') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password")->input("password")->label('Contraseña') ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "password_repeat")->input("password")->label('Repita la contraseña') ?>   
</div>

<?=Html::submitButton("Registrar",["class"=>"btn btn-primary"])?>
<?php $form->end()?>