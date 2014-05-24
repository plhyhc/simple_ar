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
<div class="content">
<form class="login-form" action="index.html" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-error display-hide">
			<button class="close" data-close="alert"></button>
			<span>
				 Enter any username and password.
			</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label>
			<button type="submit" class="btn btn-info pull-right">
			Login </button>
		</div>
		<div class="forget-password">
			<h4>Forgot your password ?</h4>
			<p>
				 no worries, click <a href="javascript:;" id="forget-password">here</a>
				to reset your password.
			</p>
		</div>
		<div class="create-account">
			<p>
				 Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">Create an account</a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>
			
<?php $main->get_footer(); ?>