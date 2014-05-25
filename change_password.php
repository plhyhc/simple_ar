<?php
require("main.php");

$message = "New Password was not supplied";
if(isset($_POST['new_pass'])){

	if($_POST['new_pass'] == $_POST['confirm_pass']){
		$pre_salt = md5($_POST['new_pass']);
		$salted = md5($pre_salt.$salt);
		$sql = "UPDATE users SET 
				password = :password
			WHERE id = '{$_SESSION['user_id']}'";
	        $stmt = $bdb->prepare ($sql);
	        $stmt -> bindParam(':password', $salted);
	        $stmt -> execute();
	        $stmt->closeCursor();
        	unset($stmt);
        	$message = "Password successfully updated.";
	} else {
		$message = "New Password and Confirm password do not match.";
	}

}
header("Location: user_profile.php?message=".$message);
