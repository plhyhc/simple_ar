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

if(in_array('<un_set>',$db_params)){
    header("Location: install.php");
    die();
}


class main {

    public function get_header(){
        $header = file_get_contents('template/header.html');
        echo $header;
    }

    function get_footer(){
        $footer = file_get_contents('template/footer.html');
        echo $footer;

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