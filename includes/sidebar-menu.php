<?php

$currentPage = $_SERVER['REQUEST_URI'];

require_once __DIR__.'/../lib/Database.php';

$user_menu = 'menu_'.Session::get('adminId');
$user_menu = strtolower($user_menu);



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


                <?php
                                               
                        if(Session::get('role') == 1){
                            ?>

                <li class="<?php if($currentPage == '/addadmin.php'){ echo 'active open'; } ?>">
                    <a href="addadmin.php"><i class="clip-link"></i>
                        <span class="title">Add Admin User</span><span class="selected"></span>
                    </a>
                </li>

                <li class="<?php if($currentPage == '/addmenu.php'){ echo 'active open'; } ?>">
                    <a href="addmenu.php"><i class="clip-link"></i>
                        <span class="title">Add Menu</span><span class="selected"></span>
                    </a>
                </li>


                <!--                Start Staff Management menu -->

                <?php
                            
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='staff-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-users"></i>
                        <span class="title">Staff Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                            
                    ?>
                <!--    End Staff Management Code            -->
                
                
                <!--        Start Branch Management Code     -->
                <?php         
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='branch-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-globe"></i>
                        <span class="title">Branch Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                ?>

                <!-- end Branch management-->
                
                
                <!--  Start Stock Management -->

                <?php         
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='stock-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-stack"></i>
                        <span class="title">Stock Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                ?>

                <!-- end Stock management-->
                

                <!--   Start Agent Management menu -->

                <?php
                            
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='agent-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-user"></i>
                        <span class="title">Agent Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                            
                    ?>
                <!--    End Agent Management Code            -->
                
                
                <!--    Start Plant Mangement Section Code          -->


                
                <?php                          
                            
                            
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='plant-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="fa fa-home"></i>
                        <span class="title">Plant Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
            <?php
                 }
            ?>
                
                <!--    End Plant Mangement Code          -->
                
                <!--    Start Accounts Section Code          -->


                
                <?php                          
                            
                            
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='accounts'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="fa fa-bank"></i>
                        <span class="title">Accounts</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
            <?php
                 }
            ?>
                
                <!--    End Accounts Section Code          -->
                
                <!--    Start Settings Section Code          -->
                <?php              
                            
                            
                            
                            
                            $superCreationAreaQuery = "SELECT * FROM menu_sidebar WHERE menuIndex='settings'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-settings"></i>
                        <span class="title">Settings</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }



                        }else{
                            ?>
                <li class="<?php if($currentPage == '/dashboard.php'){ echo 'active open'; } ?>">
                    <a href="dashboard.php"><i class="clip-grid"></i>
                        <span class="title">Dashboard</span><span class="selected"></span>
                    </a>
                </li>


                <!--//  Start Stuff Management menu -->

                <?php
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='staff-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);

                                ?>
                <li class="linav">
                    <a href="javascript:void(1)"><i class="clip-users"></i>
                        <span class="title">Staff Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                ?>
                <!--End Staff Management Menu-->

                <!--        Start Branch Management Code     -->
                <?php         
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='branch-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-home"></i>
                        <span class="title">Branch Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }
                        ?>


                    </ul>
                </li>
                <?php

                            }
                ?>
                <!-- End Branch management-->

                <!--    Start Stock Management -->

                <?php         
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='stock-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-data"></i>
                        <span class="title">Stock Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?>">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                                        ?>


                    </ul>
                </li>
                <?php

                            }
                ?>
                <!-- End Stock Management -->

                <!--  Start Agent Management-->
                <?php
                                                    
                            
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='agent-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="fa fa-male"></i>
                        <span class="title">Agent Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }
                        ?>



                    </ul>
                </li>
                <?php

                            }
                        ?>
                <!-- End Agent Management -->
                
                <!--  Start Plant Management-->
                <?php
                                                    
                            
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='plant-management'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="fa fa-fire"></i>
                        <span class="title">Plant Management</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }
                        ?>



                    </ul>
                </li>
                <?php

                            }
                        ?>
                <!-- End Plant Management -->
                

                <!--  Start Accounts Management-->
                <?php
                            
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='accounts'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="fa fa-money"></i>
                        <span class="title">Accounts</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                        ?>

                    </ul>
                </li>
                <?php

                            }
                ?>
                <!-- End Accounts Management -->

                <!--  Start Settings Management-->
                <?php
                            
                            
                            $superCreationAreaQuery = "SELECT * FROM $user_menu WHERE menuIndex='settings'";

                            $creationAreaCount = $menu->count($superCreationAreaQuery);

                            if($creationAreaCount[0] > 0) {

                                $creationAreaMenu = $menu->select($superCreationAreaQuery);


                                ?>
                <li class="linav">
                    <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                        <span class="title">Settings</span><i class="icon-arrow"></i>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php

                                        while($creationAreaRow = $creationAreaMenu->fetch_assoc()){
                                            ?>


                        <li class="acli  <?php if($currentPage == '/'.$creationAreaRow['menuUrl']){ echo 'active'; } ?> ">
                            <a href="<?php echo $creationAreaRow['menuUrl']; ?>">
                                <span class="title"><?php echo $creationAreaRow['menuName']; ?></span>
                            </a>
                        </li>

                        <?php
                                        }


                        ?>


                    </ul>
                </li>
                <?php

                            }                        
                            
                        }

                        ?>

            </ul>
        </nav>
        <br>
        <br>
        <br>
        <!-- end: MAIN NAVIGATION MENU -->
    </div>
    <!-- end: SIDEBAR -->
</div>