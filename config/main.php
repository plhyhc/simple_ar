<?php
session_start();

$not_logged_in = false;
if(!isset($_SESSION['logged_in'])){
    $not_logged_in = true;
} else if($_SESSION['logged_in'] != '123kjdn43kj3nskdj'){
    $not_logged_in = true;
}
if($not_logged_in){
    if(!$login_page){
        header("Location: login.php");
        die();
    }
}

include 'config.php';

if(in_array('<db_unset>',$db_params)){
    header("Location: install");
    die();
}



class main {

    
    public function get_header(){
        $header = '<!DOCTYPE html>
        <!-- 
        Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0.3
        Version: 1.5.2
        Author: KeenThemes
        Website: http://www.keenthemes.com/
        Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
        -->
        <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
        <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
        <!--[if !IE]><!-->
        <html lang="en" class="no-js">
        <!--<![endif]-->
        <!-- BEGIN HEAD -->
        <head>
        <meta charset="utf-8"/>
        <title>Krafts Restore</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="assets/css/default.css"/>
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
        </head>
        <!-- END HEAD -->
        <!-- BEGIN BODY -->
        <body class="page-header-fixed">
        <!-- BEGIN HEADER -->
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="header-inner">
                <!-- BEGIN LOGO -->
                <a class="navbar-brand" href="index.html">
                <img src="assets/img/logo.png" alt="logo" class="img-responsive"/>
                </a>
                <!--<form class="search-form search-form-header" role="form" action="index.html">
                    <div class="input-icon right">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control input-medium input-sm" name="query" placeholder="Search...">
                    </div>
                </form>-->
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <img src="assets/img/menu-toggler.png" alt=""/>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <ul class="nav navbar-nav pull-right">
                    
                    <li class="devider">
                         &nbsp;
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!--<img alt="" src="assets/img/avatar3_small.jpg"/>-->
                        <span class="username">
                             Account
                        </span>
                        <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="user_profile.php"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <!--<li>
                                <a href="page_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a>
                            </li>
                            <li class="divider">
                            </li>
                        </li>-->
                        <li>
                            <a href="logout.php"><i class="fa fa-key"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu">
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                            </div>
                            <div class="clearfix">
                            </div>
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li>
                            <form class="search-form" role="form" action="index.html" method="get">
                                <div class="input-icon right">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control input-medium input-sm" name="query" placeholder="Search...">
                                </div>
                            </form>
                        </li>
                        <li class="start active ">
                            <a href="index.php">
                            <i class="fa fa-home"></i>
                            <span class="title">
                                Home
                            </span>
                            <span class="selected">
                            </span>
                            </a>
                        </li>
                        <li class="start active ">
                            <a href="receivables.php">
                            <i class="fa fa-money"></i>
                            <span class="title">
                                Receivables
                            </span>
                            <span class="selected">
                            </span>
                            </a>
                        </li>
                        <li class="start active ">
                            <a href="customers.php">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                Customers
                            </span>
                            <span class="selected">
                            </span>
                            </a>
                        </li>
                        <li class="start active ">
                            <a href="import.php">
                            <i class="fa fa-arrow-circle-down"></i>
                            <span class="title">
                                Import
                            </span>
                            <span class="selected">
                            </span>
                            </a>
                        </li>
                        <li class="start active ">
                            <a href="reports.php">
                            <i class="fa fa-file"></i>
                            <span class="title">
                                Reports
                            </span>
                            <span class="selected">
                            </span>
                            </a>
                        </li>

                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content-wrapper">
                <div class="page-content">';
        echo $header;
    }

    function get_footer(){
        $footer = '</div>
            </div>
        </div>
        <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="footer">
        <div class="footer-inner">
             2013 &copy; Krafts Restore.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="assets/scripts/zebra_datepicker.js"></script>
        ';

        $footer .= '
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/scripts/app.js" type="text/javascript"></script>
        <script src="assets/scripts/custom.js" type="text/javascript"></script>
        <script src="assets/scripts/tasks.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- APPLICATION JS FILES -->
        <link rel="stylesheet" href="css/datatables.css" />
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/global.js" type="text/javascript"></script>
        <!-- END APPLICATION JS FILES -->
        <script>
        jQuery(document).ready(function() {    
           App.init(); // initlayout and core plugins
           Custom.init();
           '.(($login_page) ? 'Login.init();' : '').'
        });
        </script>
        <!-- END JAVASCRIPTS -->
        </body>
        <!-- END BODY -->
        </html>';
        echo $footer;

    }
    public function get_header_desktop(){
        $header = '<meta charset="utf-8">
		<title>Krafts Restore</title>
                <link rel="stylesheet" href="css/datatables_jui.css" />
                <link rel="stylesheet" href="css/pepper-grinder/jquery-ui-1.10.3.custom.min.css" />
		        <script src="js/jquery.min.js"></script>
                <script src="js/jquery.dataTables.min.js"></script>
                <script src="js/jquery-ui-1.10.3.custom.min.js"></script>';
        echo $header;
    }
    
    
}

include 'classes/dbhelper.class.php';
include 'classes/customers.class.php';
include 'classes/receivables.class.php';
include 'classes/users.class.php';

$dbhelper = new DBHelper($db_params);

$c_customers = new Customers($db_params);

$r_receivables = new Receivables($db_params);

$k_users = new Users($db_params);

$main = new main();

?>