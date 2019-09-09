<?php 
include('includes/header.php');
	// $query = "SELECT s.*,d.designation_title FROM tbl_stuff as s,tbl_designation as d
	//  WHERE s.stuff_designation = d.id AND stuff_status=1 ORDER BY created_at DESC";
//	$query = "SELECT * FROM user WHERE rule != '1' ORDER BY userId DESC";
	$query = "SELECT user.*, user_rule.ruleName FROM user LEFT JOIN user_rule ON user.rule = user_rule.ruleId WHERE rule != '1' ORDER BY userId DESC";
    $result = $db->select($query);

//get name form user table using by user ID
function getUserName($userId){
    $db = new Database();
    
    $getUserName = "SELECT name FROM user WHERE userId = '$userId'";
    $getName  = $db->link->query($getUserName);
    
    $row = $getName->fetch_row();
    $finalName = $row[0];
    
    return $finalName;    
    
}
?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <?php include('includes/sidebar-menu.php'); ?>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class="container"><br><br>
            <!-- end: PAGE HEADER -->
            <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- start: FORM VALIDATION 1 PANEL -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-external-link-square"></i>
                            STAFF PASSWROD CHANGE WINDOW
                        </div>

                        <div class="panel-body">
                            <table id="userListForPassChange" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Employee ID</th>
                                        <th style="text-align:center">Name</th>
                                        <th style="text-align:center">Designation</th>
                                        <th style="text-align:center">Email</th>
                                        <th style="text-align:center">Change Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            while($row = $result->fetch_assoc()){
                                                
                                                if($row['status'] == 0){
                                                    $btn_color = 'btn_red';
                                                }else{
                                                    $btn_color = 'btn_green';
                                                }
                                                
                                                $btn_disabled = '';
                                                
                                                /*if(Session::get('adminId') == $row['userId']){
                                                    $btn_disabled = 'hidden';
                                                }*/
                                                
                                                
                                                
                                                if($row['userId'] == '000000'||$row['userId'] == '190402')
                                                    continue;

                                                ?>

                                    <tr>
                                        <td><?php echo $row['userId'] ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['ruleName'] ?></td>
                                        <td><?php echo $row['email'] ?></td>

                                        <td style="text-align:center" ;><button type="button" class="btn btn-xs btn-teal editStaffPassword" data-toggle="modal" data-target="#editStaffPassword" id="<?php echo $row['userId']; ?>"><i class="fa fa-key"></i></button>
                                        </td>
                                    </tr>

                                    <?php
                                            }

                                            ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <!-- end: FORM VALIDATION 1 PANEL -->
            </div>
        </div>
        <!-- end: PAGE CONTENT-->
    </div>
</div>
<!-- end: PAGE -->
<!--Start Modal code for editing Plant information-->
<div class="">
    <div class="modal modal-dialog modal-lg fade" id="editStaffPassword" role="dialog">

        <!-- Modal content-->
        <div class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">UPDATE PASSWORD OF <?php echo getUserName($row['userId']); ?></h4>
            </div>
            <div class="modal-body">
                <form action="" id="updateStaffPassword">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">NEW PASSWORD:<span class="symbol required"></span></label>
                                    <input type="password" class="form-control" name="newPass" id="newPass" required>
                                    <span id="checkNewPass"></span>
                                    <div id="checkMarkNew" style="position: absolute;top: 27px;right: 22px;color: green; display:none"><span class="fa fa-check"></span></div>
                                    <div id="closeMarkNew" style="position: absolute;top: 27px;right: 22px;color: red; display:none"><span class="fa fa-times"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">CONFIRM PASSWORD:<span class="symbol required"></span></label>
                                    <input type="password" class="form-control" name="confirmPass" id="confirmPass" required>
                                    <div id="checkMarkConfirm" style="position: absolute;top: 27px;right: 22px;color: green; display:none"><span class="fa fa-check"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="text-align:center; color:green">
                            <div id="success" style="dispaly:none">

                            </div>
                        </div>


                    </div>
                    <input type="submit" value="UPDATE PASSWORD" class="btn btn-sm btn-success btn-block">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--End Modal code for editing Plant information-->



<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>


<!--
<script type="text/javascript">
    jQuery(document).ready(function($) {


        $('#stufflistTbl').DataTable({
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



    });

</script>
-->
