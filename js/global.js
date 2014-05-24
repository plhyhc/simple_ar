$(function(){
    oTable = $('#customers_list').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "iDisplayLength": 40
      });
    $( "#dialog-edit-customer" ).dialog({
        modal: true,
        autoOpen: false,
        height: 600,
        width: 600,
        buttons: {
          Close: function() {
            $( this ).dialog( "close" );
            window.location.reload();
          },
          Save: function() {
            $.ajax({
              url: "edit_customer_post.php",
              type: "POST",
              data: 'type=save&' + $("#edit_customer_form").serialize(),            
              success: function (data) {
                  alert("Customer Information Saved");
                  $( "#dialog-edit-customer" ).dialog('close');
                  window.location.reload();
              },
              error: function (e) {
                  alert(e.message);
              }
           });
          }
        }
      });

  });
  

function edit_customer(id)
{
  $.ajax({
    url: "edit_customer.php",
    type: "POST",
    data: {
      customer_id : id
    },
    success: function (data) {
        $("#edit_customer_div").html(data);
        $( "#dialog-edit-customer" ).dialog('open');
    },
    error: function (e) {
        alert(e.message);
    }
 });
}

function refresh_edit_customer(id){
  $.ajax({
    url: "edit_customer.php",
    type: "POST",
    data: {
      customer_id : id
    },
    success: function (data) {
        $("#edit_customer_div").html(data);
    },
    error: function (e) {
        alert(e.message);
    }
 });
}

function remove_location(id,customer_id){
  var del = confirm("Are you sure you want to remove this location?");
  if(del){
    $.ajax({
      url: "edit_customer_post.php",
      type: "POST",
      data: {
        location_id : id,
        type: 'remove_location'
      },
      success: function (data) {
          alert("Customer Location Removed");
          window.location = 'customers_edit.php?id=' + customer_id
      },
      error: function (e) {
          alert(e.message);
      }
   });
  }
}

function remove_customer(id)
{
  var del = confirm("Are you sure you want to remove this customer, all its locations, and receivables associated to it?");
  if(del){
    $.ajax({
      url: "edit_customer_post.php",
      type: "POST",
      data: {
        customer_id : id,
        type: 'remove_customer'
      },
      success: function (data) {
          alert("Customer Removed");
          window.location = 'customers.php'
      },
      error: function (e) {
          alert(e.message);
      }
   });
  }
}

///////////

$(function(){
    oTable = $('#receivables_list').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "iDisplayLength": 40
      });
    $( "#dialog-edit-customer" ).dialog({
        modal: true,
        autoOpen: false,
        height: 600,
        width: 600,
        buttons: {
          Close: function() {
            $( this ).dialog( "close" );
            window.location.reload();
          },
          Save: function() {
            $.ajax({
              url: "edit_customer_post.php",
              type: "POST",
              data: 'type=save&' + $("#edit_customer_form").serialize(),            
              success: function (data) {
                  alert("Customer Information Saved");
                  $( "#dialog-edit-customer" ).dialog('close');
                  window.location.reload();
              },
              error: function (e) {
                  alert(e.message);
              }
           });
          }
        }
      });

  });

