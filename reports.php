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
			<h3>Reports</h3>

			<small>Please request the reports you would like to see.</small>
<?php $main->get_footer(); ?>