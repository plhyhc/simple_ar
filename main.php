<?php
session_start();
/*
$not_logged_in = false;
if(!isset($_SESSION['logged_in'])){
    $not_logged_in = true;
} else if($_SESSION['logged_in'] != '123kjdn43kj3nskdj'){
    $not_logged_in = true;
}
if($not_logged_in){
    echo 'login page';
    //header("Location: /kraftsrestore/login.php");
    die();
}
*/


date_default_timezone_set('America/Los_Angeles');

$bdb = new PDO(
    'mysql:host=localhost;dbname=my_database',
    'db_username',
    '');
$bdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


class main {
    
    
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

include 'customers.class.php';
include 'receivables.class.php';

$c_customers = new Customers($bdb);

$r_receivables = new Receivables($bdb);

$main = new main();

?>