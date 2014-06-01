<?php
require("config/main.php");

$main->get_header(); 

$years = [];
for($x=0;$x<4;$x++){
	$years[] = date("Y",strtotime("-$x year"));
}
sort($years);
$reports = [];
$reports[1] = [
	'title' 	=> 'Month Overview',
	'action'	=> 'report_month_overview.php',
	'tools'		=> [
		[
			'label' => 'Month',
			'type'	=> 'select',
			'name'	=> 'month',
			'options'	=> [
				'01','02','03','04','05','06','07','08','09','10','11','12'
			],
			'selected' => date("m",strtotime("-1 month"))
		],
		[
			'label'	=> 'Year',
			'type'	=> 'select',
			'name'	=> 'year',
			'options'	=> $years,
			'selected' => date("Y")
		]
	]

];

if(isset($_GET['id']) && count($reports)){

$report = $reports[$_GET['id']];
?>

<h3><?php echo $report['title']; ?></h3>

<form method="post" name="report_form" action="<?php echo $report['action']; ?>">
<table cellpadding="5" cellspacing="0" border="0" >
<?php 
foreach($report['tools'] as $tool){
?>
<tr>
<td><?php echo $tool['label']; ?></td>
<td>
	<?php
	if($tool['type'] == 'select'){
		echo '<select name="'.$tool['name'].'">';
		$selected = '';
		if(isset($tool['selected'])){
			$selected = $tool['selected'];
		}
		foreach($tool['options'] as $option){
			$s = '';
			if($option == $selected){
				$s = 'selected';
			}
			echo '<option '.$s.'>'.$option.'</option>';
		}
		echo '</select>';
	}
	?>

</td>
</tr>
<?php } ?>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Generate Report" /></td>
</tr>



</table>
</form>
<?php } ?>

<?php $main->get_footer(); ?>