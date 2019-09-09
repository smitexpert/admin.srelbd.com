<?php ob_start(); ?>

<?php 
include('includes/header.php');

$inMenu = new Database();

$getRes = '';

?>

		<!-- start: MAIN CONTAINER -->
<div class="main-container">

<?php include('includes/sidebar-menu.php'); ?>

<?php
    
    if(isset($_POST['menuName'])){
        if($_POST['menuName'] != NULL){
            $menuName = $_POST['menuName'];
            $url = $_POST['url'];
            $section = $_POST['section'];
            
            $query = "INSERT INTO menu_sidebar (menuName, menuUrl, menuIndex) VALUES ( '$menuName', '$url', '$section' )";
            
            $getRes = $inMenu->insert($query);
            
            
            
        }
    }

?>

			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">



<!-- start: STYLE SELECTOR BOX -->
							
<!-- end: STYLE SELECTOR BOX -->



							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="#">
										Home
									</a>
								</li>
								<li class="active">
									Add Menu
								</li>
								<!--<li class="search-box">
									<form class="sidebar-search">
										<div class="form-group">
											<input type="text" placeholder="Start Searching...">
											<button class="submit">
												<i class="clip-search-3"></i>
											</button>
										</div>
									</form>
								</li>-->
							</ol>
							<div class="page-header">
								<h1>Add Menu <small>Super Admin Only</small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<form action="" method="post">
						    <div class="col-sm-4">
                               <?php
                                if($getRes != NULL){
                                    ?>
                                    <div class="alert alert-danger">
                                      <strong>Danger!</strong> <?php echo $getRes; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="menuName" class="control-label">
                                    Menu Name <span class="symbol"></span>
                                    </label>
                                    <input type="text" class="form-control" name="menuName" id="menuName" required>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="control-label">
                                    URL <span class="symbol"></span>
                                    </label>
                                    <input type="text" class="form-control" name="url" id="url" required>
                                </div>
                                <div class="form-group">
                                    <label for="sel1" class="control-label">
                                    Section <span class="symbol"></span>
                                    </label>
                                    <select name="section" class="form-control" id="sel1">
                                        <option value="creation-area">Creation Area</option>
                                        <option value="consignment-area">Consignment Area</option>
                                        <option value="manifest-area">Manifest Area</option>
                                        <option value="corporate-clients-area">Corporate Clients Area</option>
                                        <option value="rote-settings">Route Settings</option>
                                        <option value="country-settings">Country Settings</option>
                                        <option value="general-price-settings">General price Settings</option>
                                        <option value="principal-price-settings">Principal price Settings</option>
                                        <option value="stuff-settings">Stuff Settings</option>
                                        <option value="branch-area">Branch Area</option>
                                        <option value="designation-area">Designation Area</option>
                                        <option value="accounts">Accounts</option>
                                      </select>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="form-control" value="Add">
                                </div>
                            </div>
						</form>
						
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
