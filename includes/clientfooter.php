		<!-- start: FOOTER -->
		<div class="footer clearfix">
		    <div class="footer-inner">
		        2014 &copy; clip-one by cliptheme.
		    </div>
		    <div class="footer-items">
		        <span class="go-top"><i class="clip-chevron-up"></i></span>
		    </div>
		</div>
		<!-- end: FOOTER -->

		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->


		<script src="assets/jQuery/jquery-3.3.1.min.js"></script>

		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" charset="utf8" src="assets/DataTables/datatables.js"></script>

		<script src="assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/js/main.js"></script>

		<script type="text/javascript" src="assets/js/jquery.datepicker.js"></script>


		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script src="assets/js/ui-modals.js"></script>

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
		<script src="assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script src="assets/plugins/gritter/js/jquery.gritter.min.js"></script>
		<script src="assets/js/ui-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/js/form-elements.js"></script>
		<script src="assets/js/bootstrap-select.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/r-2.2.2/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>



		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
		<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

		<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

?>

		<script>
		    jQuery(document).ready(function() {

		        //DATA TABLE FOR CONSIGNEMENT LIST
		        $('#consListTable').DataTable({
		            // "scrollY": 200,
		            "scrollX": true
		        });

		        // //table for pricncipal price srch of search_principal_price.php
		        // $('#principricetable').DataTable();

		        //DATA TABLE
		        $('#example').DataTable();


		        //DATATABLE  : SHOW ALL THE COUNTRY
		        $('#cntylisttable').DataTable({
		            initComplete: function() {
		                this.api().columns().every(function() {
		                    var column = this;
		                    var select = $('<select><option value=""></option></select>')
		                        .appendTo($(column.footer()).empty())
		                        .on('change', function() {
		                            var val = $.fn.dataTable.util.escapeRegex(
		                                $(this).val()
		                            );
		                            column
		                                .search(val ? '^' + val + '$' : '', true, false)
		                                .draw();
		                        });
		                    column.data().unique().sort().each(function(d, j) {
		                        if (column.search() === '^' + d + '$') {
		                            select.append('<option value="' + d + '" selected="selected">' + d + '</option>')
		                        } else {
		                            select.append('<option value="' + d + '">' + d + '</option>')
		                        }
		                    });
		                });
		            }
		        });


		        //ADD CLASS TO LI BASED ON URL STARTS
		        var fullpath = window.location.pathname;
		        var filename = fullpath.replace(/^.*[\\\/]/, '');
		        //alert(filename);
		        var currentLink = $('a[href="' + filename + '"]');
		        currentLink.closest('.linav').addClass("active open");
		        //ADDING CLASS TO LI BASED ON URL

		        Main.init();
		        Index.init();

		    });

		</script>




		<?php
if($_SERVER['REQUEST_URI']== '/designation_list.php'){
    
?>
		<script>
		    $(document).ready(function() {
		        $('#designationTable').DataTable();
		    });

		    $('.editBtn').click(function() {
		        var ruleId = $(this).attr("id");
		        /*$('#ptext').text(employee_id);*/
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                ruleId: ruleId
		            },
		            dataType: "json",
		            success: function(data) {
		                /*$('#name').val(data.name);  
		                $('#address').val(data.address);  
		                $('#gender').val(data.gender);  
		                $('#designation').val(data.designation);  
		                $('#age').val(data.age);  
		                $('#employee_id').val(data.id);  
		                $('#insert').val("Update");  
		                $('#add_data_Modal').modal('show');*/
		                $("#ruleIdUp").val(ruleId);
		                $("#designationTitle").val(data.ruleName);
		                $("#designationStatus").val(data.status);

		            }
		        });
		    });

		    $("#updateDesignationForm").on("submit", function(event) {
		        event.preventDefault();

		        /*var designTitle = $("#designationTitle").val();*/

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#updateDesignationForm').serialize(),
		            success: function(data) {
		                $('#updateDesignationForm')[0].reset();
		                $('#myModal').modal('hide');
		                location.reload();
		            }
		        });


		    });

		</script>
		<?php
}


if($_SERVER['REQUEST_URI']== '/client_consignment_booking.php'){
    ?>

		<script>
		    /*$("#corpo_clients").change(function() {
		        event.preventDefault();

		        var clients = $("#corpo_clients").find(":selected").val();

		        $("#shipping_charge").val('');

		        $.ajax({
		            url: "ajaxcoporate.php",
		            method: "POST",
		            data: {
		                clientId: clients
		            },
		            success: function(data) {
		                $("#loader2").hide();

		                var obj_data = JSON.parse(data);

		                $("#sender_name").val(obj_data['client'].client_name);
		                $("#sender_id").val(obj_data['client'].client_id);
		                $("#sender_company").val(obj_data['client'].client_company);
		                $("#client_mail").val(obj_data['client'].client_email);
		                $("#sender_contact").val(obj_data['client'].contact);
		                $("#sender_addr").val(obj_data['client'].client_address);
		                $("#assign_to_stuff").val(obj_data['client'].client_address);


		                $("#shipping_charge").val('');

		            }
		        });

		    });*/

		    $('#dest_country').change(function() {
		        var countryTag = $('#dest_country').val();
		        var client_id_c = $("#corpo_clients").val();

		        $("#shipping_charge").val('');
                
                console.log(countryTag+' '+client_id_c);

		        $.ajax({
		            url: "ajaxcoporate.php",
		            method: "POST",
		            data: {
		                countryTag: countryTag,
		                client: client_id_c
		            },
		            success: function(data) {
		                if (data == 0) {
		                    $("#shipping_charge").val('');
		                    alert("Country Not Found!");
		                } else {
		                    getPrice();
		                }
		            }
		        });
		    });

		    $('#goods_weight').change(function() {
		        var goods_weight = $('#goods_weight').val();
		        var goods_type_c = $('#goods_type').find(":selected").val();
		        var countryTag_c = $('#dest_country').find(":selected").val();
		        var client_id_c = $("#corpo_clients").val();





		        $.ajax({
		            url: "ajaxcoporate.php",
		            method: "POST",
		            data: {
		                ct: countryTag_c,
		                client: client_id_c,
		                goods_weight_m: goods_weight,
		                goods_type_c: goods_type_c
		            },
		            success: function(data) {

		                if (data == 0) {
		                    $("#shipping_charge").val('');
		                    alert("Weight Not Found!");
		                } else {
		                    //    $("#consignment_charge").val(data);
		                    getPrice();
		                }
		            }
		        });
		    });

		    $('#goods_type').change(function() {
		        var goods_type = $('#goods_type').val();
		        var countryTag_c = $('#dest_country').find(":selected").val();
		        var client_id_c = $("#corpo_clients").val();

		        $("#consignment_charge").val('');

		        $.ajax({
		            url: "ajaxcoporate.php",
		            method: "POST",
		            data: {
		                ct: countryTag_c,
		                client: client_id_c,
		                goods_type_m: goods_type
		            },
		            success: function(data) {

		                if (data == 0) {
		                    $("#shipping_charge").val('');
		                    alert("Good Type Not Found!");
		                } else {
		                    getPrice();
		                }
		            }
		        });
		    });

		    var getPrice = function() {
		        var goods_weight_c = $('#goods_weight').find(":selected").val();
		        var goods_type_c = $('#goods_type').find(":selected").val();
		        var countryTag_c = $('#dest_country').find(":selected").val();
		        var client_id_c = $("#corpo_clients").val();

		        if ((goods_type_c != "") && (goods_weight_c != "") && (countryTag_c != "") && (client_id_c != null)) {
		            $.ajax({
		                url: "ajaxcoporate.php",
		                method: "POST",
		                data: {
		                    ct: countryTag_c,
		                    client: client_id_c,
		                    goods_weight_c: goods_weight_c,
		                    goods_type_c: goods_type_c
		                },
		                success: function(data) {

		                    if (data == 0) {
		                        alert("Result Not Found!");
		                    } else {
		                        $("#shipping_charge").val(data);
		                    }
		                }
		            });
		        }
		    }

		    $('#trackID').click(function() {
		        var trackId_c = $('#trackID').val();
		        if (trackId_c == "") {
		            $.ajax({
		                url: "ajaxcoporate.php",
		                method: "POST",
		                data: {
		                    trackId_c
		                },
		                success: function(data) {

		                    $('#trackID').val(data);
		                }
		            });
		        }
		    });

		    $('#form_cons_booking').on('submit', function(event) {
		        event.preventDefault();

		        var tracking_id = $("#trackID").val();

		        if (tracking_id != '') {
		            var goods_weight_c = $('#goods_weight').find(":selected").val();
		            var goods_type_c = $('#goods_type').find(":selected").val();
		            var countryTag_c = $('#dest_country').find(":selected").val();
		            var client_id_c = $("#corpo_clients").val();

		            if ((goods_type_c != "") && (goods_weight_c != "") && (countryTag_c != "") && (client_id_c != null)) {
		                $.ajax({
		                    url: "ajaxcoporate.php",
		                    method: "POST",
		                    data: {
		                        ct: countryTag_c,
		                        client: client_id_c,
		                        goods_weight_c: goods_weight_c,
		                        goods_type_c: goods_type_c
		                    },
		                    success: function(data) {

		                        if (data == 0) {

		                            $("#shipping_charge").val('');
		                            alert("Canno't Procced!!!");
		                        } else {

		                            var shipping_charge = $("#shipping_charge").val()

		                            if (shipping_charge != data) {
		                                alert('Shipping Charge Not Matched!');
		                            } else {
		                                var formValue = $('#form_cons_booking').serialize();
		                                $.ajax({
		                                    url: "ajaxcoporate.php",
		                                    method: "POST",
		                                    data: formValue,
		                                    success: function(data) {
		                                        if (data == 1) {
		                                            $('#goods_title').val('');
		                                            $('#goods_type').val('');
		                                            $('#shipping_charge').val('');
		                                            $('#shimpent_pieces').val('');
		                                            $('#shimpent_declared_value').val('');
		                                            $('#custom_trackId').val('');
		                                            $('#trackID').val('');
		                                            alert("Booking Submited!");
                                                    console.log(data);
		                                        } else {
		                                            /*alert('Data Already Submited!');*/
		                                            console.log(data);
		                                        }
		                                    }
		                                });

		                            }


		                        }
		                    }
		                });
		            }
		        } else {
		            alert('Tracking ID Not Found!!!');
		        }






		    });

		</script>

		<?php
}

if($uri_parts[0] == '/client_view_price.php'){
    ?>

		<script>
          $("#client_zone").change(function(){
              
              $("#client_price_table").children().remove();
              
              var client_email = $("#client_email").val()
              var client_zone = $("#client_zone").find(":selected").val();
              
               $("#client_zone_weight").children("option").remove();
               $("#client_good_type").children("option").remove();
              
              $.ajax({
                    url: "/lib/ajaxcorporateprice.php",
                    method: "POST",
                    data: {client_email: client_email, client_zone_view: client_zone},
                    success: function(data){
                        $("#view_client_price").append(data);
                    }
              });
              
              $.ajax({
                    url: "/lib/ajaxcorporateprice.php",
                    method: "POST",
                    data: {client_email_w: client_email, client_zone_w: client_zone},
                    success: function(data){
                        $("#client_zone_weight").append('<option value="">--</option>');
                        $("#client_zone_weight").append(data);
                    }
              });
              
              $.ajax({
                    url: "/lib/ajaxcorporateprice.php",
                    method: "POST",
                    data: {client_email_t: client_email, client_zone_t: client_zone},
                    success: function(data){
                        $("#client_good_type").append('<option value="">--</option>');
                        $("#client_good_type").append(data);
                    }
              });
              
          });
            
            
            $("#client_zone_weight").change(function(){
                getPrice();
            });
            
            $("#client_good_type").change(function(){
                getPrice();
            });
            
         function getPrice(){
             
             $("#client_price_table").children().remove();
             
             var client_email = $("#client_email").val()
             var client_zone = $("#client_zone").find(":selected").val();
             
             var client_zone_weight = $("#client_zone_weight").find(":selected").val();
             var client_good_type = $("#client_good_type").find(":selected").val();
             
             
             $.ajax({
                    url: "/lib/ajaxcorporateprice.php",
                    method: "POST",
                    data: {client_email_filter: client_email, client_zone_filter: client_zone, client_zone_weight: client_zone_weight, client_good_type: client_good_type},
                    success: function(data){
                        $("#client_price_table").append(data);
                    }
             });
             
             
                          
         }
		</script>

		<?php
}

if($uri_parts[0] == '/client_view_special_price.php'){
    ?>

		<script>
          $("#client_zone").change(function(){
              
              $("#client_price_table").children().remove();
              
              var client_email = $("#client_email").val()
              var client_zone = $("#client_zone").find(":selected").val();
              
               $("#client_zone_weight").children("option").remove();
               $("#client_good_type").children("option").remove();
              
              $.ajax({
                    url: "/lib/ajax_client_special.php",
                    method: "POST",
                    data: {client_email: client_email, client_zone_view: client_zone},
                    success: function(data){
                        $("#view_client_price").append(data);
                    }
              });
              
              $.ajax({
                    url: "/lib/ajax_client_special.php",
                    method: "POST",
                    data: {client_email_w: client_email, client_zone_w: client_zone},
                    success: function(data){
                        $("#client_zone_weight").append('<option value="">--</option>');
                        $("#client_zone_weight").append(data);
                    }
              });
              
              $.ajax({
                    url: "/lib/ajax_client_special.php",
                    method: "POST",
                    data: {client_email_t: client_email, client_zone_t: client_zone},
                    success: function(data){
                        $("#client_good_type").append('<option value="">--</option>');
                        $("#client_good_type").append(data);
                    }
              });
              
          });
            
            
            $("#client_zone_weight").change(function(){
                getPrice();
            });
            
            $("#client_good_type").change(function(){
                getPrice();
            });
            
         function getPrice(){
             
             $("#client_price_table").children().remove();
             
             var client_email = $("#client_email").val()
             var client_zone = $("#client_zone").find(":selected").val();
             
             var client_zone_weight = $("#client_zone_weight").find(":selected").val();
             var client_good_type = $("#client_good_type").find(":selected").val();
             
             
             $.ajax({
                    url: "/lib/ajax_client_special.php",
                    method: "POST",
                    data: {client_email_filter: client_email, client_zone_filter: client_zone, client_zone_weight: client_zone_weight, client_good_type: client_good_type},
                    success: function(data){
                        $("#client_price_table").append(data);
                    }
             });
             
             
                          
         }
		</script>

		<?php
}

?>
    
		<style type="text/css">
		    .panel-heading {
		        background: #ffc800 !important;

		    }

		    ul.main-navigation-menu>li.active>a {
		        background: orange !important;
		    }

		    ul.main-navigation-menu>li.active>a .selected:before {
		        color: orange !important;
		    }

		</style>
		</body>

		</html>
