<?php
require("main.php");

$current_month = date("n",time());
$current_year = date("Y",time());
if($_GET){
    $current_month = $_GET['month'];
    $current_year = $_GET['year'];
}
$net_amount = array();
$savings_net_amount = array();

$main->get_header(); 
?>
			
<?php $main->get_footer(); ?>