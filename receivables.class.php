<?php

class Receivables {

	public $krdb = '';

	function __construct($bdb){
		$this->krdb = $bdb;
	}

	function getby_name($customer_name){
		$customer_id = '';
		$sql = "SELECT id FROM customers 
	        WHERE name = '$customer_name'
	        ";
	    foreach ($this->krdb->query($sql) as $row) { 
	         $customer_id = $row['id'];     
	    }
	    return $customer_id;
	}

	function create_customer($params){
		$sql_columns = '';
		$sql_column_binds = '';
		foreach(array_keys($params['executes']) as $column){
			$sql_columns .= $column.',';
			$sql_column_binds .= ':'.$column.',';
		}
		$sql_columns = substr($sql_columns,0,-1);
		$sql_column_binds = substr($sql_column_binds,0,-1);
		$sql = "INSERT INTO customers ($sql_columns) VALUES ($sql_column_binds)";
        $stmt = $this->krdb->prepare ($sql);
        $stmt -> execute($params['executes']);
        $customer_id = $this->krdb->lastInsertId(); 
        $stmt->closeCursor();
        unset($stmt);
        return $customer_id;
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

	function create_location($params){
		$sql_columns = '';
		$sql_column_binds = '';
		foreach(array_keys($params) as $column){
			$sql_columns .= $column.',';
			$sql_column_binds .= ':'.$column.',';
		}
		$sql_columns = substr($sql_columns,0,-1);
		$sql_column_binds = substr($sql_column_binds,0,-1);
		$sql = "INSERT INTO locations ($sql_columns) VALUES ($sql_column_binds)";
        $stmt = $this->krdb->prepare ($sql);
        $stmt -> execute($params);
        $location_id = $this->krdb->lastInsertId(); 
        $stmt->closeCursor();
        unset($stmt);
        return $location_id;
	}
	
	function create_receivable($params){
		$sql_columns = '';
		$sql_column_binds = '';
		foreach(array_keys($params) as $column){
			$sql_columns .= $column.',';
			$sql_column_binds .= ':'.$column.',';
		}
		$sql_columns = substr($sql_columns,0,-1);
		$sql_column_binds = substr($sql_column_binds,0,-1);
		$sql = "INSERT INTO receivables ($sql_columns) VALUES ($sql_column_binds)";
        $stmt = $this->krdb->prepare ($sql);
        $stmt -> execute($params);
        $receivable_id = $this->krdb->lastInsertId(); 
        $stmt->closeCursor();
        unset($stmt);
        return $receivable_id;
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

	function get_receivables_list(){
		$sql = "SELECT c.id,
						l.id as location_id,
						c.name,
						l.address,
						l.city,
						l.zip,
						l.phone,
						l.fax,
						r.pickup_date,
						r.delivery_date,
						r.deposit,
						r.total,
						r.complete,
						r.date_added
			 FROM receivables r
			 LEFT JOIN customers c on c.id = r.customer_id
			 LEFT JOIN locations l on l.customer_id = c.id
			 WHERE l.deleted is not true and c.deleted is not true
			 Order by r.date_added desc
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

	function get_locations_byid($location_id){
		$sql = "SELECT id,address,city,zip,phone,fax
			 FROM locations
			 WHERE id = '$location_id' and deleted is not true
	        ";
	    	$return = [];
	        foreach($this->krdb->query($sql) as $row){
	        	$return[] = $row;
	        }
	        return $return;
	}


}


?>