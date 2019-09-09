<?php

    $currentPage = $_SERVER['REQUEST_URI'];

    require_once __DIR__.'/../lib/Database.php';
    
    $user_menu = 'menu_'.Session::get('adminId');

    

    $menu = new Database();
    $query = "SELECT * FROM menu_sidebar";
    $selectMenu = $menu->select($query);

    /*while($row = $selectMenu->fetch_assoc()){
        echo $row['menuName'];
    }*/

?>
            <br>

			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					<!-- start: MAIN NAVIGATION MENU -->
					
					<nav>
					<ul id="nav" class="main-navigation-menu">

						<li class="linav">
							<!--<a href="javascript:void(0)"><i class="clip-pencil"></i>
								<span class="title"> Creation Area</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul  class="sub-menu">
								<li class="acli">
									<a href="create_weight.php">
										<span class="title">Create Weight</span>
									</a>
								</li>
								<li>
									<a href="createRoute.php">
										<span class="title">Create Route</span>
									</a>
								</li>								
								<li>
									<a href="add_country.php">
										<span class="title">Create Country</span>
									</a>
								</li>	
								<li>
									<a href="createCourierCompany.php">
										<span class="title">Create Courier Company</span>
									</a>	
								</li>									

								<li>
									<a href="create_stuff.php">
										<span class="title">Create Stuff</span>
									</a>
								</li>								

								<li>
									<a href="createBranch.php">
										<span class="title">Create Branch</span>
									</a>
								</li>									

								<li>
									<a href="createDesignation.php">
										<span class="title">Create Designation</span>
									</a>
								</li>					

							</ul>
						</li>-->							


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-screen"></i>
								<span class="title"> Consignment Area</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_consignment_booking.php">
										<span class="title">Consignment Booking</span>
									</a>
								</li>
								<li>
									<a href="client_consignment_list.php">
										<span class="title">Consignment List</span>
									</a>
								</li>								

								<li>
									<a href="client_consignment_history.php">
										<span class="title">Consignment History</span>
									</a>
								</li>	

							</ul>
						</li>						


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Price Settings</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_view_price.php">
										<span class="title">View Genarel Price</span>
									</a>
								</li>
								<li>
									<a href="client_view_special_price.php">
										<span class="title">View Special Price</span>
									</a>
								</li>
							</ul>
						</li>					


						<li class="linav">
							<a href="client_accounts.php"><i class="clip-screen"></i>
								<span class="title">Accounts</span>
							</a>
				        </li>						


						<li class="linav">
							<a href="javascript:void(0)"><i class="clip-user-2"></i>
								<span class="title">Settings</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a class="nav" href="client_change_name.php">
										<span class="title">Change Name</span>
									</a>
								</li>
								<li>
									<a href="client_change_password.php">
										<span class="title">Change Password</span>
									</a>
								</li>

							</ul>
						</li>						



						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Manifest Area </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="menifest_cons_srch.php">
										<span class="title">Principal CSV Create</span>
									</a>
								</li>

								<li>
									<a href="prinicpal_menifest.php">
										<span class="title">Principal Menifest</span>
									</a>
								</li>

							</ul>
						</li>-->




						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-user-2"></i>
								<span class="title"> Corporate Clients Area</span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="corpo_client.php">
										<span class="title">Create Corporate Client</span>
									</a>
								</li>
								
								<li>
									<a href="corpo_client_price_dtails.php">
										<span class="title">Corporate Client Prices Details</span>
									</a>
								</li>

								<li>
									<a href="corpo_client_list.php">
										<span class="title">Corporate Client list</span>
									</a>
								</li>								

							</ul>
						</li>-->


						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-location"></i>
								<span class="title"> Route Settings </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="rout_list.php">
										<span class="title">Route list</span>
									</a>
								</li>

							</ul>
						</li>-->



						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Country Settings </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="country_list.php">
										<span class="title">Country list</span>
									</a>
								</li>
							</ul>
						</li>-->



						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-bars"></i>
								<span class="title"> General price Settings </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="add_route_price.php">
										<span class="title">Set General Price With Route</span>
									</a>
								</li>	
							</ul>
						</li>	-->

						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-bars"></i>
								<span class="title"> Principal price Settings </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								
								<li>
									<a href="set_principal_route.php">
										<span class="title">Principal Settings</span>
									</a>									
 									<a href="add_principal_price.php">
										<span class="title">Set Principal Price</span>
									</a> 

									<a href="search_prinicpal_price.php">
										<span class="title">Search Prinicipal Price</span>
									</a> 									

									<a href="srch_principrice_by_weight.php">
										<span class="title">Search by Weight</span>
									</a> 
								</li>	
							</ul>
						</li>-->							



						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-bars"></i>
								<span class="title"> Stuff Settings </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								
								<li>
									<a href="stuff_list.php">
										<span class="title">Stuff List</span>
									</a>									

									<a href="search_stuff.php">
										<span class="title">Search Stuff</span>
									</a> 
								</li>	
							</ul>
						</li>	-->					

						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Branch Area </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="branch_list.php">
										<span class="title">Branch List</span>
									</a>
								</li>
							</ul>
						</li>-->

						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-grid-6"></i>
								<span class="title"> Designation Area </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">

								<li>
									<a href="designation_list.php">
										<span class="title">Designation List</span>
									</a>
								</li>
							</ul>
						</li>-->

						<!--<li class="linav">
							<a href="javascript:void(0)"><i class="clip-cog-2"></i>
								<span class="title"> Accounts </span><i class="icon-arrow"></i>
								<span class="selected"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="accounts_summery.php">
										<span class="title">Accounts Summery</span>
									</a>
								</li>								

								<li>
									<a href="accounts_corporate.php">
										<span class="title">Corporate Accounts</span>
									</a>
								</li>	


								<li>
									<a href="accounts_principal.php">
										<span class="title">Principal's Account</span>
									</a>
								</li>
								<li>
									<a href="account_assignee_cour.php">
										<span class="title">Corporate assignee Accounts</span>
									</a>
								</li>	

								<li>
									<a href="accounts_stuff_market.php">
										<span class="title">Market Stuff Accounts</span>
									</a>
								</li>
							

								<li>
									<a href="accounts_search.php">
										<span class="title">Accounts Search</span>
									</a>
								</li>	
							</ul>
						</li>-->

					</ul>
					</nav>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>