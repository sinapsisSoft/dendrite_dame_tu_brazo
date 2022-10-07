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

<body>
  <!-- Preloader - style you can find in spinners.css -->
  <div class="preloader" style="display: none">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- Main wrapper - style you can find in pages.scss -->
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full" class="inx-vh-100">
    <!-- Topbar header - style you can find in pages.scss -->
    <?= $header ?>
    <div class="col-12 d-block">
      <div class="fixed-top-db btn-flotante">
        <button class="btn-logout btn btn-light text-black " aria-current="page" onclick="logOut();"><i class="mdi mdi-account-circle btn-icon"></i>
          <p class="d-none d-md-block pe-3">Log Out</p>
        </button>
      </div>
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title fs-2">Graficas</h4>
            <div class="ms-auto text-end">
            </div>
          </div>
        </div>
      </div>
      <div class="mb-4 border border-3 rounded-3 mx-5 mt-5">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>
          <br>
          <div class="card-header py-3">
            <div class="container-sm">
              <label class="bmd-label-floating">Periodo</label>
              <div class="row d-flex justify-content-start">
                <div class="col-6 mb-0">
                  <div class="container-sm">
                    <form id="formSearchReport">
                      <div class="row">
                        <div class="col-5">
                          <input id="iniDate" type="date" class="form-control form-control-sm" value="2022-10-03" readonly >
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                          <h5>a</h5>
                        </div>
                        <div class="col-5">
                          <input id="finDate" type="date" class="form-control form-control-sm">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-2">
                  <button class="btn btn-primary rounded-pill" onclick="searchReport(event);return false">Filtrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row reportChart justify-content-center">
            <div id="chart1Report" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <canvas id="chart1" style="width: 100%;"></canvas>
            </div>

            <!-- <div id="chart2Report" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
              <canvas id="chart2" style="width: 100%;"></canvas>
            </div> -->

            <div class="col-12 text-right my-4 d-flex justify-content-end">
              <a href="#" class="btn btn-primary rounded-pill" id="btnExcel" onclick="fnExcelReport('tableStudentReport','Reporte Alumnos');">Descargar en excel <i class="ms-1 far fa-file-excel"></i></a>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive my-custom-scrollbar">
              <table class="table" data-order="[[ 1, &quot;asc&quot; ]]" data-page-length="25" id="tableStudentReport" width="100%" cellspacing="0">
                <thead class="text-wine">
                    
                </tbody>             
              </table>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="scoreModal" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scoreModalLabel">Resultados</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-modulo-1-tab" data-bs-toggle="tab" data-bs-target="#nav-modulo-1" type="button" role="tab" aria-controls="nav-modulo-1" aria-selected="true">Módulo 1</button>
              <button class="nav-link" id="nav-modulo-2-tab" data-bs-toggle="tab" data-bs-target="#nav-modulo-2" type="button" role="tab" aria-controls="nav-modulo-2" aria-selected="false">Módulo 2</button>
              <button class="nav-link" id="nav-modulo-3-tab" data-bs-toggle="tab" data-bs-target="#nav-modulo-3" type="button" role="tab" aria-controls="nav-modulo-3" aria-selected="false">Módulo 3</button>
              <button class="nav-link" id="nav-modulo-4-tab" data-bs-toggle="tab" data-bs-target="#nav-modulo-4" type="button" role="tab" aria-controls="nav-modulo-4" aria-selected="false">Módulo 4</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-modulo-1" role="tabpanel" aria-labelledby="nav-modulo-1-tab">
              <div class="container m-2 d-flex py-3 justify-content-center">
                <div class="row row-cols-auto shadow p-3 bg-body rounded">
                  <div class="col">
                    <h3 id="assessment-title-1"></h3>
                  </div>
                  <div id="assessment-1" class="col-12">                    
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-modulo-2" role="tabpanel" aria-labelledby="nav-modulo-2-tab">
              <div class="container m-2 d-flex py-3 justify-content-center">
                <div class="row row-cols-auto shadow p-3 bg-body rounded">
                  <div class="col">
                    <h3 id="assessment-title-2"></h3>
                  </div>
                  <div id="assessment-2" class="col-12">
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-modulo-3" role="tabpanel" aria-labelledby="nav-modulo-3-tab">
              <div class="container m-2 d-flex py-3 justify-content-center">
                <div class="row row-cols-auto shadow p-3 bg-body rounded">
                  <div class="col">
                    <h3 id="assessment-title-3"></h3>
                  </div>
                  <div id="assessment-3" class="col-12">
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-modulo-4" role="tabpanel" aria-labelledby="nav-modulo-4-tab">
              <div class="container m-2 d-flex py-3 justify-content-center">
                <div class="row row-cols-auto shadow p-3 bg-body rounded">
                  <div class="col">
                    <h3 id="assessment-title-4"></h3>
                  </div>
                  <div id="assessment-4" class="col-12">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- All Jquery -->
  <?= $script ?>  
  <script src="../assets/js/chart.js"></script>
  <script src="../assets/js/table-filter.js"></script>
  <script src="../assets/js/table.js"></script>
  <script src="../assets/js/export-excel.js"></script>
  <script src="../controller/admin/admin.controller.js"></script>
  <script src="../controller/authentication/login.controller.js"></script>
</body>

</html>