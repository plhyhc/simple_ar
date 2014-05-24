<?php

class Users {

	public $krdb = '';

	function __construct($bdb){
		$this->krdb = $bdb;
	}

	function login_process($params){
		$customer_id = '';
		$sql = "SELECT id FROM customers 
	        WHERE name = '$customer_name'
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $customer_id = $row['id'];     
	    }
	    return $customer_id;
	}

}
