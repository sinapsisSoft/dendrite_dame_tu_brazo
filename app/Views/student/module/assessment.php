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
    <div class="mt-2 bg-white d-block vh-85">
      <!-- botones flotantes -->
      <div class="fixed-top-info1 btn-flotante">
        <a class="btn-info1 text-black " aria-current="page">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-5.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Evaluación del módulo</label></p>
        </a>
      </div>
      <div class="info-btn-home btn-flotante">
        <button class="btn-info nav-link btn btn-light text-black w-md-25 w-50 w-lg-100" aria-current="page" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>
      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vI9" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
            <i class="fas fa-info btn-icon-info"></i>
        </a>
      </div>

      <div class="row m-0 align-items-center vh-72 justify-content-start col-12 txt-div-module">
        <!-- seccion izquierda -->

        <div id="sectL" class="col-lg-6 col-md-7 col-sm-11 col-11">
          <div class="container-fluid">
            <div class="col-12 no-block align-items-left">
              <div id="txt-title" class="row">
                <div class="col-12 ps-sm-5 pe-lg-2 px-md-5 ps-lg-5 text-start line">
                  <p class="lh-sm font-txt-subtitle fs-1 txt-color-1"><strong>EVALUACIÓN</strong></p>
                  <p class="fw-normal fs-2 txt-color-1">DEL MÓDULO</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- seccion Derecha -->
        <div id="sectR" class="col-lg-5 col-md-4 col-sm-12 col-12 ">
          <div class="container">
            <div class="table-responsive d-none d-md-block table-pdf w-100" tabindex="0">
              <form id="formAssesssment" action="" onsubmit="validateAnswer(this.id, event, 1)">
                <div class="div-test">
                  <div class="row">
                    <p class="lh-sm font-txt-subtitle fs-6 txt-color-1"><strong>ENCUESTA DE SATISFACCIÓN</strong></p>
                    <p class="fw-normal fs-6 txt-color-1">DAME TU BRAZO POR EL FUTURO 2022</p>
                    <p>En una escala de 1 a 5, donde 1 significa totalmente en desacuerdo y 5 totalmente de acuerdo, 
                      por favor califique los siguientes aspectos de su proceso de aprendizaje:</p>
                    <div class="col-12">
                      <ol>
                        <?php $question = $content_questions[0]->question_id ?>
                        <li><label><?= $content_questions[0]->question_text ?></label></li>
                        <?php foreach ($content_questions as $item) : ?>
                          <?php if ($item->question_type == "radio") : ?>
                            <?php if ($question != $item->question_id) : ?>
                              <li><label><?= $item->question_text ?></label></li>
                              <?php $question = $item->question_id ?>
                            <?php endif ?>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="question<?= $item->question_id ?>" id="answer<?= $item->question_answer_id ?>" required <?= $disabled ?>>
                              <label class="form-check-label" for="answer<?= $item->question_answer_id ?>">
                                <?= $item->answer_text ?>
                              </label>
                            </div>
                          <?php endif ?>
                        <?php endforeach ?>
                      </ol>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary" <?= $disabled ?>>Enviar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?= $footer ?>
  </div>

  <!-- Modal assessment -->
  <div class="modal fade" id="assessmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <?php if ($content_questions[0]->module_id == 4) : ?>
          <h5 class="modal-title" id="assessmentModalLabel">Queremos conocer tu opinión</h5>
        <?php else: ?>
          <h5 class="modal-title" id="assessmentModalLabel">Evaluación del Módulo</h5>
        <?php endif ?>  
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="scoreBody" class="modal-body">
        <?php if ($content_questions[0]->module_id == 4) : ?> 
          <form id="formLastQ" onsubmit="setLastQuestion(this.id, event)">
            <label for="txtAreaLastQ"><?= $content_questions[25]->question_text ?></label>
            <textarea id="<?= $content_questions[25]->question_answer_id ?>" class="form-control" placeholder="Escriba su respuesta" id="txtAreaLastQ" rows="4" required></textarea>
          </form>        
          <?php else: ?>
            <h3>Gracias por calificarnos!</h3>  
        <?php endif ?>  
      </div>
      <div id="footerScore" class="modal-footer">
      <?php if ($content_questions[0]->module_id == 4) : ?>
        <button type="submit" class="btn btn-primary" form="formLastQ">Enviar</button>
        <?php else: ?>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salir</button>
        <?php endif ?>          
      </div>
    </div>
  </div>
</div>

  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/main/main.controller.js"></script>
  <script>
    document.getElementById("module_id").innerHTML = `Módulo <?= $module_id ?>`;
    setNotification();
  </script>
</body>

</html>