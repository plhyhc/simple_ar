<?php

require("config/main.php");

$type = $_POST['type'];
$message = "";

if($type == 'save'){
	$customer_id = $_POST['customer_id'];
	$customer_name = $_POST['customer_name'];
	$customer_email = $_POST['customer_email'];

	$sql = "UPDATE customers SET 
				name = :name,
				email = :email
			WHERE id = '{$customer_id}'";
	        $stmt = $bdb->prepare ($sql);
	        $stmt -> bindParam(':name', $customer_name);
	        $stmt -> bindParam(':email', $customer_email);
	        $stmt -> execute();
	        $stmt->closeCursor();
        	unset($stmt);

	$location_ids = $_POST['location_id'];
	$customer_address = $_POST['customer_address'];
	$customer_city = $_POST['customer_city'];
	$customer_zip = $_POST['customer_zip'];
	$customer_phone = $_POST['customer_phone'];
	$customer_fax = $_POST['customer_fax'];

	for($x=0;$x<count($location_ids);$x++){
		if($location_ids[$x]){
			//update existing

			$sql = "UPDATE locations SET 
				address = :address,
				city = :city,
				zip = :zip,
				phone = :phone,
				fax = :fax
			WHERE id = '{$location_ids[$x]}'";
	        $stmt = $bdb->prepare ($sql);
	        $stmt -> bindParam(':address', $customer_address[$x]);
	        $stmt -> bindParam(':city', $customer_city[$x]);
	        $stmt -> bindParam(':zip', $customer_zip[$x]);
	        $stmt -> bindParam(':phone', $customer_phone[$x]);
	        $stmt -> bindParam(':fax', $customer_fax[$x]);
	        $stmt -> execute();
	        $stmt->closeCursor();
        	unset($stmt);

		} else {
			//add new location, if variable exist
			if($customer_address[$x] || $customer_city[$x] || $customer_zip[$x] || $customer_phone[$x] || $customer_fax[$x]){
				$params = [
					'address' 		=> $customer_address[$x],
					'city'			=> $customer_city[$x],
					'zip'			=> $customer_zip[$x],
					'phone'			=> $customer_phone[$x],
					'fax'			=> $customer_fax[$x],
					'customer_id'	=> $customer_id
				];
				$sql = "INSERT INTO locations (address,city,zip,phone,fax,customer_id) VALUES (:address,:city,:zip,:phone,:fax,:customer_id)";
		        $stmt = $bdb->prepare ($sql);
		        $stmt -> execute($params);
		        $stmt->closeCursor();
        		unset($stmt);
			}
		}

	}

	$message = "Customer Information Saved";
	header("Location: customers_edit.php?id=".$customer_id."&message=".$message);
	die();

} else if($type == 'remove_location'){
	$location_id = $_POST['location_id'];
	$del = TRUE;
	$sql = "UPDATE locations SET 
			deleted = :deleted
		WHERE id = '{$location_id}'";
        $stmt = $bdb->prepare ($sql);
        $stmt -> bindParam(':deleted', $del);
        $stmt -> execute();
        $stmt->closeCursor();
    	unset($stmt);
    	$message = "Customer Location Removed";
} else if($type == 'remove_customer'){
	$customer_id = $_POST['customer_id'];
	//remove customer
	$del = TRUE;
	$sql = "UPDATE customers SET 
			deleted = :deleted
		WHERE id = '{$customer_id}'";
        $stmt = $bdb->prepare ($sql);
        $stmt -> bindParam(':deleted', $del);
        $stmt -> execute();
        $stmt->closeCursor();
    	unset($stmt);

	//remove locations
	$del = TRUE;
	$sql = "UPDATE locations SET 
			deleted = :deleted
		WHERE customer_id = '{$customer_id}'";
        $stmt = $bdb->prepare ($sql);
        $stmt -> bindParam(':deleted', $del);
        $stmt -> execute();
        $stmt->closeCursor();
    	unset($stmt);
    	header("Location: customers.php?message=Customer Removed");
    	die();

} else if ($type == 'add'){
	$already_exists = false;
	$pickup_date = ($_POST['pickup_date']) ? date("Y-m-d",strtotime($_POST['pickup_date'])) : null;
	$delivery_date = ($_POST['delivery_date']) ? date("Y-m-d",strtotime($_POST['delivery_date'])) : null;
	$deposit = $_POST['deposit'];
	$total = $_POST['total'];
	$complete = $_POST['complete'];
	$location_id = $_POST['location_id'];
	$customer_id = $_POST['customer_id'];
	$invoice_number = $_POST['invoice_number'];

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

    $receiveble_id = $r_receivables->create_receivable($rec_params);


	  header("Location: receivables.php?message=Added New Successfully");
    	die();
	


}



?>