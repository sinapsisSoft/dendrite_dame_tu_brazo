<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="Abbott, Dame tu brazo, curso virtual" />
  <meta name="description" content="Basado en decisiones conscientes, libres e informadas para mujeres en edad reproductiva" />
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
    <div class="mt-2 d-block vh-72">
      <!-- botones flotantes -->
      <div class="fixed-top-info1 btn-flotante">
        <a class="btn-cert1 text-black" aria-current="page">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-2.png"></i>
          <p class="d-none d-lg-block me-3 pe-3"><label class="mb-0">Video</label></p><label class="d-block d-lg-none mx-2 mb-0">1</label>
        </a>
      </div>

      <div class="fixed-top-home btn-flotante">
        <button class="btn-info nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>

      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vHx" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
            <i class="fas fa-info btn-icon-info"></i>
        </a>
      </div>

      <div class="row m-0 align-items-center vh-72 justify-content-start col-12 txt-div-module">
        <!-- seccion izquierda -->

        <div id="sectL" class="col-lg-6 col-md-7 col-sm-11 col-11">
          <div class="container-fluid">
            <div class="col-12 d-flex no-block align-items-left">
              <div id="txt-title" class="row">
                <div class="col-12 ps-sm-5 pe-lg-2 px-md-5 ps-lg-5 text-start line">
                  <?= $content_info[0]->content_info_title ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- seccion Derecha -->
        <div id="sectR" class="col-lg-6 col-md-4 col-sm-12 col-12">
          <div class="container-fluid">
            <div class="col-md-12 col-sm-10 ps-0 container-fluid d-flex justify-content-center">
              <video src="<?= $content_info[0]->content_info_element ?>" class="w-100" poster="<?= $content_info[0]->content_info_img ?>" controls controlslist="nodownload"></video>
            </div>            
          </div>
        </div>
      </div>
      <?= $footer ?>
    </div>
  </div>
  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/main/main.controller.js"></script>
  <script>
    document.getElementById("module_id").innerHTML = `Módulo <?= $module_id ?>`;
  </script>
</body>

</html>