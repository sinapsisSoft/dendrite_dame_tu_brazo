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
    
    <div class="pt-2 d-block">
      <div class="row justify-content-start txt-div">
        <div class="col-12 d-flex align-items-left">
          <div id="txt-title" class="col-xl-5 col-lg-5 col-md-5 col-sm-8 col-11 bg-white mgradio">
            <div class="row">
              <div class="col-12 px-4 pe-md-4 pe-3 pe-lg-5 px-lg-5 py-2 text-start">
                <div class="pb-4 pb-md-2">
                  <p class="fw-bolder text-break font-txt-title txt-color-1">BIENVENIDO</p>
                  <p class="fs-3 lh-sm text-muted">Usted ha sido elegido para realizar el curso virtual</p>
                </div>
                <p class="lh-sm font-txt-subtitle"><span class="fw-bolder txt-color-2">DAME TU BRAZO</span><br><span class="txt-color-1">POR EL FUTURO</span></p>
                <p class="fw-normal fs-3 txt-color-2">Basado en decisiones conscientes, libres e informadas para mujeres en edad reproductiva</p>
              </div>
              <div class="col-12 px-4 pe-md-4 pe-3 pe-lg-5 px-lg-5 py-2 d-flex align-items-end justify-content-around align-self-end">
                <div class="col-xl-6 mb-3 me-3">
                  <a href="../assets/document/Recolección_Tratamiento_Datos.pdf" class="badge bg-primary text-wrap text-start" target="blank_" onclick="acceptTreatment(0);"><span>Acepto </span><br><span class="btn-text">Tratamiento de datos </span></a>
                </div>
                <div class="col-xl-6 mb-3">
                  <a href="../assets/document/Transferencias_Valor.pdf" class="badge bg-primary text-wrap text-start" target="blank_" onclick="acceptTreatment(1);"><span>Transferencia </span><br><span class="btn-text">de valor</span></a>
                </div>
              </div>
              <div class="col-12 px-4 pe-md-4 pe-3 pe-lg-5 px-lg-5 py-2">
                <p class="font-small-txt">¿Tienes dudas adicionales? Consulta nuestra Política de Tratamiento de Datos Personales: Abbott En América 
                  Latina | Política de privacidad <a href="https://www.latam.abbott/privacy-policy/privacy-policy-colombia.html" target="blank_" class="font-small-txt">(latam.abbott)</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 pt-1">
          <div class="container-fluid text-start">
            <div class="col-12 d-flex no-block align-items-left">
              <div class="container">
                <small class="text-break text-start fw-lighter lh-1 text-white">Este es un programa de educación informal que hace parte de la oferta de Educación Continuada de la Fundación Universitaria de Ciencias de la Salud -FUCS, y se desarrolla en virtud del convenio suscrito entre la FUCS y ABBOTT. Su desarrollo no conduce a título o certificado alguno, solo conduce a la expedición de una constancia de asistencia, conforme al Artículo 2.6.6.8 Decreto 1075 de 2015</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/home/home.controller.js"></script>  
</body>

</html>