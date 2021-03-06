<?php
require("config/main.php");

$main->get_header(); 
?>
<div id="main_wrapper" class="ui-widget-content">
<h3 class="ui-widget-header">Receivables</h3>
<div class="dataTables_wrapper form-inline">
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
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover dataTable" id="receivables_list">
<thead>
  <tr>
    <th>Customer</th>
    <th>Address</th>
    <th>Invoice Number</th>
    <th>Pickup Date</th>
    <th>Delivery Date</th>
    <th>Deposit</th>
    <th>Total</th>
    <th>Complete</th>
    <th>Date Added</th>
    <th>Edit</th>
  </tr>
</thead>
<tbody>
  <?php
  $receivables_list = $r_receivables->get_receivables_list();
  foreach($receivables_list as $receivable){
    echo '<tr>
      <td>'.$receivable['name'].'</td>
      <td>'.$receivable['address'].'<br />'.$receivable['city'].(($receivable['city'] && $receivable['zip']) ? ', ' : ' ').$receivable['zip'].'</td>
      <td>'.$receivable['invoice_number'].'</td>
      <td>'.$receivable['pickup_date'].'</td>
      <td>'.$receivable['delivery_date'].'</td>
      <td>$'.(($receivable['deposit']) ? number_format($receivable['deposit'],2) : '0.00').'</td>
      <td>$'.(($receivable['total']) ? number_format($receivable['total'],2) : '0.00').'</td>
      <td>$'.(($receivable['complete']) ? number_format($receivable['complete'],2) : '0.00').'</td>
      <td>'.$receivable['date_added'].'</td>
      <td><a href="receivables_edit.php?id='.$receivable['id'].'">Edit</a></td>
    </tr>';
  }
  ?>
  </tbody>
  </table>  
  </div>                  
</div>  

 
<?php $main->get_footer(); ?>
