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
      <img src="../assets/img/background/<?= $module_info[0]->content_info_img ?>" alt="" class="img-bg">
      <!-- botones flotantes -->
      <div class="fixed-top-out btn-flotante">
        <div class="btn-login text-black">
          <div class="btn-module">
            <p class="d-none d-lg-block pe-1 py-2"><label class="mb-0">Módulo <?= $module_id ?></label></p><label class="d-block d-lg-none my-2"><?= $module_id ?></label>
          </div>
        </div>
      </div>
      <div class="fixed-top-info btn-flotante">
        <a href="https://ior.ad/8vEu" target="_blank" class="mt-0 btn-info-ftr nav-link btn text-black w-md-25 w-50 w-lg-100">
          <i class="fas fa-info btn-icon-info"></i>
        </a>
      </div>
      <div class="fixed-top-home btn-flotante">
        <button class="btn-info nav-link btn  text-black w-md-25 w-50 w-lg-100" onclick="backDashboard();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>

      <div class="row m-0 d-flex align-items-center justify-content-start col-12 h-75 txt-div-module">
        <!-- seccion izquierda -->
        <div id="sectL" class="col-lg-7 col-md-8 col-sm-10 col-10">
          <div class="container-fluid">
            <div class="col-12 no-block align-items-left">
              <div id="txt-title" class="row">
                <div class="col-12 ps-sm-5 pe-lg-2 px-md-5 ps-lg-5 text-start">
                  <?= $module_info[0]->content_info_title ?>
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
  <script src="../controller/main/main.controller.js"></script>
  <script>
    var jsonActivity = <?= json_encode($activity) ?>;
    setActiveContent(<?= $module_id ?>);
  </script>
</body>

</html>