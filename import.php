<?php
require("main.php");
ini_set("auto_detect_line_endings", "1");
$dir = 'imports';
$files1 = scandir($dir);

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

if(count($files1) > 2){
  foreach($files1 as $file){
    $row = 1;
    if (($handle = fopen("imports/".$file, "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
            $num = count($data);
            //echo "<tr>";

            $customer_name    = trim($data[0]);
            $address      = trim($data[1]);
            $city_zip       = trim($data[2]);
            $phone        = trim($data[3]);
            $fax        = trim($data[4]);
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

            //import process
            // check if customer name already exists.  If it does grab id. if not insert.
            // check if location for customer exists.  if it does grab id. if not insert.
            // insert into receivables with customer_id

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
              if(!$deposit){ $deposit = 0.00; }
              if(!$total){ $total = 0.00; }
              if(!$complete){ $complete = 0.00; }
              if($pickup_date){ $pickup_date = date("Y-m-d H:i:s",strtotime($pickup_date)); } else { $pickup_date = NULL; }
              if($delivery_date){ $delivery_date = date("Y-m-d H:i:s",strtotime($delivery_date)); } else { $delivery_date = NULL; }
              
            $rec_params = [
              'customer_id'       => $customer_id,
              'location_id'   => $location_id,
              'deposit'     => $deposit,
              'total'             => $total,
              'complete'      => $complete,
              'pickup_date'   => $pickup_date,
              'delivery_date'     => $delivery_date
            ];
            $rec_check = $c_customers->get_receivable_check($rec_params);
            if(!$rec_check){
                $receiveble_id = $c_customers->create_receivable($rec_params);
                $imported_receive++;
            } else {
              $already_receive++;
            }
          
          }

          
          }
        /*
            echo '<td>'.$customer_name.'</td>';
            echo '<td>'.$address.'</td>';
            echo '<td>'.$city.'</td>';
            echo '<td>'.$zip.'</td>';
            echo '<td>'.$phone.'</td>';
            echo '<td>'.$fax.'</td>';
            echo '<td>'.$pickup_date.'</td>';
            echo '<td>'.$deposit.'</td>';
            echo '<td>'.$delivery_date.'</td>';
            echo '<td>'.$total.'</td>';
            echo '<td>'.$complete.'</td>';
            */

            /*
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo '<td>'.$data[$c] . "</td>";
            }
            */
            //echo '</tr>';
        }
        fclose($handle);
    }
  }

  //echo '</table>';

  foreach($files1 as $file){
    if($file != '.' && $file != '..'){
      echo "Imported: ".$file."<br />";
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
