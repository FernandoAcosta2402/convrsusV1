<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--acceso a google control de login  -->
  <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
        content="1087593195129-1r0g9i5pvra21i6jt8uf5mvu60439jdp.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  <!-- Fin de acceso a google -->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?=Url::base()?>/../assets/images/favicon.ico" />
  <!-- Library / Plugin Css Build -->
  <link rel="stylesheet" href="<?=Url::base()?>/../assets/css/core/libs.min.css" />
  <!-- Hope Ui Design System Css -->
  <link rel="stylesheet" href="<?=Url::base()?>/../assets/css/hope-ui.min.css?v=1.1.0" />
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?=Url::base()?>/../assets/css/custom.min.css?v=1.1.0" />

  <!-- Dark Css -->
  <link rel="stylesheet" href="<?=Url::base()?>/../assets/css/dark.min.css" />

  <!-- RTL Css -->
  <link rel="stylesheet" href="<?=Url::base()?>/../assets/css/rtl.min.css" />
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
  <?php $this->beginBody() ?>

  <header>
    <?php
  

    ?>
    <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
      <div class="container-fluid navbar-inner">
        <button data-trigger="navbar_main" class="d-xl-none btn btn-primary rounded-pill p-1 pt-0" type="button">
          <svg width="20px" height="20px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
          </svg>
        </button>
        <div class="col-lg-2 col-lg-3 navbar-brand">
          <a href="./main.php" class="d-flex">
            <!--Logo start-->
            <svg width="30" class="" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
              <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
              <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
              <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
            </svg>
            <!--logo End-->
            <h4 class="logo-title">Hope UI</h4>
          </a>
        </div>
        <!-- Horizontal Menu Start -->
        <nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
          <div class="container-fluid">
            <div class="offcanvas-header px-0">
              <div class="navbar-brand ms-0">
                <!--Logo start-->
                <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                  <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                  <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                  <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                </svg>
                <!--logo End-->
                <h4 class="logo-title">Hope UI</h4>
              </div>
              <button class="btn-close float-end"></button>
            </div>


            <?php
      NavBar::begin([
        // 'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
          'class' => 'class="nav navbar navbar-expand-xl navbar-ligth iq-navbar"',
        ],
      ]);
      echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
          ['label' => 'Home', 'url' => ['/site/index']],
          ['label' => 'About', 'url' => ['/site/about']],
          

          //Ocultando vista de campañas si no esta logueado
          (!Yii::$app->user->isGuest)?(
            ['label' => 'Campaing', 'url' => ['/campaing/index']])
            :(""),
          (!Yii::$app->user->isGuest)?(
            ['label' => 'Asets', 'url' => ['/adsets/index']])
            :(""),
          //------------------------
        
            ['label' => 'Registro', 'url' => ['/site/register']],
          Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
              'Logout (' . Yii::$app->user->identity->username . ')',
              ['class' => 'btn btn-link logout bg-info']
            )
            . Html::endForm()
            . '</li>')
        ],
      ]);
      NavBar::end();

      ?>
          </div> <!-- container-fluid.// -->
        </nav>
  </header>

  <main role="main" class="flex-shrink-0 flex-shrink-0 main-content">
  <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      ]) ?></ol>
            <?= Alert::widget() ?>
            <!--Tener en cuenta para el manejo de las vistas para el dashboard  -->
           <ol class="container container-fluid">
           <?= $content ?>
           
           </ol>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
        </nav>
  </main>

  <footer class="footer mt-auto py-3 text-muted">
    <div class="footer-body">
      <ul class="left-panel list-inline mb-0 p-0">
        <li class="list-inline-item"><a href="../dashboard/extra/privacy-policy.html">Privacy Policy</a>
        </li>
        <li class="list-inline-item"><a href="../dashboard/extra/terms-of-service.html">Terms of Use</a>
        </li>
      </ul>
      <div class="right-panel">
        ©<script>
          document.write(new Date().getFullYear())
        </script> Hope UI, Made with
        <span class="text-gray">
          <svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
          </svg>
        </span> by <a href="https://iqonic.design/">IQONIC Design</a>.
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>