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
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?= $header ?>
        <?= $leftSidebar ?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Library
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">

                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-chart-scatterplot-hexbin"></i>
                                </h1>
                                <h6 class="text-white">Analytics - Crop Suggestion</h6>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-chart-scatterplot-hexbin"></i>
                                </h1>
                                <h6 class="text-white">Analytics - Growing Conditions</h6>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-chart-bar"></i>
                                </h1>
                                <h6 class="text-white">Charts - Crop Production</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center" style="background-color:#121925 !important"> 
                                <h1 class="font-light text-white">
                                    <i class="fas fa-industry"></i>
                                </h1>
                                <h6 class="text-white">Farm Management</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center" style="background-color:#123b52 !important">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-retweet"></i>
                                </h1>
                                <h6 class="text-white">Crop cycle management</h6>
                                <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-factory"></i>
                                            </h1>
                                            <h6 class="text-white">Cultivate </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fas fa-angle-double-left"></i>
                                            </h1>
                                            <h6 class="text-white">Previous Crop</h6>
                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-factory"></i>
                                            </h1>
                                            <h6 class="text-white">Plot</h6>
                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fas fa-chart-area"></i>
                                            </h1>
                                            <h6 class="text-white">Soil Preparation</h6>
                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-factory"></i>
                                            </h1>
                                            <h6 class="text-white">Sowing</h6>
                
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-factory"></i>
                                            </h1>
                                            <h6 class="text-white">Fertilization</h6>
                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-water"></i>
                                            </h1>
                                            <h6 class="text-white">Irrigation</h6>
                
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-bug"></i> <i class="fas fa-heartbeat"></i> 
                                            </h1>
                                            <h6 class="text-white">Disease Plague</h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fab fa-envira"></i>
                                            </h1>
                                            <h6 class="text-white">Weeds</h6>
                                           
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </h1>
                                            <h6 class="text-white">Weather Tracking</h6>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-factory"></i>
                                            </h1>
                                            <h6 class="text-white">Harvest</h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                           
                            <div class="box bg-info text-center" style="background-color:#14678a !important"> 
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-message-settings-variant"></i>
                                </h1>
                                <h6 class="text-white">Crop Settings Data</h6>
                                <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Pest</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Diseases</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Allelopathy</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Crop Activities</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Crop</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Crop Cycle</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-database"></i>
                                            </h1>
                                            <h6 class="text-white">Crop Type</h6>
                                        </div>
                                    </div>
                                </div>
                              
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                          
                            <div class="box bg-info text-center" style="background-color:#1da2c9 !important"> 
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-settings"></i>
                                </h1>
                                <h6 class="text-white">Settings</h6>
                                <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-account"></i>
                                            </h1>
                                            <h6 class="text-white">Users</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-account-convert"></i>
                                            </h1>
                                            <h6 class="text-white">Role</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-burst-mode"></i>
                                            </h1>
                                            <h6 class="text-white">Modules</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-security"></i>
                                            </h1>
                                            <h6 class="text-white">Permissions</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-account-key"></i>
                                            </h1>
                                            <h6 class="text-white">User States</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-12 col-xlg-12">
                        <div class="card card-hover">
                        <div class="box bg-info text-center" style="background-color:#20dbd8 !important"> 
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-move-resize-variant"></i>
                                </h1>
                                <h6 class="text-white">Addons</h6>
                                <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-view-dashboard"></i>
                                            </h1>
                                            <h6 class="text-white">Products</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-multiplication-box"></i>
                                            </h1>
                                            <h6 class="text-white">Units</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </h1>
                                            <h6 class="text-white">Calendar</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fas fa-shopping-bag"></i>
                                            </h1>
                                            <h6 class="text-white">Shopping</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="fas fa-shipping-fast"></i>
                                            </h1>
                                            <h6 class="text-white">Transportation</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2 col-xlg-3 mx-auto">
                                    <div class="card card-hover">
                                        <div class="box bg-warning  text-center">
                                            <h1 class="font-light text-white">
                                                <i class="mdi mdi-city"></i>
                                            </h1>
                                            <h6 class="text-white">City</h6>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <!-- Column -->
                    <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-all-inclusive"></i>
                                </h1>
                                <h6 class="text-white">Login</h6>
                            </div>
                        </div>
                    </div>
                       <!-- Column -->
                       <div class="col-md-6 col-lg-6 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    <i class="mdi mdi-all-inclusive"></i>
                                </h1>
                                <h6 class="text-white">Register</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Site Analysis</h4>
                                        <h5 class="card-subtitle">Overview of Latest Month</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            <div class="flot-chart-content" id="flot-line-chart"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                                                    <h5 class="mb-0 mt-1">2540</h5>
                                                    <small class="font-light">Total Users</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-plus fs-3 font-16"></i>
                                                    <h5 class="mb-0 mt-1">120</h5>
                                                    <small class="font-light">New Users</small>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-cart fs-3 mb-1 font-16"></i>
                                                    <h5 class="mb-0 mt-1">656</h5>
                                                    <small class="font-light">Total Shop</small>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-tag fs-3 mb-1 font-16"></i>
                                                    <h5 class="mb-0 mt-1">9540</h5>
                                                    <small class="font-light">Total Orders</small>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-table fs-3 mb-1 font-16"></i>
                                                    <h5 class="mb-0 mt-1">100</h5>
                                                    <small class="font-light">Pending Orders</small>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <div class="bg-dark p-10 text-white text-center">
                                                    <i class="mdi mdi-web fs-3 mb-1 font-16"></i>
                                                    <h5 class="mb-0 mt-1">8540</h5>
                                                    <small class="font-light">Online Orders</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?= $footer ?>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?= $script ?>
    <!-- this page js -->
    <script src="../assets/matrix-admin-bt5/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/matrix-admin-bt5/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/matrix-admin-bt5/extra-libs/DataTables/datatables.min.js"></script>

</body>

</html>