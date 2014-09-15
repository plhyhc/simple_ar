<?php
require("config/main.php");

$main->get_header(); 
?>
<div id="main_wrapper" class="ui-widget-content">
<h3 class="ui-widget-header">Customers</h3>
<a href="customers_add.php">Add New Customer</a>
<?php
if(isset($_GET['message'])){
  ?>
  <div style="border: 1px solid #04B404; background-color: #BCF5A9; padding: 15px; color: #0B6121;" id="message_div">
    <?php echo $_GET['message']; ?>
    
    </div>
    <script type="text/javascript">
    window.onload = function(){
      setTimeout("$( '#message_div' ).fadeOut( 'slow' )",5000);
    }
    </script>
  <?php
}

?>
<div class="dataTables_wrapper form-inline">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover dataTable" id="customers_list">
<thead>
  <tr>
    <th>Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Zip</th>
    <th>Phone</th>
    <th>Cell</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody>
  <?php
  $customers_list = $c_customers->get_customer_list();
  foreach($customers_list as $customer){
    echo '<tr>
      <td>'.$customer['name'].'</td>
      <td>'.$customer['address'].'</td>
      <td>'.$customer['city'].'</td>
      <td>'.$customer['zip'].'</td>
      <td>'.$customer['phone'].'</td>
      <td>'.$customer['fax'].'</td>
      <td><a href="customers_edit.php?id='.$customer['id'].'">Edit</a> | <a href="receivables_add.php?id='.$customer['id'].'&location_id='.$customer['location_id'].'">Add Receivable</a></td>
    </tr>';
  }
  ?>
  </tbody>
  </table>  
  </div>                  
</div>  

<div id="dialog-edit-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" title="Edit Customer">
    <div id="edit_customer_div" style="overflow-x: auto;"></div>
</div>  
<?php $main->get_footer(); ?>
