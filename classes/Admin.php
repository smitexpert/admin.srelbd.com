<?php 
ob_start();
//include('/../lib/Session.php');
require __DIR__."/../lib/Session.php";
Session::checkLogin();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";
/**
* Admin class
*/

class Admin{

	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


	public function adminLogin($adminEmail,$adminPassword){



		$adminEmail 	= $this->format->validation($adminEmail);
		$adminPassword 	= $this->format->validation($adminPassword);

		$adminEmail 	= mysqli_real_escape_string($this->db->link, $adminEmail);
		$adminPassword  = mysqli_real_escape_string($this->db->link, $adminPassword);


		if (empty($adminEmail) || empty($adminPassword)) {
			$loginmsg = "Name or Password field must not be empty";
			return $loginmsg;
		}else
		{
			$pasMd = $adminPassword;
            $userMenu = strtolower($adminEmail);

			$query="SELECT * FROM user WHERE userId ='$userMenu' AND password='$pasMd'";
			$finalres=$this->db->select($query);
			
			
			if ($finalres !=false) {
				$adminInfo=$finalres->fetch_assoc();
				Session::set('login', true);
				Session::set('adminId',$adminInfo['userId']);
				Session::set('adminUser',$adminInfo['name']);
				Session::set('adminEmail',$adminInfo['email']);
				Session::set('role',$adminInfo['rule']);
                
                
                if($adminInfo['rule'] != 1){
                    
                    
                    $queryTotalMenu = "SELECT COUNT(id) FROM menu_$userMenu";
                    $resultTotalMenu = $this->db->link->query($queryTotalMenu);
                    $rowTotalMenu = $resultTotalMenu->fetch_row();
                    
                    
                    
                    if($rowTotalMenu[0] != 0){
                        $countMenu = "SELECT * FROM menu_$userMenu";
                    
                        $totalMenuQuery = $this->db->Select($countMenu);

                        $i = 0;

                        while($totalMenu = $totalMenuQuery->fetch_assoc()){
                            $menuArry[$i] = $totalMenu['menuUrl'];
                            $i++;
                        }

                        Session::set('menus', $menuArry);
                    }else{
                        Session::set('menus', '');
                    }
                    
                }
                
                

				// $loginmsg= $adminInfo['id']." ".$adminInfo['userId']." ".$adminInfo['name']." ".$adminInfo['email']." ".$adminInfo['rule']." ".$adminInfo['contact1']." ".$adminInfo['contact2']." ".$adminInfo['password']." ".$adminInfo['address']." ".$adminInfo['createDate'] ;
				// return $loginmsg;

//CHECKING FOR USER ROLE ADN REDIRECTING TO CORRESPONDING PAGE
				/*if ($adminInfo['rule'] == 1) {
					header('Location:dashboard.php');

				}else{
					
				}*/
                
                
                header('Location:dashboard.php');

				


			}else{
				$loginmsg="Login fail, name or password not matched ";
				return $loginmsg;
			}


		}
	}
    
    public function clientLogin($clientEmail, $clientPassword){
        $clientEmail 	= $this->format->validation($clientEmail);
		$clientPassword 	= $this->format->validation($clientPassword);

		$clientEmail 	= mysqli_real_escape_string($this->db->link,$clientEmail);
		$clientPassword  = mysqli_real_escape_string($this->db->link,$clientPassword);
        
        if (empty($clientEmail) || empty($clientPassword)) {
			$loginmsg = "Name or Password field must not be empty";
			return $loginmsg;
		}else{
            $query="SELECT * FROM corporate_clients WHERE email ='$clientEmail' AND password='$clientPassword' AND status=1";
			$finalres=$this->db->select($query);
            
            if ($finalres !=false) {
                $clientInfo = $finalres->fetch_assoc();
                Session::set('ClientLogin', true);
                Session::set('ClientID', $clientInfo['id']);
                Session::set('ClientEmail', $clientInfo['email']);
                Session::set('ClientName', $clientInfo['name']);
                Session::set('ClientCompanyName', $clientInfo['company_name']);
                
                header('Location:clientdashboard.php');
            }else{
                $loginmsg="Login fail, name or password not matched ";
				return $loginmsg;
            }
        }
    }

}

 ?>
 