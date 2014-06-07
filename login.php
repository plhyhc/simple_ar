<?php
$login_page = true;
require("config/main.php");

$message = '';
if(isset($_POST['username'])){

	$username = $_POST['username'];
	$password = $_POST['password'];

	$pre_salt = md5($password);
	$salted = md5($pre_salt.$salt);
	$user_params = [
		'username' => $username,
		'password' => $salted
	];
	$_SESSION['user_id'] = $k_users->login_process($user_params);
	if($_SESSION['user_id']){
		$_SESSION['logged_in'] = '123kjdn43kj3nskdj';
		header("Location: index.php");
		die();
	} else {
		$message = "Login Failed.  Username / Password incorrect.";
	}
}
session_destroy();


?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Simple AR | Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

</head>
<body style="background-color: grey">

<br />
<br />
<center><div style="background-color: white; width:50%; ">
<br />
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="login.php" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"/>
			</div>
		</div>
		<div class="form-group">
			
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-info pull-right">
			Login </button>
		</div>
		<br /><br />
	</form>
	<!-- END LOGIN FORM -->
<?php
if($message){
	echo '<div style="color: red;">'.$message.'</div><br />';
}
?>
</center>
<br />
<br />
<br />
</div>

</body>
<!-- END BODY -->
</html>