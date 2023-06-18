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
    <div class="mt-2 bg-white d-block vh-72">
      <!-- botones flotantes -->
      <div class="fixed-top-info1 btn-flotante">
        <a class="btn-info1  text-black " aria-current="page">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-3.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Podcast</label></p>
        </a>
      </div>
      <div class="fixed-top-home btn-flotante">
        <button class="btn-info nav-link btn  text-black w-md-25 w-50 w-lg-100" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>

      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vHD" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
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
        <div id="sectL" class="col-lg-6 col-md-4 col-sm-12 col-12">
          <div class="col-12 d-flex no-block align-items-left">
            <div class="container" style="display: flex; align-items: flex-end;">
              <div class="row">
                <div class="container-sm" style="display: flex; align-items: flex-start; justify-content: flex-end;">
                  <div class="player">
                    <img src="<?= $content_info[0]->content_info_img ?>" alt="Album Cover" class="player__img" loading="lazy" />
                    <audio id="podcast" src="<?= $content_info[0]->content_info_element ?>"></audio>                    
                    <div class="middle player__controls pb-2 note-toolbar">
                      <button id="play" class="player__btn player__btn--medium blue play" onclick="justplay()"><i class="fa fa-play" aria-hidden="true"></i></button>
                      <button id="replay" class="player__btn player__btn--medium blue play" onclick="reload_track()"><i class="fas fa-undo-alt" aria-hidden="true"></i></button>
                    </div>
                    <div class="duration pb-4 note-toolbar">
                      <input type="range" min="0" max="100" value="0" id="duration_slider" onchange="change_duration()">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?= $footer ?>
  </div>
  <!-- All Jquery -->
  <?= $script ?>
  <script src="../assets/js/podcast.js"></script>
  <script src="../controller/main/main.controller.js"></script>
  <script>
    document.getElementById("module_id").innerHTML = `Módulo <?= $module_id ?>`;
  </script>

</body>

</html>