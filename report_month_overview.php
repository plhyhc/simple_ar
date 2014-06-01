<?php
require("config/main.php");

$start_date = ($_POST['month']) ? $_POST['year']."-".$_POST['month'].'-01' : date("Y-m-d");
$end_date = $_POST['year']."-".$_POST['month'].'-'.date("t",strtotime($_POST['year']."-".$_POST['month']));


$params = [
	"r.delivery_date >= '$start_date'",
	"r.delivery_date <= '$end_date'",
];

$data = $r_receivables->get_receivables_list($params);

?>
<table cellpadding="2" cellspacing="0" border="1">
<tr>
    <th>Customer</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Invoice Number</th>
    <th>Pickup Date</th>
    <th>Delivery Date</th>
    <th>Deposit</th>
    <th>Total</th>
    <th>Complete</th>
  </tr>
<?php
$total_d = [];
$total_t = [];
$total_c = [];
foreach($data as $receivable){
echo '<tr>
      <td>'.$receivable['name'].'</td>
      <td>'.$receivable['address'].'<br />'.$receivable['city'].(($receivable['city'] && $receivable['zip']) ? ', ' : ' ').$receivable['zip'].'</td>
      <td>'.$receivable['phone'].'</td>
      <td>'.$receivable['invoice_number'].'</td>
      <td>'.$receivable['pickup_date'].'</td>
      <td>'.$receivable['delivery_date'].'</td>
      <td>$'.(($receivable['deposit']) ? number_format($receivable['deposit'],2) : '0.00').'</td>
      <td>$'.(($receivable['total']) ? number_format($receivable['total'],2) : '0.00').'</td>
      <td>$'.(($receivable['complete']) ? number_format($receivable['complete'],2) : '0.00').'</td>
    </tr>';
    $total_d[] = $receivable['deposit'];
    $total_t[] = $receivable['total'];
    $total_c[] = $receivable['complete'];

}

?>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

<td><b>$<?php echo number_format(array_sum($total_d),2); ?></b></td>
<td><b>$<?php echo number_format(array_sum($total_t),2); ?></b></td>
<td><b>$<?php echo number_format(array_sum($total_c),2); ?></b></td>
</tr>
</table>