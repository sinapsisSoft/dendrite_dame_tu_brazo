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
    <div class="row align-items-center vh-85">
      <!-- seccion izquierda -->
      <div id="sectL" class="col-lg-6 col-sm-12 d-flex py-4">
        <div class="container-fluid d-flex justify-content-center">
          <div class="col-12 d-flex justify-content-center d-flex no-block align-items-left">
            <div id="txt-title" class="row">
              <div class="col-12 px-5 pe-md-4 pe-lg-5 pt-2 text-start">
                <!-- <div class="pb-4 pb-md-2">
                  <p class="fw-normal fs-3 text-white">CURSO VIRTUAL</p>
                </div> -->
                <p class="text-white fs-4 text">CURSO VIRTUAL</p>
                <p class="text-white fs-1 text fw-bolder">DAME TU BRAZO</p>
                <p class="text-white fs-2 text fw-bolder">POR EL FUTURO</p>
                <p class="text-white fs-3 text">Basado en decisiones conscientes, libres e informadas para mujeres en edad reproductiva</p>
                <!-- <p class="lh-sm font-txt-subtitle fs-4 text"><span class="fw-bolder text-white">DAME TU BRAZO</span><br><span class="text-white">POR EL FUTURO</span></p>
                <p class="fw-normal fs-3 text-white">Basado en decisiones conscientes, libres e informadas para mujeres en edad reproductiva</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- seccion derecha -->
      <div id="sectR" class="col-lg-6 col-sm-12 d-flex justify-content-center">
        <div id="txt-login" class="col-9 bg-white mgradio ">
          <div class="col-9 py-3">
            <form id="objForm" onsubmit="sendDataForm(this.id, event)">
              <div class="mb-3 mb-3 text-start">
                <label class="form-label">USUARIO:</label>
                <input type="text" class="form-control" id="login_email" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3 mb-3 text-start">
                <label class="form-label">CONTRASEÑA:</label>
                <input type="password" class="form-control" id="login_password" required>
              </div>
              <button id="btn_send" type="submit" class="btn btn-primary">INGRESAR</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-12 pt-1">
        <div class="container-fluid text-start">
          <div class="col-12 d-flex no-block align-items-left">
            <div class="container">
              <small class="text-break text-start fw-light lh-1 text-white">Este es un programa de educación informal que hace parte de la oferta de Educación Continuada de la Fundación Universitaria de Ciencias de la Salud -FUCS, y se desarrolla en virtud del convenio suscrito entre la FUCS y ABBOTT. Su desarrollo no conduce a título o certificado alguno, solo conduce a la expedición de una constancia de asistencia, conforme al Artículo 2.6.6.8 Decreto 1075 de 2015</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- All Jquery -->
    <?= $script ?>
    <script src="../controller/authentication/login.controller.js"></script>
     <script>
      window.onload=onloadView();
    </script>
</body>
</html>