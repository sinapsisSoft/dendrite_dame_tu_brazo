<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
  <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
  <meta name="robots" content="noindex,nofollow" />
  <title><?= $title ?></title>
  <?= $css ?>
</head>

<body class="colorbg">
  <!-- Preloader - style you can find in spinners.css -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- Main wrapper - style you can find in pages.scss -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full" class="inx-vh-100">
    <!-- Topbar header - style you can find in pages.scss -->
    <?= $header ?>
    <div class="pt-2 d-block vh-85">
      <img src="../assets/img/background/bg-1.jpg" alt="" class="img-bg">
      <!-- botones flotantes -->
      <div class="fixed-top-out btn-flotante">
        <button id="logOut" class="btn-login btn btn-light text-black " aria-current="page" onclick="logOut();"><i class="mdi mdi-account-circle btn-icon"></i>
          <p class="d-none d-md-block pe-3">Log Out</p>
        </button>
      </div>
      <!-- <div class="fixed-top-cert btn-flotante">
        <button class="btn-cert btn btn-light text-black " aria-current="page" href="#"><i class="mdi mdi-book-variant btn-icon"></i>
          <p class="d-none d-md-block pe-3">Certificado</p>
        </button>
      </div> -->
      <div class="row justify-content-start txt-div">
        <!-- seccion izquierda -->
        <div id="sectL" class="col-lg-7 col-md-10 col-sm-11 col-12 py-3">
          <div class="container-fluid">
            <div class="col-12 d-flex no-block align-items-left">
              <div id="txt-title" class="row">
                <div class="col-12 px-5 pe-md-4 pe-lg-5 py-2 text-start">
                  <div class="pb-4 pb-md-2">
                    <p class="fw-normal fs-3 txt-color-2">CURSO VIRTUAL</p>
                  </div>
                  <p class="lh-sm font-txt-subtitle"><span class="fw-bolder txt-color-2">DAME TU BRAZO</span><br><span class="txt-color-1">POR EL FUTURO</span></p>
                  <p class="fw-normal fs-3 txt-color-2">Basado en decisiones conscientes, libres e informadas para mujeres en edad reproductiva</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?= $footer ?>
      </div>
    </div>
  </div>
  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/authentication/login.controller.js"></script>
  <script src="../controller/main/main.controller.js"></script>
  <script>
    var jsonActivity = <?= json_encode($activity) ?>;
   setActiveModules();
  </script>
</body>

</html>