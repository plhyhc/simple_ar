var Custom = function () {

    // private functions & variables

    var myFunc = function(text) {
        alert(text);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.  
                $('#pickup_date').Zebra_DatePicker();
                $('#delivery_date').Zebra_DatePicker();

                    var aoTable = $('#customers_list').dataTable({
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers",
                        "bLengthChange": false,
                        "iDisplayLength": 40
                      });


                    var boTable = $('#receivables_list').dataTable({
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers",
                        "bLengthChange": false,
                        "iDisplayLength": 40,
                        "order" : [[ 8,"desc"]]
                      });

        },

        //some helper function
        checkDec: function (el) {
            el.value = el.value.replace(/[^0-9\.]+/g,'');
        },

        rec_fields: function(el) {
            $("#complete").val(($("#deposit").val() *1) + ($("#total").val() *1));
            this.checkDec(el);
        },

        remove_customer: function(id)
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
        },

        remove_location: function(id,customer_id){
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
        },

        valide_pass: function(){
            var new_pass = $("#new_pass").val();
            var confirm_pass = $('#confirm_pass').val();
            if(new_pass != confirm_pass){
                alert('The two passwords do not match.  Please re-type the new password and confirm password fields.');
                return false;
            } else {
                return true;
            }
        }

    };

}();