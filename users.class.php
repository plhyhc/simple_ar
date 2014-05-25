<?php

class Users {

	public $krdb = '';

	function __construct($bdb){
		$this->krdb = $bdb;
	}

	function login_process($params){
		$user_id = '';
		$sql = "SELECT id FROM users 
	        WHERE username = '{$params['username']}'
	        	AND password = '{$params['password']}'
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $user_id = $row['id'];     
	    }
	    return $user_id;
	}

}
