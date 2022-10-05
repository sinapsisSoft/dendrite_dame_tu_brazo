<?php

use App\Models\Content_info;
?>
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
    <div class="mt-2 bg-white d-block vh-72">
      <!-- botones flotantes -->
      <div class="fixed-top-info1 btn-flotante">
        <a id="info1" class="btn-info1 btn btn-light text-black " aria-current="page" onclick="setInfographic(this.id)">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-1.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Infografía 1</label></p><label class="d-block d-lg-none mx-2 mb-0">1</label>
        </a>
      </div>
      <div class="fixed-top-info2 btn-flotante">
        <a id="info2" class="btn-info1 btn btn-light text-black " aria-current="page" onclick="setInfographic(this.id)">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-1.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Infografía 2</label></p><label class="d-block d-lg-none mx-2 mb-0">2</label>
        </a>
      </div>
      <div class="fixed-top-info3 btn-flotante">
        <a id="info3" class="btn-info1 btn btn-light text-black " aria-current="page" onclick="setInfographic(this.id)">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-1.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Infografía 3</label></p><label class="d-block d-lg-none mx-2 mb-0">3</label>
        </a>
      </div>
      <div class="info-btn-home btn-flotante">
        <button class="btn-info nav-link btn btn-light text-black" aria-current="page" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>
      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vFn" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
            <i class="fas fa-info btn-icon-info"></i>
        </a>
      </div>
      <div class="row m-0 align-items-center vh-72 justify-content-start col-12 txt-div-module">
        <!-- seccion izquierda -->        
        <div id="sectL" class="col-lg-6 col-md-7 col-sm-11 col-11 heigth-fit">
          <div class="container">
            <div class="col-12 no-block align-items-left">
              <div id="txt-title" class="row">
                <div id="title-info" class="col-12 ps-sm-5 pe-lg-2 px-md-5 ps-lg-5 text-start line">
                  <?= $content_info[0]->content_info_title ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- seccion Derecha -->
        <div id="sectR" class="col-lg-5 col-md-4 col-sm-12 col-12 ">
          <div class="container">
            <div class="col-12 ps-0 text-center d-block d-md-none vh-info-div">
              <a id="pdf-mobile" href="<?= $content_info[0]->content_info_element ?>" download target="_blank" class="btn-pdf nav-link btn btn-light text-black">
                <i class="fas fa-file-pdf px-2"><label>Ver PDF</label></i>
              </a>  
            </div>
            <div class="table-responsive d-none d-md-block table-pdf w-100" tabindex="0">
              <a type="button" data-bs-toggle="modal" data-bs-target="#infographicModal">
                <img id="img-info" src="<?= $content_info[0]->content_info_img ?>" alt="">
              </a>
            </div>            
          </div>
        </div>
      </div>
      <?= $footer ?>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="infographicModal" tabindex="-1" aria-labelledby="infographicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div id="pdf-info" class="modal-body">
          <object data="<?= $content_info[0]->content_info_element ?>#toolbar=0" width="100%" height="500px"></object>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>        
        </div>
      </div>
    </div>
  </div>
  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/main/main.controller.js"></script>
  <script>
    var jsonInfographic = <?= json_encode($content_info) ?>;
    document.getElementById("module_id").innerHTML = `Módulo <?= $module_id ?>`;
  </script>
</body>
</html>