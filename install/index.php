<?php


?>
<html>
<head>


</head>
<body style="background-color: grey">

<br />
<br />
<center><div style="background-color: white; width:50%">
<br /><br />
<h3>Install Setup Guide</h3>
<hr>
<br />
<form method="post" name="install" action="install.php">
<b>Database Information</b>
<table cellpadding="2" cellspacing="0" border="0" style="width: 90%">
<tr>
	<td align="right">Database Host</td>
	<td><input type="text" name="db_host" id="db_host" /></td>
</tr>
<tr>
	<td align="right">Database Name</td>
	<td><input type="text" name="db_name" id="db_name" /></td>
</tr>
<tr>
	<td align="right">Database User</td>
	<td><input type="text" name="db_user" id="db_user" /></td>
</tr>
<tr>
	<td align="right">Database Password</td>
	<td><input type="password" name="db_pass" id="db_pass" /></td>
</tr>
</table>
<br />
<br />
<hr>
<b>Admin User Information</b>
<table cellpadding="2" cellspacing="0" border="0" style="width: 90%">
<tr>
	<td align="right">Username</td>
	<td><input type="text" name="db_host" id="db_host" /></td>
</tr>
<tr>
	<td align="right">Password</td>
	<td><input type="text" name="db_name" id="db_name" /></td>
</tr>
<tr>
	<td align="right">Confirm Password</td>
	<td><input type="text" name="db_user" id="db_user" /></td>
</tr>
<tr>
	<td align="right"></td>
	<td><input type="submit" name="submit" id="submit" value="Install" /></td>
</tr>
</table>
</form>
<br />
<br />
<br />
</div>

</body>

<html>