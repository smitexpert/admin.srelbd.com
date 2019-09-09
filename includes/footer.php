		<!-- start: FOOTER -->
		<div>
		    <div class="footer-inner">
		        <?php echo date('Y'); ?> &copy; Success Renewable Energy Limited.&nbsp;
		        Developed by <a href="#">Virtual IT Solution.</a>
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

		<script src="assets/date/jquery-ui.min.js"></script>
		<script>
		    $(".checkContact").change(function() {
		        var l = $(this).val();
		        //                console.log(l.length);
		        if (l.length != 11) {
		            alert("Please input valid contact.");
		            $(this).closest("div").addClass("has-error");
		            $(this).closest("div").removeClass("has-success");
		            $("#validContact").html("");
		        } else {
		            $(this).closest("div").removeClass("has-error");
		            $(this).closest("div").addClass("has-success");
		            $("#validContact").html("&nbsp;&nbsp;&nbsp;&nbsp;Valid Contact");
		        }
		    })

		</script>

		<?php
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

?>

		<script>
		    jQuery(document).ready(function() {

		        //DATA TABLE FOR CONSIGNEMENT LIST
		        $('#consListTable').DataTable({
		            // "scrollY": 200,
		            "scrollX": true,
		            "order": [
		                [0, "desc"]
		            ]
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
if($_SERVER['REQUEST_URI']== '/create_staff.php'){
    ?>

		<script>
		    $("#joinDate").datepicker({
		        dateFormat: "dd-mm-yy"
		    });

		    $("#joinDate").change(function(e) {
		        //                var joiningDate = new Date($("#joinDate").val());
		        var joiningDate2 = $("#joinDate").val();

		        $.ajax({
		            url: "lib/ajax.php",
		            method: "POST",
		            data: {
		                joinDateS: joiningDate2
		            },
		            success: function(result) {
		                $("#userid").val(result);
		                $("#userid2").val(result);
		            }
		        });


		    });
		    $("#staff_form").on("submit", function(event) {
		        event.preventDefault();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#staff_form').serialize(),
		            success: function(data) {
		                if (data == 'donedone') {
		                    alert("User Creation Success");
		                    location.reload();
		                } else {
		                    alert("Email already exist");
		                }
		            }
		        });

		    });

		</script>

		<?php
}
?>

		<?php
if($uri_parts[0] == '/staff_list.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}
?>

		<?php
if($uri_parts[0] == '/staff_update.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.editStaffBtn').click(function() {
		        var userId = $(this).attr("id");
		        //                console.log(userId);

		        $.ajax({
		            url: "/lib/ajax_staff_update.php",
		            method: "POST",
		            data: {
		                staffUpdate: userId
		            },
		            dataType: "json",
		            success: function(data) {
		                //                        console.log(data);
		                $("#employeeId").val(data.userId);
		                $("#employeeName").val(data.name);
		                $("#designation").val(data.rule);
		                $("#empBranch").val(data.branch_name);
		                $("#email").val(data.email);
		                $("#contact1").val(data.contact1);
		                $("#contact2").val(data.contact2);
		                $("#address").val(data.address);
		                //                        $("#headerName").getElementById(data.name);
		            }
		        });
		    });

		    $("#updateStaffInformation").submit(function(event) {
		        event.preventDefault();

		        var con = confirm("Are you sure ?");
		        if (con) {
		            var old_staff_info = $("#updateStaffInformation").serialize();

		            $.ajax({
		                url: "lib/ajax_staff_update.php",
		                method: "POST",
		                data: old_staff_info,
		                success: function(result_staff) {
		                    location.reload();
		                    $("#aleret_message").slideDown(500, function() {
		                        $("#aleret_message").css("display", "block");
		                    });

		                }
		            })
		        }

		    });
		    window.setTimeout(function() {
		        $("#aleret_message").slideUp(500, function() {
		            $("#aleret_message").css("display", "none");
		        });
		    }, 9000);

		</script>

		<?php
}
?>

		<?php
if($uri_parts[0] == '/staff_attendance.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}
?>

		<?php
if($uri_parts[0] == '/staff_dismiss.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}
?>

		<!--Start All Branch Management Code here-->
		<?php
if($uri_parts[0] == '/branch_list.php'){   
    
?>

		<script>
		    $(document).ready(function() {
		        $('#branchList').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });




		    $(".editBtn").click(function() {
		        var agentId = $(this).attr("id");

		        //                console.log(agentId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                agentDetails: agentId
		            },
		            success: function(result) {
		                $("#upAgentDetails").find("*").remove();
		                $("#upAgentDetails").append(result);

		                //		                console.log(result);

		            }
		        })

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                agentName: agentId
		            },
		            success: function(result) {
		                $("#agentName").text(result);

		            }
		        })
		    })

		</script>

		<?php
} 
?>
		<?php
if($uri_parts[0] == '/branch_update.php'){   
    
?>

		<script>
		    $(document).ready(function() {
		        $('#branchUpdate').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });




		    $(".editBranchBtn").click(function() {
		        var branchId = $(this).attr("id");

		        //		                        console.log(branchId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                branchId: branchId
		            },
		            dataType: "json",
		            success: function(result) {
		                console.log(result);
		                //send to the modal id =  branchEditModal
		                $("#branchName").val(result.branch_name);
		                $("#branchId").val(result.branch_id);
		                if (result.manager_id == null) {
		                    $("#branchManager option[value='']").prop("selected", true);
		                } else {
		                    $("#branchManager option[value='" + result.manager_id + "']").prop("selected", true);
		                }

		                $("#contact").val(result.branch_contact);
		                $("#email").val(result.branch_email);
		                $("#address").val(result.branch_address);
		                $("#branchAbout").val(result.branch_about);
		                $("#updateStatus").val(result.branch_status);


		            }
		        });

		        //Branch Update code
		        $("#updateBranchInformation").submit(function(event) {
		            event.preventDefault();

		            //                    console.log($(this).serialize());
		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: $(this).serialize(),
		                success: function(result) {
		                    //                            console.log(result);
		                    location.reload();
		                }


		            })
		        })



		    })

		</script>

		<?php
} 
?>
		<?php
if($uri_parts[0] == '/branch_close.php'){   
    
?>

		<script>
		    $(document).ready(function() {
		        $('#closeBranch').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });




		    $(".reopenBranch").click(function() {
		        var branchId = $(this).attr("id");

		        //		                        console.log(branchId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                reopenBranch: branchId
		            },
		            dataType: "json",
		            success: function(result) {
		                //		                console.log(result);
		                //send to the modal id =  branchEditModal
		                $("#reopnBranchNameId").val(result.branch_name);
		                $("#hiddenReopenId").val(result.branch_id);
		                //		                if (result.manager_id == null) {
		                //		                    $("#branchManager option[value='']").prop("selected", true);
		                //		                } else {
		                //		                    $("#branchManager option[value='" + result.manager_id + "']").prop("selected", true);
		                //		                }
		                //
		                //		                $("#contact").val(result.branch_contact);
		                //		                $("#email").val(result.branch_email);
		                //		                $("#address").val(result.branch_address);
		                //		                $("#branchAbout").val(result.branch_about);
		                $("#reopenBranchStatusId").val(result.branch_status);


		            }
		        });

		        //Branch Update code
		        $("#reopenBranchModal").submit(function(event) {
		            event.preventDefault();

		            //                    console.log($(this).serialize());
		            $.ajax({
		                url: "/lib/ajax.php",
		                method: "POST",
		                data: $(this).serialize(),
		                success: function(result) {
		                    //                            console.log(result);
		                    alert("Branch Reopn Success!");
		                    location.reload();
		                }


		            })
		        })



		    })

		</script>

		<?php
} 
?>

		<!--End All Branch Management Code here-->

		<!--Start All Stock Management Code here-->
		<?php
if($uri_parts[0]=='/product_in.php'){
?>
		<script>
		    $("#buy_date").datepicker({
		        dateFormat: "dd-mm-yy"
		    });

		    //		    function myFunction() {
		    //		        var prCode = $("#prCode").val();
		    //		        //                console.log(prCode);
		    //
		    //
		    //		        $.ajax({
		    //		            url: 'lib/ajax.php',
		    //		            method: 'POST',
		    //		            data: {
		    //		                productCodeCheck: prCode
		    //		            },
		    //		            success: function(data) {
		    //		                //                    $("#red").addClass("has-error");
		    //		                if (data == 1) {
		    //		                    $("#red").addClass("has-error");
		    //		                    //                        alert(prCode + " id already exist");
		    //		                    //                        $("#prCode").val("");
		    //		                    $("#red").removeClass("has-success");
		    //		                    $("#productSubmit").prop("disabled", true);
		    //		                    $("#printAlert").css("display", "block");
		    //		                } else {
		    //		                    $("#red").removeClass("has-error");
		    //		                    $("#red").addClass("has-success");
		    //		                    $("#productSubmit").prop("disabled", false);
		    //		                    $("#printAlert").css("display", "none");
		    //		                }
		    //		            }
		    //		        })
		    //		    }

		    $("#product_entry").submit(function() {
		        event.preventDefault();

		        var newProduct = $("#product_entry").serialize();

		        $.ajax({
		            url: "lib/ajax_productEntry.php",
		            method: "POST",
		            data: newProduct,
		            success: function(sumbit_result) {
		                //                         console.log(sumbit_result);
		                if (sumbit_result == 1) {
		                    alert("insert success!");
		                    location.reload();
		                } else {
		                    alert("Not submitted");
		                }
		                //                        console.log(sumbit_result);
		            }

		        })


		    })

		</script>
		<?php
}
?>

		<?php
if($uri_parts[0] == '/product_out.php'){
        ?>
		<script>
		    var total_product = [];

		    function serial() {
		        var ser = $("#item_list > tr:last").find(".ser > span").text();
		        //                console.log(ser);
		        if (ser == "") {
		            return 0;
		        } else {
		            return parseInt(ser);
		        }
		    }

		    $("#check_product_stock").change(function() {
		        var productName = $(this).find(":selected").val();

		        if (productName != "") {
		            $.ajax({
		                url: "/lib/ajax_product_out.php",
		                method: "POST",
		                data: {
		                    product_id_info: productName
		                },
		                success: function(product_res) {
		                    $("#product_details").find("*").remove();
		                    $("#product_details").append(product_res);
		                    $("#quantity").prop("disabled", false);

		                }

		            });

		            $.ajax({
		                url: "/lib/ajax_product_out.php",
		                method: "POST",
		                data: {
		                    product_quantity_check: productName
		                },
		                success: function(product_quantity) {
		                    $("#quantity").attr("max", product_quantity);
		                }

		            });

		            $("#quantity").prop("disabled", false);
		        } else {
		            $("#quantity").prop("disabled", true);
		        }
		    });

		    function quanVal(event) {
		        var product_quantity = $(event.target).attr("max");



		        var in_val = $(event.target).val();

		        if ((in_val < 1) || (in_val == "")) {
		            $("#add_product").prop("disabled", true);
		        } else {

		            $("#add_product").prop("disabled", false);
		        }


		        if (parseInt(product_quantity) < parseInt(in_val)) {
		            alert("Out of Stock, your stock " + product_quantity);
		            $("#add_product").prop("disabled", true);
		        }

		        //		        console.log(event)

		    }

		    //            $("#product_out").on("submit",function(e){
		    //                e.preventDefault();
		    //                var sale_price = $("#sale_price").text();
		    //                var in_val = $("#quantity").val();                
		    //                var productName = $("#productName").find(":selected").text();
		    //                alert(sale_price + " " + in_val + " " + productName);
		    //            })

		    $("#add_product").click(function() {
		        var productName = $("#check_product_stock").find(":selected").text();
		        var quantity = $("#quantity").val();
		        var sell_price = $("#sell_price").text();
		        var buy_price = $("#unit_buy_price").val();
		        var total_price = parseFloat(sell_price) * quantity;
		        var product_id = $("#p_id").val();
		        var sale_quantit = $("#stock_quantity").text();

		        var ser = serial() + 1;

		        var check = 0;

		        $.each(total_product, function(key, val) {
		            if (val == product_id) {
		                check = 1;
		            }
		        });





		        //                console.log("Name :" + productName +"Quentity: "+ quantity +"ID: "+ product_id + "Unit Price " + sell_price);

		        if (check != 1) {
		            var salePrice = parseFloat(sell_price).toFixed(2);
		            var total_price = parseFloat(total_price).toFixed(2);

		            $("#item_list").append('<tr> <td class="ser" style = "text-align:center;" ><input class="remove_p" type="hidden" name="product_id[]" value="' + product_id + '" /><span>' + ser + '</span> </td> <td style = "text-align:center;" > ' + productName + ' </td> <td style = "text-align:center;" ><input type="number" min="1" max="' + parseInt(sale_quantit) + '" name="quantity[]" value="' + quantity + '" onkeyup="update_total(event)" onclick="update_total(event)" class="up_quantity"></td> <td style = "text-align:right;" ><input onkeyup="update_total(event)" class="up_price" type="text" name="sale_price[]" value=' + salePrice + ' min="' + buy_price + '" onfocusout= "check_min_price(event)"></td> <td class="grTotal" style = "text-align:right;" > ' + total_price + ' </td> <td style = "text-align:center;"><span class="remove_product" onclick="remove_product(event)">X</span></td> </tr>');
		            total_product.push(product_id);
		        }

		        //		        console.log(total_product);
		        grTotal();
		    })

		    function remove_product(event) {
		        var id = $(event.target).closest("tr").find(".remove_p").val();
		        $(event.target).closest("tr").remove();
		        //                console.log(id);
		        total_product = $.grep(total_product, function(val) {
		            return val != id;
		        })

		        var srl = 1;

		        $("#item_list > tr").each(function(key, val) {
		            $(val).find(".ser > span").text(srl);
		            srl++;
		        });

		        grTotal();
		    }

		    function grTotal() {
		        var grandTotal = parseFloat(0);

		        $("#item_list > tr").each(function(key, val) {
		            var tPrice = $(val).find(".grTotal").text();
		            grandTotal = grandTotal + parseFloat(tPrice);


		        })

		        $("#grTotal").text(grandTotal.toFixed(2));
		        $("#submitGrandTotal").val(grandTotal.toFixed(2));

		        enable_submit_button();
		    }

		    function enable_submit_button() {

		        var buyerType = $("#buyerType").find(":selected").val();
		        var agentName = $("#agentName").find(":selected").val();
		        var customerName = $("#customerName").val();
		        var con = 0;

		        if (buyerType == "agent") {
		            if (agentName != "") {
		                con = 1;
		            } else {
		                con = 0;
		            }
		        } else {
		            if (customerName != "") {
		                con = 1;
		            } else {
		                con = 0;
		            }
		        }

		        if (con == 1) {
		            if (total_product.length > 0) {
		                $("#productSubmit").prop("disabled", false);
		            } else {

		                $("#productSubmit").prop("disabled", true);
		            }
		        } else {
		            $("#productSubmit").prop("disabled", true);
		        }
		    }




		    $("#product_submit").on("keyup keypress", function(event) {
		        var keyCode = event.keyCode || event.which;

		        if (keyCode === 13) {
		            event.preventDefault();
		            return false;
		        }

		    });


		    $("#product_submit").on("submit", function(event) {
		        event.preventDefault();

		        var product_submit = $("#product_submit").serialize();
		        //		        console.log(product_out);

		        var con = confirm("Are You Sure?");

		        if (con == true) {
		            $.ajax({
		                url: "/lib/ajax_product_out.php",
		                method: "POST",
		                data: product_submit,
		                success: function(invoiceNo) {
		                    console.log(invoiceNo);
		                    //                        var result2 = result;
		                    //      
		                    window.open("/print_invoice.php?id=" + invoiceNo);
		                    location.reload();
		                    //		                    		                		                console.log(result2);
		                }
		            })
		        }



		    });

		    function check_min_price(event) {
		        var newPrice = $(event.target).closest("tr").find(".up_price").val();
		        var buyPrice = $(event.target).closest("tr").find(".up_price").attr("min");

		        if (newPrice < buyPrice) {
		            $(event.target).closest("tr").find(".up_price").val(buyPrice);
		        }
		        var newQuantity = $(event.target).closest("tr").find(".up_quantity").val();
		        var newPrice1 = $(event.target).closest("tr").find(".up_price").val();

		        var total = newQuantity * newPrice1;

		        $(event.target).closest("tr").find(".grTotal").text(total.toFixed(2));
		        grTotal();

		        //                console.log(newPrice + " " + buyPrice )

		    }

		    function update_total(event) {
		        var newQuantity = $(event.target).closest("tr").find(".up_quantity").val();
		        var newPrice = $(event.target).closest("tr").find(".up_price").val();

		        var total = newQuantity * newPrice;

		        $(event.target).closest("tr").find(".grTotal").text(total.toFixed(2));
		        grTotal();


		        //		                        console.log(newQuantity);
		        //		                        console.log(newPrice);
		    }

		    $("#buyerType").change(function() {
		        var buyerType = $(this).find(":selected").val();


		        $("#agentName option[value='']").prop("selected", true);
		        $("#customerName").val("");

		        if (buyerType == "agent") {
		            $("#agent").css("display", "block");
		            $("#customer").css("display", "none");
		        } else {
		            $("#agent").css("display", "none");
		            $("#customer").css("display", "block");
		        }
		        enable_submit_button();
		    })

		</script>
		<?php
    }
?>
		<?php
if($uri_parts[0] == '/product_list.php'){   
    
?>

		<script>
		    $(document).ready(function() {
		        $('#productList').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });

		</script>

		<?php
} 
?><?php
if($uri_parts[0] == '/product_store.php'){   
    
?>

		<script>
		    $(document).ready(function() {
		        $('#allProductList').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });

		</script>

		<?php
} 
?>

		<?php
if($uri_parts[0]=='/sale_return.php'){
?>
		<script>
		    function saleReturn() {
		        var saleReturnInvoice = $("#saleRInvoice").val();

		        if (saleReturnInvoice == "") {
		            $("#saleInviceAlert").css("display", "none");

		        } else {
		            $.ajax({
		                url: 'lib/ajax_returnProduct.php',
		                method: 'POST',
		                data: {
		                    saleReturnInvoiceCheck: saleReturnInvoice
		                },
		                dataType: "json",
		                success: function(data) {

		                    if (data == 1) {
		                        $("#saleInviceAlert").html("Valid");
		                        $("#saleReturnShow").prop("disabled", false);
		                        $("#saleInviceAlert").css("display", "block");
		                        $("#saleInviceAlert").css("color", "green");
		                        $("#saleRInvoice").closest("div").removeClass("has-error");
		                        $("#saleRInvoice").closest("div").addClass("has-success");



		                    } else {
		                        $("#saleInviceAlert").html("invalid");
		                        $("#saleReturnShow").prop("disabled", true);
		                        $("#saleInviceAlert").css("display", "block");
		                        $("#saleInviceAlert").css("color", "red");
		                        $("#saleRInvoice").closest("div").addClass("has-error");
		                        $("#saleRInvoice").closest("div").removeClass("has-success");

		                    }

		                    //		                    console.log(data);
		                }
		            })

		        }
		    }

		    $("#saleReturnShow").click(function() {
		        var saleReturnInvoiceNo = $("#saleRInvoice").val();

		        $.ajax({
		            url: "lib/ajax_returnProduct.php",
		            method: "POST",
		            data: {
		                saleReturnInvoiceNo: saleReturnInvoiceNo
		            },
		            success: function(result) {
		                //                        console.log(result);
		                $("#saleReturnProduct").find("*").remove();
		                $("#saleReturnProduct").append(result);
		                //                        saleReturnGrandTotal();
		            }
		        });

		        $.ajax({
		            url: "lib/ajax_returnProduct.php",
		            method: "POST",
		            data: {
		                saleReturnOldInvoiceNoData: saleReturnInvoiceNo
		            },
		            dataType: 'json',
		            success: function(result) {
		                //		                console.log(result);
		                $("#buyer_id").text(result.buyer_id);
		                $("#sale_return_buyer_name").text(result.buyer_name);
		                $("#returnGrandTotal").text(parseFloat(result.grandTotal).toFixed(2));
		                $("#sale_return_invoice_no").text(result.invoice_no);
		                $("#sale_date").text(result.sale_date);
		                $("#branch_name").text(result.branch_name);
		                $("#refInvoice").html('');

		                if (result.reference_invoice != null && result.reference_invoice != "") {
		                    $("#refInvoice").html('<span>Ref. Invoice: ' + result.reference_invoice + '</span>');
		                }

		                $("#printButton").prop("disabled", false);
		            }
		        });

		    });

		    function quantity(event) {
		        var quantity = $(event.target).val();
		        //		        if (quantity < 1) {
		        //		            alert("input must be greater then 0!");
		        //		        }
		        var unitprice = $(event.target).closest('tr').find('.unite_price input').val();
		        var total = parseFloat(quantity * unitprice).toFixed(2);
		        $(event.target).closest('tr').find('.quntity_total').text(total);
		        $(event.target).closest('tr').find('.quntity_total').append('<input type="hidden" name="quntityTotal[]" value="' + total + '">');

		        var quantityMain = $(event.target).closest('td').find('.quantityMain').val();
		        $(event.target).closest('td').find('.quantityChange').val(quantityMain - quantity);

		        saleReturnGrandTotal();
		    }

		    //		    $("#printButton").click(function() {
		    //		        var inv = $("#invoice_no").text();
		    ////		        window.open("print_invoice.php?id=" + inv);
		    //                console.log("printButton" + inv);
		    //		    });

		    function saleReturnGrandTotal() {
		        var grandTotal = parseFloat(0);

		        $("#saleReturnProduct > tr").each(function(key, val) {
		            var tPrice = $(val).find(".quntity_total").find('input').val();

		            grandTotal = grandTotal + parseFloat(tPrice);




		        });

		        //                console.log(grandTotal);

		        $("#returnGrandTotal").text(grandTotal.toFixed(2));
		        //		        $("#submitGrandTotal").val(grandTotal.toFixed(2));

		        //		        enable_submit_button();
		    }

		    function remove_product(event) {
		        $(event.target).closest('tr').find('.returnQuantity').val('0');
		        $(event.target).closest('tr').find('.returnQuantity').attr("min", "0");
		        $(event.target).closest('tr').find('.quntity_total').text('0.00');
		        $(event.target).closest('tr').find('.quntity_total').append('<input type="hidden" name="quntityTotal[]" value="0.00">');
		        var quantity = $(event.target).closest('tr').find('td .returnQuantity').val();
		        var quantityMain = $(event.target).closest('tr').find('td .quantityMain').val();
		        $(event.target).closest('tr').find('td .quantityChange').val(quantityMain - quantity);

		        saleReturnGrandTotal();

		    }

		    $("#returnSoldProduct").submit(function(event) {
		        event.preventDefault();
		        var returnSoldProduct = $(this).serialize();
		        //		                        console.log(returnSoldProduct);
		        $.ajax({
		            url: "lib/ajax_returnProduct.php",
		            method: "POST",
		            data: returnSoldProduct,
		            success: function(invoiceNo) {
		                window.open("print_invoice.php?id=" + invoiceNo);
		                location.reload();
		            }
		        });
		    });

		</script>
		<?php
}
?>
		<?php
if($uri_parts[0]=='/print_old_invoice.php'){
?>
		<script>
		    function oldInvoice() {
		        var oldInvoice = $("#oldInvoice").val();

		        if (oldInvoice == "") {
		            $("#oldInvoiceAlert").css("display", "none");

		        } else {
		            $.ajax({
		                url: 'lib/ajax.php',
		                method: 'POST',
		                data: {
		                    invoiceCheck: oldInvoice
		                },
		                dataType: "json",
		                success: function(data) {

		                    if (data == 1) {
		                        $("#oldInvoiceAlert").html("Valid");
		                        $("#oldInvoiceShow").prop("disabled", false);
		                        $("#oldInvoiceAlert").css("display", "block");
		                        $("#oldInvoiceAlert").css("color", "green");
		                        $("#oldInvoice").closest("div").removeClass("has-error");
		                        $("#oldInvoice").closest("div").addClass("has-success");



		                    } else {
		                        $("#oldInvoiceAlert").html("invalid");
		                        $("#oldInvoiceShow").prop("disabled", true);
		                        $("#oldInvoiceAlert").css("display", "block");
		                        $("#oldInvoiceAlert").css("color", "red");
		                        $("#oldInvoice").closest("div").addClass("has-error");
		                        $("#oldInvoice").closest("div").removeClass("has-success");

		                    }

		                    //		                    console.log(data);
		                }
		            })

		        }
		    }

		    $("#oldInvoiceShow").click(function() {
		        var invoice = $("#oldInvoice").val();

		        $.ajax({
		            url: "lib/ajax.php",
		            method: "POST",
		            data: {
		                oldInvoiceNo: invoice
		            },
		            success: function(result) {
		                //                        console.log(result);
		                $("#printAllProduct").find("*").remove();
		                $("#printAllProduct").append(result);
		            }
		        });

		        $.ajax({
		            url: "lib/ajax.php",
		            method: "POST",
		            data: {
		                oldInvoiceNoData: invoice
		            },
		            dataType: 'json',
		            success: function(result) {
		                console.log(result);
		                $("#buyer_id").text(result.buyer_id);
		                $("#buyer_name").text(result.buyer_name);
		                $("#grandTotal").text(result.grandTotal);
		                $("#invoice_no").text(result.invoice_no);
		                $("#sale_date").text(result.sale_date);

		                $("#printButton").prop("disabled", false);
		            }
		        });
		    });

		    $("#printButton").click(function() {
		        var inv = $("#invoice_no").text();
		        window.open("print_invoice.php?id=" + inv);
		    })

		</script>
		<?php
}
?>
		<!--End All Stock Management Code here-->

		<!--Start All Agent Management Code here-->
		<?php
if($uri_parts[0] == '/agent_create.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#agentTable2').DataTable({
		            "order": [
		                [0, "desc"]
		            ]
		        });
		    });

		    function CheckAgentContact1() {
		        var agent_contact1 = $("#agent_contact1").val();
		        //                console.log(agent_contact1);

		        $.ajax({
		            url: "lib/ajax.php",
		            method: "POST",
		            data: {
		                agent_contact1: agent_contact1
		            },
		            success: function(agentResult) {
		                if (agentResult == 0) {
		                    $("#agent_contact1").closest("div").removeClass("has-error");
		                    $("#agent_contact1").closest("div").addClass("has-success");
		                    $("#agentSubmit").prop("disabled", false);

		                } else {
		                    $("#agent_contact1").closest("div").removeClass("has-success");
		                    $("#agent_contact1").closest("div").addClass("has-error");
		                    $("#agentSubmit").closest("div").addClass("has-error");
		                    $("#agentSubmit").prop("disabled", true);
		                    alert("This Number Already Exist.\nPlease try another number.");

		                }
		            }

		        })
		    }

		</script>

		<?php
}
?>

		<?php
if($uri_parts[0] == '/agent_view.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#agentTable').DataTable({
		            "order": [
		                [0, "desc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}
?>
		<?php
if($uri_parts[0] == '/agent_ledger.php'){      
?>

		<script>
		    $(document).ready(function() {
		        $('#agentDetails').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });

		    $(document).ready(function() {
		        $('#totalStatement_details').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });




		    $(".editBtn").click(function() {
		        var agentId = $(this).attr("id");

		        //                console.log(agentId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                agentDetails: agentId
		            },
		            success: function(result) {
		                $("#upAgentDetails").find("*").remove();
		                $("#upAgentDetails").append(result);

		                //		                console.log(result);

		            }
		        })

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                agentName: agentId
		            },
		            success: function(result) {
		                $("#agentName").text(result);

		            }
		        })
		    })

		</script>

		<?php
} 
?>

		<?php
if($uri_parts[0] == '/agent_open_balance.php'){      
?>

		<script>
		    $("#create_date").datepicker({
		        dateFormat: "dd-mm-yy"
		    });

		    $("#agent_opening_balance").on("submit", function(event) {
		        event.preventDefault();

		        var agent_open_balance = $("#agent_opening_balance").serialize();
		        		        console.log(agent_open_balance);
		        var agentName = $("#agentName").find(":selected").val();

		        if (agentName != "") {
		            var con = confirm("Are You Sure?");
		            //		            console.log(agentName);
		            if (con) {
		                $.ajax({
		                    url:"lib/ajax_agent_opening_balance.php",
		                    method: "POST",
		                    data: agent_open_balance,
		                    success: function(result) {
		                        if (result) {
		                           // alert("insert success !");
		                            location.reload();
		                          //  console.log("If part " + result);
		                        }else{
		                          //  console.log("Else part " + result);
		                        }
		                    }
		                });
		            }
		        } else {
		            alert("Please select agent name.");
		        }
		    });

		    $("#agentName").change(function(event) {
		        var agentName = $(this).find(":selected").val();

		        $.ajax({
		            url: "lib/ajax_agent_opening_balance.php",
		            method: "POST",
		            data: {
		                agentId: agentName
		            },
		            success: function(result) {
		                console.log(result);
		                if (result == 1) {
		                    alert("Already Exist");
		                    $("#agentOpenBalanceSubmit").prop("disabled", true);
		                    //		                    location.reload();
		                } else {
		                    $("#agentOpenBalanceSubmit").prop("disabled", false);
		                }
		            }
		        });

		    })

		</script>

		<?php
} 
?>
		<!--End All Agent Management Code here-->

		<!--End All Plant Management Code here-->
		<?php
if($uri_parts[0] == '/add_new_plant.php'){
?>
		<script>
		    $("#plantAssignByChange").change(function() {
		        var plantAssignBy = $(this).find(":selected").val();

		        //                console.log(plantAssignBy);


		        //		            $("#agentName option[value='']").prop("selected",true);
		        //		            $("#customerName").val("");

		        //
		        if (plantAssignBy == "agent") {
		            $("#agentSection").css("display", "block");
		            $("#staffSection").css("display", "none");
		            $("#selfSection").css("display", "none");
		            $("#othersSection").css("display", "none");
		            $("#offeredAmount_agent").prop("required", true);
		        } else if (plantAssignBy == "companyStaff") {
		            $("#agentSection").css("display", "none");
		            $("#staffSection").css("display", "block");
		            $("#selfSection").css("display", "none");
		            $("#othersSection").css("display", "none");
		            $("#offeredAmount_staff").prop("required", true);
		        } else if (plantAssignBy == "self") {
		            $("#agentSection").css("display", "none");
		            $("#staffSection").css("display", "none");
		            $("#selfSection").css("display", "none");
		            $("#othersSection").css("display", "none");
		        } else if (plantAssignBy == "others") {
		            $("#agentSection").css("display", "none");
		            $("#staffSection").css("display", "none");
		            $("#selfSection").css("display", "none");
		            $("#othersSection").css("display", "block");
		            $("#otherName").prop("required", true);
		            $("#offeredAmount_others").prop("required", true);
		        } else {
		            $("#agentSection").css("display", "none");
		            $("#staffSection").css("display", "none");
		            $("#selfSection").css("display", "none");
		            $("#othersSection").css("display", "none");

		        }
		        //		        enable_submit_button();
		    });


		    $("#add_new_plant2").submit(function(event) {
		        event.preventDefault();
		        var type = $("#plantAssignByChange").find(":selected").val();

		        //                console.log(type);
		        if (type == "agent") {
		            var Name = $("#agentName").find(":selected").val();
		            if (Name == "") {
		                alert("Plaes select Agent Name!");
		            }
		            if (Name != "") {
		                $.ajax({
		                    url: "/lib/ajax_add_new_plant.php",
		                    method: "POST",
		                    data: $('#add_new_plant2').serialize(),
		                    success: function(plantResult) {
		                        //                                console.log(plantResult);
		                        if (plantResult == 1) {
		                            alert("Plant Entry Success !");
		                            location.reload();
		                        }else{
		                            alert("Plant Entry not Success !");
		                        }
		                    }
		                });
		            }
		        }

		        if (type == "companyStaff") {
		            var Name = $("#stafftName").find(":selected").val();
		            if (Name == "") {
		                alert("Plaes select Staff Name!");
		            }
		            if (Name != "") {
		                $.ajax({
		                    url: "/lib/ajax_add_new_plant.php",
		                    method: "POST",
		                    data: $('#add_new_plant2').serialize(),
		                    success: function(plantResult) {
		                        if (plantResult == 1) {
		                            alert("Plant Entry Success !");
		                            location.reload();
		                        }
		                    }
		                });
		            }
		        }

		        if (type == "self" || type == "others") {
		            $.ajax({
		                url: "/lib/ajax_add_new_plant.php",
		                method: "POST",
		                data: $('#add_new_plant2').serialize(),
		                success: function(plantResult) {
		                    if (plantResult == 1) {
		                        alert("Plant Entry Success !");
		                        location.reload();
		                    }
		                }
		            });
		        }

		    });

		    $("#district").change(function(e) {
		        var districtId = $(this).find(":selected").val();

		        //                console.log(districtId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                districtIdForPoliceStation: districtId
		            },
		            //                    dataType: "json",
		            success: function(data) {
		                //		               console.log(data);
		                $("#policeStation").find("*").remove();
		                $("#policeStation").append(data);
		                $(".selectpicker").selectpicker('refresh');
		            }
		        });
		    });

		</script>
		<?php
}   
?>
		<?php
if($uri_parts[0] == '/plant_view.php'){
?>
		<script>
		    $(document).ready(function() {
		        $('#plantTable').DataTable({
		            "order": [
		                [0, "DESC"]
		            ]
		        });
		    });

		    $(".editPlantBtn").click(function() {
		        var disId = $(this).attr("id");
		        //                console.log(disId);

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                plantIdFromEditPlant: disId
		            },
		            dataType: "json",
		            success: function(plant_info) {
		                $("#modalPlantDateId").val(plant_info.plant_date);
		                $("#modalPlantId").val(plant_info.plant_no);
		                $("#hiddenModalPlantTableId").val(plant_info.id);
		                $("#modalDisbursementNoId").val(plant_info.disbursement_no);
		                $("#modalPlantOwnerId").val(plant_info.plant_owner_name);
		                $("#modalNidId").val(plant_info.nid);
		                $("#modalDobId").val(plant_info.dob);
		                $("#modalContactId").val(plant_info.contact_no);
		                $("#modalDistrictId").val(plant_info.district);
		                $("#modalPlantAssignById").val(plant_info.assignee_type);
		                $("#modalAgentId").val(plant_info.name);
		                $("#modalOfferedAmountId").val(plant_info.offered_amount);
		                $("#modalUpdateStatusId").val(plant_info.status);

		                //                        console.log(result);

		            }

		        });
		    });

		    $("#updatePlantInformation").on("submit", function(e) {
		        e.preventDefault();

		        var updatePlantInformationModal = $(this).serialize();
		        //                console.log(formInfo);
		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: updatePlantInformationModal,
		            success: function(result) {
		                location.reload();
		                //		                console.log(result);
		            }
		        });
		    })

		</script>

		<?php
} 
?>
		<?php
if($uri_parts[0] == '/plant_view1.php'){   
    
?>
		<script>
		    $(document).ready(function() {
		        $('#plantListAll').DataTable({
		            "order": [
		                [0, "asc"]
		            ],
		            "columnDefs": [{
		                    "targets": [6],
		                    "visible": false
		                }, {
		                    "targets": [7],
		                    "visible": false
		                }, {
		                    "targets": [8],
		                    "visible": false
		                }, {
		                    "targets": [9],
		                    "visible": false
		                },
		                {
		                    "targets": [10],
		                    "visible": false
		                }
		            ]
		        });
		    });

		</script>

		<?php
} 
?>
		<!--End All Plant Management Code here-->


		<!--Start All Accounts Management Code here-->
		<?php
if($uri_parts[0] == '/accounts_credit.php'){
    ?>
		<script>
		    $("#create_date").datepicker({
		        dateFormat: "dd-mm-yy"
		    });

		    $("#pay_mode input").click(function() {
		        var val = $(this).attr("id");

		        if (val == "radio_cash") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-mobile input").prop('required', false);
		            $("#payment-mode-cheque input").prop('required', false);
		        } else if (val == "radio_cheque") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "block");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-cheque input").prop('required', true);
		            $("#payment-mode-mobile input").prop('required', false);
		        } else if (val == "radio_mobile") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "block");
		            $("#payment-mode-cheque input").prop('required', false);
		            $("#payment-mode-mobile input").prop('required', true);
		        }
		    });

		</script>





		<?php
}

?>
		<?php
if($uri_parts[0] == '/accounts_debit.php'){
    ?>
		<script>
		    $("#create_date").datepicker({
		        dateFormat: "yy-mm-dd"
		    });

		    $("#pay_mode input").click(function() {
		        var val = $(this).attr("id");

		        if (val == "radio_cash") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-mobile input").prop('required', false);
		            $("#payment-mode-cheque input").prop('required', false);
		        } else if (val == "radio_cheque") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "block");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-cheque input").prop('required', true);
		            $("#payment-mode-mobile input").prop('required', false);
		        } else if (val == "radio_mobile") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "block");
		            $("#payment-mode-cheque input").prop('required', false);
		            $("#payment-mode-mobile input").prop('required', true);
		        }
		    });

		</script>





		<?php
}

?>
		<?php
if($uri_parts[0] == '/accounts_journal.php'){
    ?>
		<script>
		    $(document).ready(function() {
		        $('#totalStatement').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>





		<?php
}

?>
		<?php
if($uri_parts[0] == '/accounts_income_statement.php'){
    ?>
		<script>
		    $(document).ready(function() {
		        $('#incomeStatement').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>





		<?php
}

?>
		<?php
if($uri_parts[0] == '/accounts_expenditure_statement.php'){
    ?>
		<script>
		    $(document).ready(function() {
		        $('#expenditureStatement').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>





		<?php
}

?>

		<?php
if($uri_parts[0] == '/accounts_agentPayment.php'){
    ?>
		<script>
		    $("#agent_date").datepicker({
		        dateFormat: "dd-mm-yy"
		    });
		    $("#pay_mode input").click(function() {
		        var val = $(this).attr("id");

		        if (val == "radio_cash") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-mobile input").prop('required', false);
		            $("#payment-mode-cheque input").prop('required', false);
		        } else if (val == "radio_cheque") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "block");
		            $("#payment-mode-mobile").css("display", "none");
		            $("#payment-mode-cheque input").prop('required', true);
		            $("#payment-mode-mobile input").prop('required', false);
		        } else if (val == "radio_mobile") {
		            $("#payment-mode-cash").css("display", "none");
		            $("#payment-mode-cheque").css("display", "none");
		            $("#payment-mode-mobile").css("display", "block");
		            $("#payment-mode-cheque input").prop('required', false);
		            $("#payment-mode-mobile input").prop('required', true);
		        }
		    });

		    $("#agent_accounts_debit").submit(function(event) {
		        var con = confirm("Are you sure ?");
		        event.preventDefault();

		        if (con) {
		            var formData = $(this).serialize();

		            $.ajax({
		                url: "lib/ajax_accounts_agentPayment.php",
		                method: "POST",
		                data: formData,
		                success: function(returnResult) {
		                    if (returnResult != 0) {
		                        document.getElementById("agent_accounts_debit").reset();
		                        $("#aleret_message").slideDown(500, function() {
		                            $("#aleret_message").css("display", "block");
		                        });
		                        resetId();

		                    } else {
		                        alert("Operation Failed !");
		                    }
		                }
		            })
		        } else {

		        }
		    })


		    function resetId() {
		        //                $("#money_receipt_no").val("");
		        $.ajax({
		            url: "lib/ajax_accounts_agentPayment.php",
		            method: "POST",
		            data: {
		                getMoneyreceiptNo: "Hello"
		            },
		            success: function(res) {
		                $("#money_receipt_no").val(res);
		            }
		        });

		        $("#payment-mode-cash").css("display", "none");
		        $("#payment-mode-cheque").css("display", "none");
		        $("#payment-mode-mobile").css("display", "none");
		        $("#payment-mode-mobile input").prop('required', false);
		        $("#payment-mode-cheque input").prop('required', false);

		        window.setTimeout(function() {
		            $("#aleret_message").slideUp(500, function() {
		                $("#aleret_message").css("display", "none");
		            });
		        }, 3000);
		    }

		</script>

		<?php
}

?>

		<!--End All Accounts Management Code here-->


		<?php
if($uri_parts[0] == '/designation_list.php'){
    
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
?>

		<?php
if($uri_parts[0] == '/role_play.php'){
    ?>

		<script>
		    $(document).ready(function() {
		        $('#userTable').DataTable({
		            "order": [
		                [0, "desc"]
		            ]
		        });
		    });


		    $('.status_btn').click(function() {
		        var userId = $(this).attr("id");

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: {
		                userStatusChange: userId
		            },
		            success: function(data) {
		                if (data == '0') {
		                    $("#" + userId).closest('span.btn_green').removeClass('btn_green').addClass('btn_red');
		                } else if (data == 1) {
		                    $("#" + userId).closest('span.btn_red').removeClass('btn_red').addClass('btn_green');
		                } else {
		                    alert(data);
		                }

		            }
		        });
		    });

		</script>

		<?php
}
?>
		<?php

if($uri_parts[0] == '/role_play_user.php'){
    ?>

		<script>
		    $('#role-play').on('submit', function(event) {
		        event.preventDefault();

		        $.ajax({
		            url: "/lib/ajax.php",
		            method: "POST",
		            data: $('#role-play').serialize(),
		            success: function(data) {
		                if (data == 1) {
		                    location.reload();
		                } else {
		                    alert(data)
		                }

		            }
		        });
		    });

		</script>

		<?php
}

?>

		<?php

if($uri_parts[0] == '/password_change.php'){
    ?>

		<script>
		    //		    function CheckPass(event){
		    //                var oldPassword = $(event.target).val();
		    //                var oldPassword = $("#oldPass").focusout().val();

		    //                console.log(oldPassword);
		    //            }
		    var oldPass = false;
		    var newPass = false;
		    var conPass = false;

		    $("#oldPass").focusout(function() {
		        var oldPassword = $("#oldPass").val();

		        if (oldPassword != "") {
		            $.ajax({
		                url: "lib/ajax_change_password.php",
		                method: "POST",
		                data: {
		                    oldPasswordCheck: oldPassword
		                },
		                success: function(result) {
		                    if (result == 1) {
		                        oldPass = true;
		                        $("#oldPass").closest("div").removeClass("has-error");
		                        $("#oldPass").closest("div").addClass("has-success");
		                        $("#checkMark").css("display", "block");
		                        $("#closeMark").css("display", "none");
		                    } else if (result == 0) {
		                        oldPass = false;
		                        $("#oldPass").closest("div").addClass("has-error");
		                        $("#checkMark").css("display", "none");
		                        $("#closeMark").css("display", "block");
		                    }
		                    enableSubmitButton();
		                }
		            });
		        } else {
		            $("#oldPass").closest("div").removeClass("has-error");
		            $("#oldPass").closest("div").removeClass("has-success");
		            $("#checkMark").css("display", "none");
		            $("#closeMark").css("display", "none");
		        }

		    })


		    $("#oldPass").keyup(function() {
		        var oldPassword = $("#oldPass").val();
		        oldPass = false;
		        if (oldPassword != "") {
		            $.ajax({
		                url: "lib/ajax_change_password.php",
		                method: "POST",
		                data: {
		                    oldPasswordCheck: oldPassword
		                },
		                success: function(result) {
		                    if (result == 1) {
		                        oldPass = true;
		                        //		                        $("#oldPass").closest("div").removeClass("has-error");
		                        //		                        $("#oldPass").closest("div").addClass("has-success");
		                        //		                        $("#checkMark").css("display", "block");
		                        //		                        $("#closeMark").css("display", "none");
		                        //		                    } else if (result == 0) {
		                        //                                oldPass = false;
		                        //		                        $("#oldPass").closest("div").addClass("has-error");
		                        //		                        $("#checkMark").css("display", "none");
		                        //		                        $("#closeMark").css("display", "block");
		                        //		                    }
		                    }
		                    enableSubmitButton();
		                }
		            });
		        }
		        //                        else {
		        //		            $("#oldPass").closest("div").removeClass("has-error");
		        //		            $("#oldPass").closest("div").removeClass("has-success");
		        //		            $("#checkMark").css("display", "none");
		        //		            $("#closeMark").css("display", "none");
		        //		        }

		    })

		    $("#newPass").focusout(function() {
		        var newPassword = $("#newPass").val();

		        if (newPassword != "") {
		            $.ajax({
		                url: "lib/ajax_change_password.php",
		                method: "POST",
		                data: {
		                    newPasswordCheck: newPassword
		                },
		                success: function(r) {
		                    newPass = false;
		                    if (r == 1) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password at least 8 Characters");
		                        $("#checkMarkNew").css("display", "none");
		                        $("#closeMarkNew").css("display", "block");
		                        //		                    alert("Password at least 8 Characters");
		                    } else if (r == 2) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password maximum 20 Characters!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 3) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password maximum 20 Characters!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 4) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password must include at least one number!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 5) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password must include at least one small letter!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 6) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password must include at least one capital letter!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 7) {
		                        $("#newPass").closest("div").addClass("has-error");
		                        $("#checkNewPass").html("*Password must include at least one symbol!");
		                        $("#checkMarkNew").css("display", "none");
		                    } else if (r == 0) {
		                        newPass = true;
		                        $("#newPass").closest("div").addClass("has-success");
		                        $("#checkMarkNew").css("display", "block");
		                        $("#closeMarkNew").css("display", "none");
		                        $("#checkNewPass").html("");

		                    }
		                    $("#checkNewPass").css("color", "red");
		                    enableSubmitButton();
		                }

		            });
		        } else {
		            newPass = false;
		            $("#newPass").closest("div").removeClass("has-error");
		            $("#checkMarkNew").css("display", "none");
		            $("#checkNewPass").html("");
		            $("#closeMarkNew").css("display", "none");
		        }


		    })

		    $("#confirmPass").keyup(function() {
		        var conPassword = $(this).val();
		        var newPassword = $("#newPass").val();

		        conPass = false;
		        if (conPassword != "") {
		            if (conPassword == newPassword) {
		                conPass = true;
		                $("#checkMarkConfirm").css("display", "block");
		                $("#confirmPass").closest("div").addClass("has-success");
		            }
		        }
		        enableSubmitButton();
		    });

		    function enableSubmitButton() {
		        if (oldPass && newPass && conPass) {
		            $("#submitButton").prop("disabled", false);
		        } else {
		            $("#submitButton").prop("disabled", true);
		        }
		    }

		    $("#submitButtonForm").submit(function() {
		        event.preventDefault();
		        var con = confirm("Are you sure ?");
		        if (con) {
		            var allPass = $("#submitButtonForm").serialize();

		            $.ajax({
		                url: "lib/ajax_change_password.php",
		                method: "POST",
		                data: allPass,
		                success: function(result) {
		                    if (result == 1) {
		                        $("#success").addClass("has-success");
		                        $("#success").html("password change success");
		                        $("#success").fadeIn("slow");
		                        $("#oldPass").val("");
		                        $("#newPass").val("");
		                        $("#confirmPass").val("");
		                        $("#checkMark").css("display", "none");
		                        $("#checkMarkNew").css("display", "none");
		                        $("#checkMarkConfirm").css("display", "none");
		                        $("#oldPass").closest("div").removeClass("has-success");
		                        $("#newPass").closest("div").removeClass("has-success");
		                        $("#confirmPass").closest("div").removeClass("has-success");

		                        setTimeout(function() {
		                            $('#success').fadeOut('slow');
		                        }, 3000);
		                    }
		                }
		            });

		            //		            console.log(allPass);
		        }

		    })

		</script>

		<?php
}

?>

		<?php

if($uri_parts[0] == '/password_change_all.php'){
    ?>

		<script>
             $(document).ready(function() {
		        $('#userListForPassChange').DataTable({
		            "order": [
		                [0, "asc"]
		            ]
		        });
		    });
            
            $(".editStaffPassword").click(function(){
                var userId = $(this).attr('id');
                
                console.log(userId);
                
            });
		</script>

		<?php
}

?>


		<style type="text/css">
		    .panel-heading {
		        background:  !important;

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
