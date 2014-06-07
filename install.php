<?php
if(!is_writable('config/config.php')){
	die("The 'config/config.php' file is not writeable.  Please change this before proceeding.");
}

$config_file = file_get_contents("config/config.php");
if(!strpos($config_file,'<un_set>')){
	header("Location: index.php");
	die();
}

if(isset($_POST['db_host'])){
	$db_host = (isset($_POST['db_host'])) ? $_POST['db_host'] : die("DB Host is required.  Please go back and fill in.");
	$db_name = (isset($_POST['db_name'])) ? $_POST['db_name'] : die("DB Name is required.  Please go back and fill in.");
	$db_user = (isset($_POST['db_user'])) ? $_POST['db_user'] : die("DB Username is required.  Please go back and fill in.");
	$db_pass = (isset($_POST['db_pass'])) ? $_POST['db_pass'] : die("DB Password is required.  Please go back and fill in.");
	$username = (isset($_POST['username'])) ? $_POST['username'] : die("Admin Username is required.  Please go back and fill in.");
	$password = (isset($_POST['password'])) ? $_POST['password'] : die("Admin Password is required.  Please go back and fill in.");
	$confirmpassword = (isset($_POST['confirmpassword'])) ? $_POST['confirmpassword'] : die("Admin Confirm Password is required.  Please go back and fill in.");

	if($password != $confirmpassword){
		die("The Admin password and Admin confirm password do not match.  Please go back and fix.");
	}

	$config_file = str_replace("'db_name' => '<un_set>',","'db_name' => '$db_name',",$config_file);
	$config_file = str_replace("'db_host' => '<un_set>',","'db_host' => '$db_host',",$config_file);
	$config_file = str_replace("'db_user' => '<un_set>',","'db_user' => '$db_user',",$config_file);
	$config_file = str_replace("'db_pass' => '<un_set>'","'db_pass' => '$db_pass'",$config_file);

	file_put_contents("config/config.php", $config_file);
	$login_page = true;
	require("config/main.php");

	$sql = file_get_contents('install/install.sql');
	if($sql){
		$dbhelper->create_db($sql);
	} else {
		die("File: install.sql is missing or empty.");
	}

	$pre_salt = md5($password);
	$salted = md5($pre_salt.$salt);

	$params = [
		'username' => $username,
		'password' => $salted,
		'date_added' => date("Y-m-d H:i:s")
		];
	$k_users->create_user($params);

	header("Location: login.php");
	die();
}



?>
<html>
<head>

<style>
    .shadow {
	  -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
	}
</style>
</head>
<body style="background-color: grey">

<br />
<br />
<center><div style="background-color: white; width:50%" class="shadow">
<br /><br />
<h3>Install Setup Guide</h3>
<hr>
<br />
<form method="post" name="install" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
	<td><input type="text" name="username" id="username" /></td>
</tr>
<tr>
	<td align="right">Password</td>
	<td><input type="password" name="password" id="password" /></td>
</tr>
<tr>
	<td align="right">Confirm Password</td>
	<td><input type="password" name="confirmpassword" id="confirmpassword" /></td>
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