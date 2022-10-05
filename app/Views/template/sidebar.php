<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url()?>/home/index" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-scatterplot-hexbin"></i><span class="hide-menu">Analytics</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/analytics/to_list_suggestion" class="sidebar-link"><i class="mdi mdi-chart-scatterplot-hexbin"></i><span class="hide-menu">Crop Suggestion</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/analytics/to_list_conditions" class="sidebar-link"><i class="mdi mdi-chart-scatterplot-hexbin"></i><span class="hide-menu">Growing Conditions</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/report/view" class="sidebar-link"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Crop Production</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=base_url()?>/farm/to_list" aria-expanded="false"><i class="fas fa-industry"></i><span class="hide-menu">Farm Management</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-retweet"></i><span class="hide-menu">Crop Management</span></a>
                            <ul aria-expanded="false" class="collapse first-level">    
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/cultivate/to_list" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Cultivate</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/cultivate/to_list_previous" class="sidebar-link"><i class="fas fa-angle-double-left"></i><span class="hide-menu">Previous Crop</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/plot/to_list" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Plot</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/soil/to_list" class="sidebar-link"><i class="fas fa-chart-area"></i><span class="hide-menu">Soil Preparation</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/sowing/to_list" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Sowing</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/fertilization/to_list" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Fertilization</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/irrigation/to_list" class="sidebar-link"><i class="mdi mdi-water"></i><span class="hide-menu">Irrigation</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="fas fa-heartbeat"></i><span class="hide-menu">Disease Plague</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Weeds</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class=" fas fa-tachometer-alt"></i><span class="hide-menu">Weather Tracking</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-factory"></i><span class="hide-menu">Harvest</span></a>
                                </li>
                              
                                
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-message-settings-variant"></i><span class="hide-menu">Crop Settings Data</span></a>
                            <ul aria-expanded="false" class="collapse first-level">    
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Pests</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Diseases</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Allelopathy</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/crop_activities/to_list" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Crop Activities</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a  href="<?=base_url()?>/crop/to_list"  class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Crop </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/crop_cycle/to_list" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Crop Cycle</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/crop_type/to_list" class="sidebar-link"><i class="mdi mdi-database"></i><span class="hide-menu">Crop Type</span></a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Setting </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/user/to_list" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu">Users </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/user/to_list_role" class="sidebar-link"><i class="mdi mdi-account-convert"></i><span class="hide-menu">Role</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-burst-mode"></i><span class="hide-menu">Modules</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/user/to_list_permission" class="sidebar-link"><i class="mdi mdi-security"></i><span class="hide-menu">Permissions</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a  href="<?=base_url()?>/user/to_list_state"  class="sidebar-link"><i class="mdi mdi-account-key"></i><span class="hide-menu">User States</span></a>
                                </li>
                            </ul>
                        </li>               
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="home/index" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Products</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/system/to_list_units" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu">Units</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/system/calendar"  class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="pages-invoice.html" class="sidebar-link"><i class="fas fa-shopping-bag"></i><span class="hide-menu"> Shopping</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="pages-invoice.html" class="sidebar-link"><i class="fas fa-shipping-fast"></i><span class="hide-menu"> Transportation</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?=base_url()?>/system/to_list_city"  class="sidebar-link"><i class="mdi mdi-city"></i><span class="hide-menu">City</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication
                                </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
