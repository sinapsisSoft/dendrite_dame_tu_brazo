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
        <a class="btn-cert1  text-black">
          <i class="m-1"><img class="imagen" width="45" heigth="45" src="../assets/img/icon/img-4.png"></i>
          <p class="d-none d-lg-block pe-3"><label class="mb-0">Quiz</label></p>
        </a>
      </div>
      <div class="fixed-top-home btn-flotante">
        <button class="btn-info nav-link btn  text-black w-md-25 w-50 w-lg-100" onclick="backMainModule();">
          <i class="fas fa-home btn-home"></i>
        </button>
      </div>
      <div class="info-btn-manual btn-flotante">
        <a href="https://ior.ad/8vHP" target="blank_" class="mt-0 btn-info-ftr nav-link btn btn-light text-black w-md-25 w-50 w-lg-100 " aria-current="page" href="#">
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
                  <p class="lh-sm font-txt-subtitle fs-1  txt-color-1"><strong>CUESTIONARIO</strong></p>
                  <p class="fw-normal fs-2 txt-color-1">INTERACTIVO</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- seccion Derecha -->
        <div id="sectR" class="col-lg-5 col-md-4 col-sm-12 col-12 ">
          <div class="container">
            <div class="table-responsive d-md-block table-pdf w-100" tabindex="0">
              <form id="formQuiz" onsubmit="validateAnswer(this.id, event, 0);">
                <div class="div-test">
                  <div class="row">
                    <div class="col-12">
                      <ol>
                        <?php $question = $content_questions[0]->question_id ?>
                        <li><label><?= $content_questions[0]->question_text ?></label></li>
                        <?php foreach ($content_questions as $item) : ?>
                          <?php if ($question != $item->question_id) : ?>
                            <li><label><?= $item->question_text ?></label></li>
                            <?php $question = $item->question_id ?>
                          <?php endif ?>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?= $item->question_id ?>" id="answer<?= $item->question_answer_id ?>" required>
                            <label class="form-check-label" for="answer<?= $item->question_answer_id ?>">
                              <?= $item->answer_text ?>
                            </label>
                          </div>
                        <?php endforeach ?>
                      </ol>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-auto">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?= $footer ?>
    </div>
  </div>

  <!-- Modal Socre -->

<div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scoreModalLabel">Tu Calificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="scoreBody" class="modal-body">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

  <!-- All Jquery -->
  <?= $script ?>
  <script src="../controller/main/main.controller.js?v=0.01"></script>
  <script>
    var jsonQuiz = <?= json_encode($content_questions) ?>;
    document.getElementById("module_id").innerHTML = `Módulo <?= $module_id ?>`;
  </script>
</body>

</html>