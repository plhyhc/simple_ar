<?php

require("config/main.php");

$type = $_POST['type'];
$message = "";

if($type == 'save'){
	$already_exists = false;
	$id = $_POST['id'];
	$pickup_date = ($_POST['pickup_date']) ? date("Y-m-d",strtotime($_POST['pickup_date'])) : null;
	$delivery_date = ($_POST['delivery_date']) ? date("Y-m-d",strtotime($_POST['delivery_date'])) : null;
	$deposit = ($_POST['deposit']) ? $_POST['deposit'] : "0.0";
	$total = ($_POST['total']) ? $_POST['total'] : "0.0";
	$complete = ($_POST['complete']) ? $_POST['complete'] : "0.0";
	$invoice_number = ($_POST['invoice_number']) ? $_POST['invoice_number'] : "0";


    $c_params = ['executes' => [
				'deposit'     	=> number_format($deposit,2,'.',''),
				'total'             => number_format($total,2,'.',''),
				'complete'      => number_format($complete,2,'.',''),
				'pickup_date'   => $pickup_date,
				'delivery_date'     => $delivery_date,
				'invoice_number'	=> $invoice_number
		], 
		'where' => ['id' => $id],
		'table' => 'receivables'
	];

    $receiveble_id = $r_receivables->update_receivable($c_params);


	  header("Location: receivables.php?message=Updated Successfully");
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

	$location_id = $_POST['location_id'];
	$customer_id = $_POST['customer_id'];
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

    $receiveble_id = $r_receivables->create_receivable($rec_params);


	  header("Location: receivables.php?message=Added New Successfully");
    	die();
	


}



?>