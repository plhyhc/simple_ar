<?php
require("main.php");

$main->get_header(); 

$customer_id = $_GET['id'];
$location_id = $_GET['location_id'];

$customer_info = $c_customers->get_customer($customer_id);

$location_info = $r_receivables->get_locations_byid($location_id);


?>
<div id="main_wrapper" class="ui-widget-content">
<h3 class="ui-widget-header">Add Receivables</h3>

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
<form name="receivables_form" id="receivables_form" action="receivables_post.php" method="post">
<table cellpadding="2" cellspacing="0" border="0" width="100%">
  <tr>
    <td>Customer</td>
    <td><?php echo $customer_info[0]['name']; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $customer_info[0]['email']; ?></td>
  </tr>

  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <?php foreach($location_info as $li){ 
    if($li['id'] == $location_id) { ?>
  <tr>
    <td colspan="2"><?php echo $li['address']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $li['city']; echo (($li['city'] && $li['zip']) ? ", " : " "); echo $li['zip']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $li['phone']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <?php }} ?>
  <tr>
    <td style="text-align: right;">Pickup Date</td>
    <td><input type="text" name="pickup_date" id="pickup_date" size="20" data-beatpicker="true" data-beatpicker-module="today" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Delivery Date</td>
    <td><input type="text" name="delivery_date" id="delivery_date" size="20" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Deposit</td>
    <td><input type="text" name="deposit" id="deposit" size="25" onkeyup="Custom.rec_fields(this)" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Total</td>
    <td><input type="text" name="total" id="total" size="25" onkeyup="Custom.rec_fields(this)" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Complete</td>
    <td><input type="text" name="complete" id="complete" size="25" onkeyup="Custom.rec_fields(this)" /></td>
  </tr>

  <tr>
    <td colspan="2"><hr><input type="hidden" name="location_id" value="<?php echo $location_id; ?>" />
    <input type="hidden" name="type" value="add" />
    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Create Receivables" /></td>
    </tr>
</table>
</form>


<?php $main->get_footer(); ?>
