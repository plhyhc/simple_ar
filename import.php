<?php
require("config/main.php");
ini_set("auto_detect_line_endings", "1");

$dir = '';
$check_count = 0;

if(isset($_FILES['file_upload']['tmp_name'])){
  $files1[] = $_FILES['file_upload']['tmp_name'];
  $files_names[] = $_FILES['file_upload']['name'];
  $check_count = 0;
} else {
  $dir = 'imports/';
  $files1 = scandir($dir);
  $files_names = $files1;
}
foreach($files1 as $k => $f){
  if(in_array($f,['.','..','.DS_Store'])){
    unset($files1[$k]);
  }
}

$main->get_header(); 


function clean_number($var){
    $var = trim($var,'.');
    return str_replace(",","",$var);
}
$imported_customer = 0;
$imported_location = 0;
$already_customer = 0;
$already_location = 0;
$already_receive = 0;
$imported_receive = 0;

if(count($files1) > $check_count){
  foreach($files1 as $file){
    $row = 1;
    if (($handle = fopen($dir.$file, "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
            $num = count($data);

            $customer_name    = trim($data[0]);
            $address      = trim($data[1]);
            $city_zip       = trim($data[2]);
            $phone        = trim($data[3]);
            $fax        = trim($data[4]);
            $invoice_num = trim($data[5]);
            $pickup_date    = trim($data[6]);
            $deposit      = clean_number(trim($data[7]));
            $delivery_date    = clean_number(trim($data[8]));
            $total        = clean_number(trim($data[9]));
            $complete     = clean_number(trim($data[10]));

            $zip = ($city_zip) ? substr($city_zip, -5) : '';
            $zip = (is_numeric($zip)) ? $zip : '';

            $city = '';
            if($city_zip && is_numeric($zip)){
              $city = substr($city_zip,0,-5);
            }

            $already_exists = false;
            $customer_id = $c_customers->getby_name($customer_name);
            if($customer_id){
              $already_exists = true;
              $already_customer++;
            }

          if(!$already_exists){
            $params = ['executes' => ['name' => $customer_name]];
            $customer_id = $c_customers->create_customer($params);
            $imported_customer++;
          }
          
          if($customer_id){
            $params = [
              'address'   => ($address) ? $address : null,
              'city'    => ($city) ? $city : null,
              'phone'   => ($phone) ? $phone : null
            ];
          $location_id = $c_customers->get_location_check($params);
          if(!$location_id){
            $loc_params = [
              'customer_id'   => $customer_id,
              'address'   => $address,
              'city'      => $city,
              'zip'     => $zip,
              'phone'     => $phone,
              'fax'     => $fax
            ];
            $location_id = $c_customers->create_location($loc_params);
            $imported_location++;
          }
          if($location_id){
            $already_location++;
              if($deposit == ''){ $deposit = '0.00'; }
              if($total == ''){ $total = '0.00'; }
              if($complete == ''){ $complete = '0.00'; }
              if($pickup_date){ $pickup_date = date("Y-m-d",strtotime($pickup_date)); } else { $pickup_date = null; }
              if($delivery_date){ $delivery_date = date("Y-m-d",strtotime($delivery_date)); } else { $delivery_date = null; }
              
            $rec_params = [
              'customer_id'       => $customer_id,
              'location_id'       => $location_id,
              'deposit'           => $deposit,
              'total'             => $total,
              'complete'          => $complete,
              'pickup_date'       => $pickup_date,
              'delivery_date'     => $delivery_date
            ];
            //
            $rec_check = $c_customers->get_receivable_check($rec_params);
            if(!$rec_check){
              //die(print_r($rec_params));
                $receiveble_id = $c_customers->create_receivable($rec_params);
                $imported_receive++;
            } else {
              $already_receive++;
            }
          
          }          
          }

        }
        fclose($handle);
    }
  }

}
  ?>
  <h3>Import Files</h3>
  <small>Upload single files one by one, or place in "imports" folder to import multiple files</small>
  <br /><br />
  <form method="post" name="file_u" action="import.php" enctype="multipart/form-data">
  Single File Upload: <input type="file" name="file_upload" /><br />
  <input type="submit" name="submit" value="Upload" />
  </form>
  <br /><br />
<?php

if(count($files1) > $check_count){
?>
  <hr>
<h3>Import Results</h3>
  <?php
  foreach($files_names as $file){
    if($file != '.' && $file != '..'){
      echo "<b>Imported: ".$file."</b><br />";
    }
  }

  echo '<br />';

  echo 'Customers Already Exist: '.$already_customer. '<br /><br />';
  echo 'Customers Imported: '.$imported_customer.'<br /><br />';
  echo 'Locations Already Exist: '. $already_location.'<br /><br />';
  echo 'Locations Imported: '.$imported_location.'<br /><br />';
  echo 'Receivables Already Exist: '. $already_receive.'<br /><br />';
  echo 'Receivables Imported: '.$imported_receive.'<br /><br />';
}

$main->get_footer(); ?>
