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
    <div class="d-block vh-85">
      <!-- botones flotantes -->
      <div class="fixed-top-info1 btn-flotante">
        <a class="btn-cert1 text-black " aria-current="page">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-6.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Encuentro con el experto</label></p>
        </a>
      </div>
      <div class="fixed-top-home btn-flotante">
        <button class="btn-info nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>
      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vIM" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
            <i class="fas fa-info btn-icon-info"></i>
        </a>
      </div>


      <div class="row m-0 align-items-center vh-72 justify-content-start col-12 txt-div-module">
        <!-- seccion izquierda -->

        <div id="sectL" class="col-lg-6 col-md-7 col-sm-11 col-11 mb-5">
          <div class="container-fluid">
            <div class="col-12 d-flex no-block align-items-left">
              <div id="txt-title" class="row">
                <div class="col-12 ps-sm-5 pe-lg-2 px-md-5 ps-lg-5 text-start">
                  <p class="lh-sm font-txt-subtitle fs-1 txt-white font-webinar"><?= $content_info[0]->content_info_title ?></p>
                </div>
                <div class="mt-3 col-12 text-center">
                <button class="btn-webinar btn nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page">
                  <a class="mb-0 me-2 txt-white" href="<?= $content_info[0]->content_info_element ?>" target="blank_">Ver charla<i class="txt-white px-1 fas fa-users"></i></a>
                  <label ></label>
                </button>
              </div>
              </div>
              
            </div>
          </div>
        </div>
        <!-- seccion Derecha -->
        <div id="sectR" class="col-lg-6 col-md-5 col-sm-12 col-12 mt-md-5">
          <div class="container px-0">
            <div class="row">
              <div class="col-lg-12 col-md-8 col-sm-4 col-5 mb-0 img-person">
                <img class="imagen border border-white border-img-person" width="170" heigth="45" src="<?= $content_info[0]->content_info_img ?>">
              </div>
              <div class="col-lg-8 col-md-12 col-sm-6 col-10 mb-0 p-3">
                <?= $content_info[0]->content_info_detail ?>
              </div>
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