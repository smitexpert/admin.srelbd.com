<?php 
include('includes/header.php'); 
	$query = "SELECT * FROM tbl_country WHERE status=1 ORDER BY country_name ASC";
    $selectCountry = $Countryset->selectCountry($query);
if (isset($_POST['submit'])) {
    $insertcountry = $Countryset->insertCountry($_POST);
}
?>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>


			<!-- start: PAGE -->
			<div class="main-content">
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container"><br><br><br><br>
					<!-- end: PAGE HEADER -->
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<!-- start: FORM VALIDATION 1 PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>ACCOUNTS MODULE AT A GLANCE
								</div>
								<div class="panel-body">
									
									<div class="row">
										<div class="col-md-12">
										<?php 
											if (isset($insertcountry)) { ?>
												<div class="alert alert-info fade in">
												    <a href="#" class="close" data-dismiss="alert">&times;</a>
												    <strong><?php echo $insertcountry; ?></strong>
												</div>
										<?php } ?>
										</div>
									</div>

								</div>
							</div>
							<!-- end: FORM VALIDATION 1 PANEL -->
						</div>
						<div class="col-md-1"></div>
					</div>

					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->


		</div>
		<!-- end: MAIN CONTAINER -->


<?php 
include('includes/footer.php');
?>

<script type="text/javascript">
	$(document).ready(function(){

// 	$("#route_code").change(function(){
// 		event.preventDefault();
// 		getGenVal();
// 	});

// 	function getGenVal(){
// 	   $.ajax({  
//         url:"get_gen_price.php",  
//         method:"POST",  
//         //data:{incomeid:incomeid, income_value:income_value},  
// 		//dataType: "JSON",
//         success:function(data){  
//              //alert(data[3]);
             
//              $('#countryName').val(data[2]);
//              //alert(data);  
//         }  
//    		});  
		
// 	}


})
</script>
