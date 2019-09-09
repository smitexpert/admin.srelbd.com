<?php 
include('includes/header.php');
	// $query = "SELECT s.*,d.designation_title FROM tbl_stuff as s,tbl_designation as d
	//  WHERE s.stuff_designation = d.id AND stuff_status=1 ORDER BY created_at DESC";
	$query = "SELECT user.*, user_rule.ruleName FROM user LEFT JOIN user_rule ON user.rule = user_rule.ruleId WHERE rule != '1' ORDER BY userId DESC";
    $result = $db->select($query);
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
									STAFF TERMINAL WINDOW
								</div>

								<div class="panel-body">
									<table id="userTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Reg Date</th>
                                                <th>Action</th>
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
                                                
                                                if((Session::get('adminId') == $row['userId']) || $row['rule'] < '5' ){
                                                    $btn_disabled = 'disabled';
                                                }
//                                                
//                                                
//                                                
//                                                if($row['userId'] == '000000'||$row['userId'] == '190402')
//                                                    continue;

                                                ?>

                                                <tr>
                                                    <td><?php echo $row['userId'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['ruleName'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['contact1'] ?></td>
                                                    <td><?php echo $row['createDate'] ?></td>
                                                    <td><span class="btn-my <?php echo $btn_color; ?>">
                                                        <button id="<?php echo $row['userId'] ?>" class="status_btn" <?php echo $btn_disabled; ?> >
                                                        <span class="fa fa-check-square"></span>
                                                        </button>
                                                    </span>
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


		
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>


<script type="text/javascript">
jQuery(document).ready(function($) {


    $('#stufflistTbl').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
					column.data().unique().sort().each( function ( d, j ) {
					    if(column.search() === '^'+d+'$'){
					        select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
					    } else {
					        select.append( '<option value="'+d+'">'+d+'</option>' )
					    }
					} );
            } );
        }
    } );



});
</script>