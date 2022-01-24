<?php
// use yii\helpers\Html;
// use yii\widgets\ActiveForm;


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use app\models\TipoUsuario;


// $this->title = 'Sign Up';
// $this->params['breadcrumbs'][] = $this->title;

?>

<h3><?= $msg ?></h3>
<?php $form = ActiveForm::begin([
        // "method"=>"post",
        // 'enableClientValidation'=>true,
    
    // 'method' => 'post',
    // 'id' => 'formulario',
    // 'enableClientValidation' => false, //
    // 'enableAjaxValidation' => true,// validacion ajax para confirmar si existen usuario y email en la tabla users


    //    - -------------------------- INYECCION DE CODIGO ---------------------
    'id' => 'register-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>",
     'labelOptions' => ['class' => ''],
    ],
]);?>


<div class="row">

      <?= $form->field($model, "nombre" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->textInput(['class'=>'form-control'])//label('Nombre completo') ?>   
    
    <?= $form->field($model, "apellido" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->textInput(['class'=>'form-control'])//label('Apellidos') ?>   
    
    <?= $form->field($model, "email" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->textInput(['class'=>'form-control'])//->label('Correo') ?>   
   
    <?= $form->field($model, "telefono" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->textInput(['class'=>'form-control'])//input("text")->label('Telefono') ?>   
  
  <?= $form->field($model, "password" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->passwordInput(['class'=>'form-control'])//->label('Contraseña') ?>   
    <?= $form->field($model, "password_repeat" ,['options'=>['tag'=>false],'template' => "<div class=\"col-md-6\">
         <div class=\"form-group\">
           <label for=\"full-name\" class=\"form-label\">{label}</label>
           {input}
        </div>
     </div>"])->passwordInput(['class'=>'form-control'])//->label('Contraseña')//label('Repita la contraseña') ?>   
    <?= $form->field($model, 'CONDICIONES')->checkbox([
    'template'=>"<div class=\"col-lg-12 d-flex justify-content-center\">
                                    <div class=\"form-check mb-3\">
                                       {input}
                                       <label class=\"form-check-label\" for=\"FormRegister_CONDICIONES\">I agree with the terms of use</label>
                                    </div>
                                 </div>", 
                                 'inputOptions'=>['class'=>'form-check-input']]) ?>
</row>

<div class="d-flex justify-content-center">
    <?=Html::submitButton("Registrar",["class"=>"btn btn-primary",'name'=>'form-button'])?>
</div>

<p class="text-center my-3">or sign in with other accounts?</p>

<div class="d-flex justify-content-center">
                                 <ul class="list-group list-group-horizontal list-group-flush">
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="../assets/images/brands/fb.svg" alt="fb"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="../assets/images/brands/gm.svg" alt="gm"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="../assets/images/brands/im.svg" alt="im"></a>
                                    </li>
                                    <li class="list-group-item border-0 pb-0">
                                       <a href="#"><img src="../assets/images/brands/li.svg" alt="li"></a>
                                    </li>
                                 </ul>
                              </div>

                              <p class="mt-3 text-center">
                                 Already have an Account <a href="index.php?r=site%2Flogin#" class="text-underline">Sign In</a>
                              </p>

<?php $form->end()?>

