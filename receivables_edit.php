<?php
require("config/main.php");

$main->get_header(); 

$recs = $r_receivables->get_receivables($_GET['id']);

?>
<div id="main_wrapper" class="ui-widget-content">
<h3 class="ui-widget-header">Receivables</h3>
<div class="dataTables_wrapper form-inline">
<form method="post" name="receivables_edit" action="receivables_post.php">
<table cellpadding="0" cellspacing="0" border="0" class="table" id="receivables_edit">

<tbody>
 <tr>
    <td style="text-align: right;">Invoice Number</td>
    <td><input type="text" name="invoice_number" id="invoice_number" size="25" onkeyup="Custom.rec_fields(this)" value="<?php echo $recs['0']['invoice_number']; ?>" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Pickup Date</td>
    <td><input type="text" name="pickup_date" id="pickup_date" size="20" data-beatpicker="true" data-beatpicker-module="today"  value="<?php echo $recs['0']['pickup_date']; ?>"/></td>
  </tr>
  <tr>
    <td style="text-align: right;">Delivery Date</td>
    <td><input type="text" name="delivery_date" id="delivery_date" size="20" value="<?php echo $recs['0']['delivery_date']; ?>" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Deposit</td>
    <td><input type="text" name="deposit" id="deposit" size="25" onkeyup="Custom.rec_fields(this)" value="<?php echo $recs['0']['deposit']; ?>" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Total</td>
    <td><input type="text" name="total" id="total" size="25" onkeyup="Custom.rec_fields(this)" value="<?php echo $recs['0']['total']; ?>" /></td>
  </tr>
  <tr>
    <td style="text-align: right;">Complete</td>
    <td><input type="text" name="complete" id="complete" size="25" onkeyup="Custom.rec_fields(this)" value="<?php echo $recs['0']['complete']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" value="Save" /></td>
    </tr>
    </tbody>
</table>
<input type="hidden" name="type" value="save" />
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  </div>                  
</div>  

 
<?php $main->get_footer(); ?>
