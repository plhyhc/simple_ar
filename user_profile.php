<?php
require("config/main.php");

$main->get_header(); 
?>

<h3>User Profile</h3>

<?php
if(isset($_GET['message'])){
	echo '<b style="color: orange;">'.$_GET['message'].'</b>';
}
?>
<br />
<hr>
<form method="post" name="new_pass" action="change_password.php" onsubmit="return Custom.valide_pass();">
<b>Change Password</b>
<table cellpadding="2" cellspacing="0" border="0">
<tr>
	<td>New Password:</td>
	<td><input type="password" name="new_pass" id="new_pass" /></td>
</tr>
<tr>
	<td>Confirm Password:</td>
	<td><input type="password" name="confirm_pass" id="confirm_pass" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="submit" value="Change Password" /></td>
</tr>
</table>
</form> 
			
<?php $main->get_footer(); ?>