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

?>
<!DOCTYPE html>
<html>
	<head>
            <?php $main->get_header_desktop(); ?>
            <style>
                 #main_wrapper { 
                     box-shadow: 7px 7px 3px #888888; 
                     width: 98%;
                     height: 550px;
                     
                     padding: 7px;
                 }
                 #main_wrapper h3 { 
                     text-align: center; margin: 0; 
                 }
                 #left_panel {
                     width: 45%;
                     height: 400px;
                     float: left;
                     border-top: 1px solid #eeeeee;
                     overflow-y: auto;
                 }
                 #right_panel {
                     width: 55%;
                     height: 400px;;
                     overflow-y: auto;
                     border-left: 1px solid #eeeeee;
                     border-top: 1px solid #eeeeee;
                     float: left;
                     
                 }
                 .category_table {
                     width: 100%;
                     padding-left: 5px;
                     padding-right: 5px;
                 }
                 #edit_category_div {
                     font-size: 14px;
                 }
                 
                 #ei_toggle_wrapper {
                     margin-top: 7px;
                     margin-bottom: 7px;
                 }
            </style>
            
                <script type="text/javascript">
		   
                   
                 $(function(){
                    oTable = $('#customers').dataTable({
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers"
                      });
                  });
                        


    </script>
               
                
	</head>
  <?php flush(); ?>
	<body>
<?php $main->menu_head(); ?>
			
			<div id="main_wrapper" class="ui-widget-content">
                            <h3 class="ui-widget-header">Customers List</h3>
  			    <table cellpadding="2" cellspacing="0" border="0" style="width: 700px;">
  				<tr>
  				    <td>Month: </td>
  				    <td align="right" style="width: 50px;"><select name="month" id="month">
  					    <?php
  					    
  					    for($x=1;$x<=12;$x++){
  						$selected = '';
  						if($current_month == $x){
  						    $selected = 'selected';
  						}
  						echo '<option value="'.$x.'" '.$selected.'>'.date("F", mktime(0, 0, 0, $x, 1, 2013)).'</option>';
  					    }					    
  					    ?>
  					</select>
  				    </td>
  				    <td>
  					<select name="year" id="year">
  					    <?php
  					    $current_year_select = date("Y");
  					    for($x=($current_year_select-2);$x<($current_year_select+2);$x++){
  						$selected = '';
  						if($current_year == $x){
  						    $selected = 'selected';
  						}
  						echo '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';
  					    }
  					    
  					    ?>
  					</select>
  				    </td>
                                      <td align="right">Month Net: <span id="net_total_div"></span> &nbsp;&nbsp;&nbsp; Month Savings Net: <span id="savings_net_total_div"></span></td>
  				</tr>
  			    </table>
          

          <table cellpadding="0" cellspacing="0" border="0" class="display" id="customers">
          <thead>
            <tr>
              <th>Rendering engine</th>
              <th>Browser</th>
              <th>Platform(s)</th>
              <th>Engine version</th>
              <th>CSS grade</th>
            </tr>
          </thead>
          <tbody>
              <tr >
                <td>Trident</td>
                <td>Internet
                   Explorer 4.0</td>
                <td>Win 95+</td>
                <td class="center">4</td>
                <td class="center">X</td>
              </tr>
              <tr>
                <td>Trident</td>
                <td>Internet
                   Explorer 5.0</td>
                <td>Win 95+</td>
                <td class="center">5</td>
                <td class="center">C</td>
              </tr>
              <tr>
                <td>Trident</td>
                <td>Internet
                   Explorer 5.5</td>
                <td>Win 95+</td>
                <td class="center">5.5</td>
                <td class="center">A</td>
              </tr>
            </tbody>
            </table>                    

			    
                           
			    
        </div>
                        <?php
                        //prepare savings number
                        $savings_net = round(array_sum($savings_net_amount),2);
                        $savings_net = $savings_net * -1;
                        ?>
            
                <input type="hidden" name="net_total" id="net_total" value="$<?php echo number_format(round(array_sum($net_amount),2),2); ?>" />
                <input type="hidden" name="savings_net_total" id="savings_net_total" value="$<?php echo number_format($savings_net,2); ?>" />
                <input type="hidden" name="pre_net_total" id="pre_net_total" value="$<?php echo array_sum($net_amount); ?>" />
                <input type="hidden" name="pre_savings_net_total" id="pre_savings_net_total" value="$<?php echo $savings_net; ?>" />
                
                <div id="dialog-edit-category" title="Edit Mapped Category">
                    <div id="edit_category_div"></div>
                </div>
                
                
	</body>
</html>