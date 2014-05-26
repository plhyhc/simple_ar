<?php
require("config/main.php");

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
<form name="add_customer_form" id="add_customer_form" action="edit_customer_post.php" method="post">
<table cellpadding="2" cellspacing="0" border="0" width="100%">
  <tr>
    <td>Customer</td>
    <td><input type="text" name="customer_name" id="customer_name"  size="40" /> </td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="customer_email" id="customer_email"  size="45" /></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <tr>
    <td colspan="2"><h3>Location</h3></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="customer_address" id="customer_address" size="45" /></td>
  </tr>
  <tr>
    <td>City / Zip</td>
    <td><input type="text" name="customer_city" id="customer_city" size="30" /> <input type="text" name="customer_zip" id="customer_zip" size="10" /></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input type="text" name="customer_phone" id="customer_phone" size="45" /></td>
  </tr>
  <tr>
    <td>Fax</td>
    <td><input type="text" name="customer_fax" id="customer_fax" size="45" /></td>
  </tr>
  <tr>
    <td colspan="2"><hr>
    <input type="hidden" name="type" value="add" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Create Customer" /></td>
    </tr>
</table>
</form>


<?php $main->get_footer(); ?>
