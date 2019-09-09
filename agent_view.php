<?php 
include('includes/header.php');
	$query = "SELECT * FROM agent ORDER BY id ASC";
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
									AGENT LIST
								</div>

								<div class="panel-body">
									<table id="agentTable" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Contact1</th>
                                                <th>Contact2</th>
                                                <th>Create Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           if($result){
                                               $serial = 1;
                                               while($row = $result->fetch_assoc()){

                                                ?>

                                                <tr>
                                                    <td style="text-align:center"><?php echo $serial; ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $row['address'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['contact1'] ?></td>
                                                    <td><?php echo $row['contact2'] ?></td>
                                                    <td><?php echo $row['created_date'] ?></td>
                                                    
                                                </tr>

                                                <?php
                                                $serial++;
                                            }}else{
                                                
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


<!--
<script type="text/javascript">
jQuery(document).ready(function($) {


    $('#agentlistTbl').DataTable( {
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
</script>-->
