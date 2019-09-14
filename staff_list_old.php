<?php 
include('includes/header.php');
//	$query = "SELECT * FROM user WHERE rule != '1' AND rule != '2' ORDER BY userId DESC";
    // $query = "SELECT * FROM user WHERE rule != '1' AND rule != '2' AND status = '0' ORDER BY rule ASC";
    // $query = "SELECT DISTINCT user.*, ex_employee.terminal_date FROM user INNER JOIN ex_employee ON user.userId = ex_employee.userId WHERE rule != '1' AND rule != '2' AND status = '0' ORDER BY rule ASC";
    $query = "SELECT DISTINCT ex_employee.userId, ex_employee.terminal_date, user.* FROM ex_employee INNER JOIN user ON ex_employee.userId = user.userId WHERE user.rule != '1' AND user.rule != '2' AND user.status = '0' ORDER BY ex_employee.terminal_date DESC";
    $result = $db->select($query);

    function getDesignation($dId){
        $designation = $dId;
        $db = new Database();
        
        $queryD = "SELECT ruleName from user_rule where ruleId = '$dId'";
        $query = $db->link->query($queryD);
        
        $designation = $query->fetch_row();
        
        return $designation[0];
        
    }
    function getMyTime($timeStamp){

        $myDate = date("d-m-Y", $timeStamp);

        return $myDate;
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
									OLD STAFF LIST
								</div>

								<div class="panel-body">
									<table id="old_staff" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Joining Date</th>
                                                <th>Release Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                            if($result){while($row = $result->fetch_assoc()){
                                                
                                                if($row['status'] == 0){
                                                    $btn_color = 'btn_red';
                                                }else{
                                                    $btn_color = 'btn_green';
                                                }
                                                
                                                $btn_disabled = '';
                                                
                                                if(Session::get('adminId') == $row['userId']){
                                                    $btn_disabled = 'hidden';
                                                }
                                                ?>

                                                <tr>
                                                    <td><?php echo $row['userId']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo getDesignation($row['rule']); ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['contact1']; ?></td>
                                                    <td><?php echo $row['joining_date']; ?></td>
                                                    <td><?php echo getMyTime(strtotime($row['terminal_date'])); ?></td>
                                                </tr>

                                                <?php
                                            }}else{
                                                echo "No Data Found!";
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


