<?php
require("main.php");

$current_month = date("n",time());
$current_year = date("Y",time());
if($_GET){
    $current_month = $_GET['month'];
    $current_year = $_GET['year'];
}
$net_amount = array();
$savings_net_amount = array();
$main->get_header(); 

$customer_id = $_GET['id'];

$customer_info = $c_customers->get_customer($customer_id);

$location_info = $c_customers->get_locations_bycid($customer_id);


?>
<div id="main_wrapper" class="ui-widget-content">
<h3 class="ui-widget-header">Customers</h3>

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
<br /><br />
<form name="edit_customer_form" id="edit_customer_form" action="edit_customer_post.php" method="post">
<table cellpadding="2" cellspacing="0" border="0" width="100%">
  <tr>
    <td>Customer</td>
    <td><input type="text" name="customer_name" id="customer_name" value="<?php echo $customer_info[0]['name']; ?>" size="40" /> <a href="javascript:void(0);" onclick="return Custom.remove_customer('<?php echo $customer_id; ?>');" style="font-size: 11px;">Delete Customer</a></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="customer_email" id="customer_email" value="<?php echo $customer_info[0]['email']; ?>" size="45" /></td>
  </tr>
  <tr>
    <td colspan="2"><small>(Note: the changes you make in this window are saved once the "Save" button at the bottom is clicked.)</small></td>
  </tr>
  <tr>
    <td colspan="2"><hr><input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" /></td>
  </tr>
  <?php foreach($location_info as $li){ ?>
  <tr>
    <td>Address</td>
    <td><input type="text" name="customer_address[]" id="customer_address" value="<?php echo $li['address']; ?>" size="45" /></td>
  </tr>
  <tr>
    <td>City / Zip</td>
    <td><input type="text" name="customer_city[]" id="customer_city" value="<?php echo $li['city']; ?>" size="30" /> <input type="text" name="customer_zip[]" id="customer_zip" value="<?php echo $li['zip']; ?>" size="10" /></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="text" name="customer_phone[]" id="customer_phone" value="<?php echo $li['phone']; ?>" size="45" /></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><input type="text" name="customer_fax[]" id="customer_fax" value="<?php echo $li['fax']; ?>" size="45" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><a href="javascript:void(0);" onclick="return Custom.remove_location('<?php echo $li['id']; ?>','<?php echo $customer_id; ?>');" style="font-size: 11px;">Remove Location</a></td>
  </tr>
  <tr>
    <td colspan="2"><hr><input type="hidden" name="location_id[]" value="<?php echo $li['id']; ?>" /></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2"><h3>New Location</h3></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="customer_address[]" id="customer_address" size="45" /></td>
  </tr>
  <tr>
    <td>City / Zip</td>
    <td><input type="text" name="customer_city[]" id="customer_city" size="30" /> <input type="text" name="customer_zip[]" id="customer_zip" size="10" /></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="text" name="customer_phone[]" id="customer_phone" size="45" /></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><input type="text" name="customer_fax[]" id="customer_fax" size="45" /></td>
  </tr>
  <tr>
    <td colspan="2"><hr><input type="hidden" name="location_id[]" />
    <input type="hidden" name="type" value="save" />
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Save" /></td>
    </tr>
</table>
</form>


<?php $main->get_footer(); ?>
