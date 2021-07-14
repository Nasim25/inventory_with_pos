<!doctype html>
<html lang="en" class="fixed left-sidebar-top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>BAITS POS</title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('backend/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/favicon/favicon-16x16.png')}}">
    <!--load progress bar-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/vendor/pace/pace.min.js')}}"></script>
    <link href="{{ asset('backend/vendor/pace/pace-theme-minimal.css')}}" rel="stylesheet" />
    
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/animate.css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/select2/css/select2-bootstrap.min.css')}}">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/toastr.min.css')}}">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('backend/stylesheets/css/style.css')}}">


</head>

<body>
    <div class="wrap" id="app">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        <div class="page-header" id="header_hide" v-show="$route.path === '/' ? false : true " style="display:none">
            <!-- LEFTSIDE header -->
            <div class="leftside-header">
                <div class="logo">
                    <a href="#" class="on-click">
                        <!-- <img alt="logo" src="{{ asset('backend/images/header-logo.png')}}" /> -->
                        <h3>BAITS POS</h3>
                    </a>
                </div>
                <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <!-- RIGHTSIDE header -->
            <div class="rightside-header">
                <div class="header-middle"></div>
                <!--SEARCH HEADERBOX-->
                <div class="header-section" id="search-headerbox">
                    <input type="text" name="search" id="search" placeholder="Search...">
                    <i class="fa fa-search search" id="search-icon" aria-hidden="true"></i>
                    <div class="header-separator"></div>
                </div>
                <!--NOCITE HEADERBOX-->
                <div class="header-section hidden-xs" id="notice-headerbox">
                    <!--check list-->
                    
                    <!--messages-->
                    <!-- <div class="notice" id="messages-notice">
                        <i class="fa fa-comments-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger"><i class="fa fa-exclamation"></i></span>
                        </i>
                        <div class="dropdown-box basic">
                            <div class="drop-header ">
                                <h3><i class="fa fa-comments" aria-hidden="true"></i> Messages</h3>
                                <span class="badge x-danger b-rounded">120</span>
                            </div>
                            <div class="drop-content">
                                <div class="widget-list list-left-element">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{asset('backend/')}}/images/avatar/avatar_1.jpg" /></div>
                                                <div class="text">
                                                    <span class="title">John Doe</span>
                                                    <span class="subtitle">hello world</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{asset('backend/')}}/images/avatar/avatar_2.jpg" /></div>
                                                <div class="text">
                                                    <span class="title">Alice Smith</span>
                                                    <span class="subtitle">hello world</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{asset('backend/')}}/images/avatar/avatar_3.jpg" /></div>
                                                <div class="text">
                                                    <span class="title">Klaus Wolf</span>
                                                    <span class="subtitle">hello world</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{asset('backend/')}}/images/avatar/avatar_4.jpg" /></div>
                                                <div class="text">
                                                    <span class="title">Sun Li</span>
                                                    <span class="subtitle">hello world</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><img alt="profile photo" src="{{asset('backend/')}}/images/avatar/avatar_5.jpg" /></div>
                                                <div class="text">
                                                    <span class="title">Sonia Valera</span>
                                                    <span class="subtitle">hello world</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="drop-footer">
                                <a>See all messages</a>
                            </div>
                        </div>
                    </div> -->
                    <!--alerts notices-->
                    <!-- <div class="notice" id="alerts-notice">
                        <i class="fa fa-bell-o" aria-hidden="true"><span class="badge badge-xs badge-top-right x-danger">7</span></i>

                        <div class="dropdown-box basic">
                            <div class="drop-header">
                                <h3><i class="fa fa-bell-o" aria-hidden="true"></i> Notifications</h3>
                                <span class="badge x-danger b-rounded">7</span>

                            </div>
                            <div class="drop-content">
                                <div class="widget-list list-left-element list-sm">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><i class="fa fa-warning color-warning"></i></div>
                                                <div class="text">
                                                    <span class="title">8 Bugs</span>
                                                    <span class="subtitle">reported today</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><i class="fa fa-flag color-danger"></i></div>
                                                <div class="text">
                                                    <span class="title">Error</span>
                                                    <span class="subtitle">sevidor C down</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><i class="fa fa-cog color-dark"></i></div>
                                                <div class="text">
                                                    <span class="title">New Configuration</span>
                                                    <span class="subtitle"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><i class="fa fa-tasks color-success"></i></div>
                                                <div class="text">
                                                    <span class="title">14 Task</span>
                                                    <span class="subtitle">completed</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="left-element"><i class="fa fa-envelope color-primary"></i></div>
                                                <div class="text">
                                                    <span class="title">21 Menssage</span>
                                                    <span class="subtitle"> (see more)</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="drop-footer">
                                <a>See all notifications</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="header-separator"></div>
                </div>
                <!--USER HEADERBOX -->
                <div class="header-section" id="user-headerbox">
                    <div class="user-header-wrap">
                        <div class="user-photo">
                            <img alt="profile photo" src="{{ asset('backend/')}}/images/avatar/avatar_user.jpg" />
                        </div>
                        <div class="user-info">
                            <span class="user-name">Jane Doe</span>
                            <span class="user-profile">Admin</span>
                        </div>
                        <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                        <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                    </div>
                    <div class="user-options dropdown-box">
                        <div class="drop-content basic">
                            <ul>
                                <li> <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                                <li> <a href="#"><i class="fa fa-lock" aria-hidden="true"></i> Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-separator"></div>
                <!--Log out -->
                <div class="header-section">
                    <router-link to="/logout" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></router-link>
                </div>
            </div>
        </div>
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="left-sidebar" id="sidebar_hide" v-show="$route.path === '/' ? false : true " style="display:none">
                <!-- left sidebar HEADER -->
                <div class="left-sidebar-header">
                    <div class="left-sidebar-title">Navigation</div>
                    <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                        <span></span>
                    </div>
                </div>
                <!-- NAVIGATION -->
                <!-- ========================================================= -->
                <div id="left-nav" class="nano">
                    <div class="nano-content">
                        <nav>
                            <ul class="nav nav-left-lines" id="main-nav">
                                <!--HOME-->
                                <li class="active-item">
                                    <router-link to="/home" style="width: 216%;"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></router-link>
                                </li>
                                
                                <!--UI ELEMENTENTS-->
                                
                                <li class="close-item" style="width: 122%;">
                                    <router-link to="/pos"><i class="fa fa-cart-plus" aria-hidden="true"></i><span>POS</span></router-link>
                                    
                                </li>
                                
                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-users" aria-hidden="true" style="font-size: 16px;"></i><span>Employee</span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/store-employee" >Add Employee</router-link></li>
                                        <li><router-link to="/employee">All Employee</router-link></li>
                                    </ul>
                                </li>
                                

                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-truck" aria-hidden="true" style="font-size: 18px;"></i><span>Suppliers</span> </a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/store-supplier">Add Supplier</router-link></li>
                                        <li><router-link to="/supplier">All Suppliers</router-link></li>
                                    </ul>
                                </li>

                                
                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-list-alt" aria-hidden="true"></i><span>Category </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/store-category">Add Category</router-link></li>
                                        <li><router-link to="/category">All Category</router-link></li>
                                    </ul>
                                </li>

                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-columns" aria-hidden="true"></i><span>Product </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/product-create">Add Product</router-link></li>
                                        <li><router-link to="/product">All Product</router-link></li>
                                    </ul>
                                </li>
                               
                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-columns" aria-hidden="true"></i><span>Purchase </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/purchase/create">Purchase</router-link></li>
                                        <li><router-link to="/purchase/list">All Purchase</router-link></li>
                                    </ul>
                                </li>

                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-file" aria-hidden="true"></i><span>Expense </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/expense-create">Add Expense</router-link></li>
                                        <li><router-link to="/expense">All Expense</router-link></li>
                                    </ul>
                                </li>
                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-dollar" aria-hidden="true"></i><span>Salary </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/given-salary">Add Salary</router-link></li>
                                        <li><router-link to="/product">All Salary</router-link></li>
                                    </ul>
                                </li>
                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-user" aria-hidden="true"></i><span>Customer </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/store-customer">Add Customer</router-link></li>
                                        <li><router-link to="/customer-list">Customer List</router-link></li>
                                    </ul>
                                </li>
                                
                                <li class="close-item" style="width: 122%;">
                                    <router-link to="/stock"><i class="fa fa-briefcase" aria-hidden="true"></i><span>Stock</span></router-link>
                                    
                                </li>

                                <li class="close-item" style="width: 122%;">
                                    <router-link to="/sales"><i class="fa fa-cubes" aria-hidden="true"></i><span>Sales</span></router-link>
                                    
                                </li>

                                <li class="has-child-item close-item" style="width: 122%;">
                                    <a><i class="fa fa-user" aria-hidden="true"></i><span>Reports </span></a>
                                    <ul class="nav child-nav level-1">
                                        <li><router-link to="/daily/summary">Daily Summary Report</router-link></li>
                                        <li><router-link to="/product/purchase/report">Product Purchase Report</router-link></li>
                                        
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">
               
                <router-view></router-view>
            
            </div>
            <!-- RIGHT SIDEBAR -->
            <!-- ========================================================= -->
            <div class="right-sidebar">
                <div class="right-sidebar-toggle" data-toggle-class="right-sidebar-opened" data-target="html">
                    <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                </div>
                <div id="right-nav" class="nano">
                    <div class="nano-content">
                        <div class="template-settings">
                            <h4 class="text-center">Template Settings</h4>
                            <ul class="toggle-settings pv-xlg">
                                <li>
                                    <h6 class="text">Header fixed</h6>
                                    <label class="switch">
                                        <input id="header-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Content header fixed</h6>
                                    <label class="switch">
                                        <input id="content-header-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar collapsed</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-collapsed" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar Top</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-top" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar fixed</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-fixed" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar over</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-over" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                                <li>
                                    <h6 class="text">Left sidebar nav left-lines</h6>
                                    <label class="switch">
                                        <input id="left-sidebar-left-lines" type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </li>
                            </ul>
                            <h4 class="text-center">Template Colors</h4>

                            <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="index.html" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/dark_green.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/white_green.png" /></a>
                                </div>
                            </div>
                            <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/dark_white.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/white_dark.png" /></a>
                                </div>
                            </div>
                            <div class="row toggle-colors">
                                <div class="col-xs-6">
                                    <a href="" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/dark_blue.png" /></a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="" class="on-click"> <img alt="Helsinki-green" src="{{ asset('backend/')}}/images/theme/white_blue.png" /></a>
                                </div>
                            </div>
                            <div class="row mt-lg">
                                <div class="col-sm-12 text-center">
                                    <a  target="_blank" href=""><h5> <i class="fa fa-book mr-sm"></i>Online Documentation</h5></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('backend/vendor/jquery/jquery-1.12.3.min.js')}}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="{{ asset('backend/javascripts/template-script.min.js')}}"></script>
    <script src="{{ asset('backend/javascripts/template-init.min.js')}}"></script>
    <!-- SECTION script and examples-->
    
    <!--morris chart-->
    <script src="{{ asset('backend/vendor/chart-js/chart.min.js')}}"></script>
    <!--Gallery with Magnific popup-->
    <!--Examples-->
    <script src="{{ asset('backend/javascripts/examples/dashboard.js')}}"></script>

    <script src="{{asset('backend/vendor/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('backend/javascripts/examples/forms/advanced.js')}}"></script>

    <script type="text/javascript">
     let token = localStorage.getItem('token');
     if (token) {
      $("#header_hide").css("display","");
      $("#sidebar_hide").css("display","");

     }
   </script>
    
   
</body>
</html>