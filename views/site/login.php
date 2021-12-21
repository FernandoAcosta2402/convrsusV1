<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'template' => "<div class=\"col-lg-12\">
            <div class=\"form-group\">
               <label for=\"email\" class=\"form-label\">{label}</label>
               {input}
            </div>
         </div>",
            'labelOptions' => ['class' => ''],

            
        ],
    ]); ?>

<div class="row">
        <?= $form->field($model, 'email')->textInput(['inputOptions'=>['class'=>'form-control', 'placeholder'=>'E-Mail']]) ?>

        <?= $form->field($model, 'password')->passwordInput(['inputOptions'=>['class'=>'form-control', 'placeholder'=>'E-Mail']]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"form-check mb-3\">
            {input}
            <label class=\"form-check-label\" for=\"LoginForm_rememberMe\">Remember Me</label>
         </div>",
        'inputOptions'=>['class'=>'form-check-input']]) ?>
</row>
<div class="d-flex justify-content-center">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
        <script>

            
        function onSignIn(googleUser) {

            // Useful data for your client-side scripts:
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());

            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
            console.log("ID Token: " + id_token);
        }
        </script>
        
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
                                 Don’t have an account? <a href='index.php?r=site%2Fregister#' class="text-underline">Click here to sign up.</a>
                              </p>

    <?php ActiveForm::end(); ?>
</div>
