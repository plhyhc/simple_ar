<?php

class Customers extends DBHelper{


	function __construct($db_params){
		parent::__construct($db_params);
	}

	function getby_name($customer_name){
		$customer_id = '';
		$sql = "SELECT id FROM customers 
	        WHERE name = '$customer_name' and deleted is null
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $customer_id = $row['id'];     
	    }
	    return $customer_id;
	}


	function create_customer($params){
		$insert_params = [];
		$insert_params['table'] = 'customers';
		$insert_params['executes'] = $params;
		return $this->insert_into($insert_params);
	}

	function create_location($params){
		$insert_params = [];
		$insert_params['table'] = 'locations';
		$insert_params['executes'] = $params;
		return $this->insert_into($insert_params);
	}

	function update_customer($params){
		return $this->update($params);
	}

	function get_location_check($params){
		$location_id = '';
		$sql = "SELECT id FROM locations 
	        WHERE address = '{$params['address']}'
	        AND city = '{$params['city']}'
	        AND phone = '{$params['phone']}'
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $location_id = $row['id'];     
	    }
	    return $location_id;
	}

	
	
	function get_receivable_check($params){
		$receivable_id = '';
		if(isset($params['pickup_date'])){ $pickup_date = "= '".$params['pickup_date']."'"; } else { $pickup_date = 'IS NULL';}
		if(isset($params['delivery_date'])){ $delivery_date = "= '".$params['delivery_date']."'"; } else { $delivery_date = 'IS NULL';}
		$sql = "SELECT id FROM receivables 
	        WHERE customer_id = '{$params['customer_id']}'
	        AND location_id = '{$params['location_id']}'
	        AND deposit = '{$params['deposit']}'
	        AND total = '{$params['total']}'
	        AND complete = '{$params['complete']}'
	        AND pickup_date $pickup_date
	        AND delivery_date $delivery_date
	        ";
	        //die($sql);
	    foreach ($this->krdb->query($sql) as $row) { 
	         $receivable_id = $row['id'];     
	    }
	    return $receivable_id;
	}

	function get_customer_list(){
		$sql = "SELECT c.id,
						l.id as location_id,
						c.name,
						l.address,
						l.city,
						l.zip,
						l.phone,
						l.fax
			 FROM customers c
			 LEFT JOIN locations l on l.customer_id = c.id
			 WHERE l.deleted is not true and c.deleted is not true
			 GROUP BY c.name,l.address,l.city,l.zip,l.phone,l.fax
			 Order by c.name
	        ";
	    return $this->krdb->query($sql);
	}

	function get_customer($id){
		$sql = "SELECT c.id,
						c.name,
						c.email
			 FROM customers c
			 WHERE c.id = '$id'
	        ";
	        $return = [];
	        foreach($this->krdb->query($sql) as $row){
	        	$return[] = $row;
	        }
	        return $return;
	}

	function get_locations_bycid($customer_id){
		$sql = "SELECT id,address,city,zip,phone,fax
			 FROM locations
			 WHERE customer_id = '$customer_id' and deleted is not true
	        ";
	    	$return = [];
	        foreach($this->krdb->query($sql) as $row){
	        	$return[] = $row;
	        }
	        return $return;
	}


}


?>