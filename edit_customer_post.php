<?php

require("config/main.php");

$type = $_POST['type'];
$message = "";
//die($_POST['customer_name']);
if($type == 'save'){
	$customer_id = $_POST['customer_id'];
	$customer_name = addslashes($_POST['customer_name']);
	$customer_email = $_POST['customer_email'];
	//die(print_r($_POST));
	$c_params = ['executes' => [
			'name' => $customer_name,
			'email' => $customer_email
		], 
		'where' => ['id' => $customer_id],
		'table' => 'customers'
	];
	//die(print_r($params));
	$c_customers->update_customer($c_params);
	unset($c_params);
	$location_ids = $_POST['location_id'];
	$customer_address = $_POST['customer_address'];
	$customer_city = $_POST['customer_city'];
	$customer_zip = $_POST['customer_zip'];
	$customer_phone = $_POST['customer_phone'];
	$customer_fax = $_POST['customer_fax'];
	for($x=0;$x<count($location_ids);$x++){
		if($location_ids[$x]){
			//update existing

			$l_params = ['executes' => [
					'address' 		=> $customer_address[$x],
					'city'			=> $customer_city[$x],
					'zip'			=> $customer_zip[$x],
					'phone'			=> $customer_phone[$x],
					'fax'			=> $customer_fax[$x],
				], 
				'where' => ['id' => $location_ids[$x]],
				'table' => 'locations'
			];
			$dbhelper->update($l_params);
			unset($l_params);

		} else {
			//add new location, if variable exist
			if($customer_address[$x] || $customer_city[$x] || $customer_zip[$x] || $customer_phone[$x] || $customer_fax[$x]){
        		 $loc_params = [
	             	'address' 		=> $customer_address[$x],
					'city'			=> $customer_city[$x],
					'zip'			=> $customer_zip[$x],
					'phone'			=> $customer_phone[$x],
					'fax'			=> $customer_fax[$x],
					'customer_id'	=> $customer_id
	            ];
	            $location_id = $c_customers->create_location($loc_params);
			}
		}

	}

	$message = "Customer Information Saved";
	header("Location: customers_edit.php?id=".$customer_id."&message=".$message);
	die();

} else if($type == 'remove_location'){
	$location_id = $_POST['location_id'];
    	$params = ['executes' => [
				'deleted' => TRUE
			], 
			'where' => ['id' => $location_id],
			'table' => 'locations'
		];
		$dbhelper->update($params);

    	$message = "Customer Location Removed";
} else if($type == 'remove_customer'){
	$customer_id = $_POST['customer_id'];
	//remove customer
	$params = ['executes' => [
			'deleted' => TRUE
		], 
		'where' => ['id' => $customer_id],
		'table' => 'customers'
	];
	$dbhelper->update($params);
	//remove locations
	$params = ['executes' => [
			'deleted' => TRUE
		], 
		'where' => ['customer_id' => $customer_id],
		'table' => 'locations'
	];
	$dbhelper->update($params);

    	header("Location: customers.php?message=Customer Removed");
    	die();

} else if ($type == 'add'){
	$already_exists = false;
	$customer_name = $_POST['customer_name'];
	$customer_email = $_POST['customer_email'];
	$customer_address = $_POST['customer_address'];
	$customer_city = $_POST['customer_city'];
	$customer_zip = $_POST['customer_zip'];
	$customer_phone = $_POST['customer_phone'];
	$customer_fax = $_POST['customer_fax'];

	$customer_id = $c_customers->getby_name($customer_name);
    if($customer_id){
      	$already_exists = true;
      	header("Location: customers_edit.php?id=".$customer_id."&message=Customer Already Exists: ".$customer_name);
      	die();
  	} else {
		$params = ['name' => $customer_name,'email' => $customer_email];
    	$customer_id = $c_customers->create_customer($params);
	}

    if($customer_id){
		$params = [
          'address'   => $customer_address,
          'city'    => $customer_city,
          'phone'   => $customer_phone
        ];
      $location_id = $c_customers->get_location_check($params);
      if(!$location_id){
		$loc_params = [
	      'customer_id'   => $customer_id,
	      'address'   => $customer_address,
	      'city'      => $customer_city,
	      'zip'     => $customer_zip,
	      'phone'     => $customer_phone,
	      'fax'     => $customer_fax
	    ];
	    $location_id = $c_customers->create_location($loc_params);
	  }

	    $pickup_date = ($_POST['pickup_date']) ? date("Y-m-d",strtotime($_POST['pickup_date'])) : null;
		$delivery_date = ($_POST['delivery_date']) ? date("Y-m-d",strtotime($_POST['delivery_date'])) : null;
		$deposit = ($_POST['deposit']) ? $_POST['deposit'] : "0.0";
		$total = ($_POST['total']) ? $_POST['total'] : "0.0";
		$complete = ($_POST['complete']) ? $_POST['complete'] : "0.0";
		$invoice_number = ($_POST['invoice_number']) ? $_POST['invoice_number'] : "0";

		$rec_params = [
	      'customer_id'       => $customer_id,
	      'location_id'   	=> $location_id,
	      'deposit'     	=> number_format($deposit,2,'.',''),
	      'total'             => number_format($total,2,'.',''),
	      'complete'      => number_format($complete,2,'.',''),
	      'pickup_date'   => $pickup_date,
	      'delivery_date'     => $delivery_date,
	      'invoice_number'	=> $invoice_number
	    ];
	    $has_content = false;
	    foreach($rec_params as $key => $value){
	    	if($value && $value > '0.0' && ($key != 'customer_id' && $key != 'location_id')){
	    		$has_content = true;
	    	}
	    }
	    if($has_content){
	    	$receiveble_id = $r_receivables->create_receivable($rec_params);
		}

	  header("Location: customers.php?message=Customer Added: ".$customer_name);
    	die();
	}


}



?>