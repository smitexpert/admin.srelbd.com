<?php
//include_once ('/../config/Config.php');
require_once __DIR__."/../config/Config.php";
$link="";
$error="";

class Database
{
	public $host= "localhost";
	public $user= "srelbdco_mahsin";
	public $pass= "pIAv5Zsr}U?L";
	public $database= "srelbdco_srel";


	function __construct()
	{
		$this->connectDB();
	}



//db connection process
	public function connectDB(){
		$this->link = new mysqli($this->host,$this->user,$this->pass,$this->database);
		if (!$this->link) {
			$this->error = "Database connection failed".$this->link->connect_error;
			return false;
		}else{}
	}



//Insert
	public function insert($query){
		$insres=$this->link->query($query)or die($this->link->error.__LINE__);
		if ($insres) {
			return $insres;
		}else{
			return false;
		}
	}





//Select
	public function select($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($result->num_rows > 0) {
				return $result;
			}else{
				return false;
				echo "failed select";
			}
		
	}



//Edit 

	public function Update($query){
		$result = $this->link->query($query)or die($this->link->error.__LINE__);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}


//delet

	public function Delete($query){
		$deleting=$this->link->query($query);
		if ($deleting) {
			return $deleting;
		}else{
			return false;
		}

	}
    
    
//count
    
    public function Count($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        $row = $result->fetch_row();
        return $row;
    }
    
    
    
    public function CuntMenu($menu){
        $checkMenuQuery = "SELECT id FROM menu_sidebar WHERE menuIndex='$menu'";
        $checkMenu = $this->Count($checkMenuQuery);
        
        if($checkMenu[0] > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function Menus($menu){
        
        $queryMenu = "SELECT * FROM menu_sidebar WHERE menuIndex='$menu'";
            
        $result = $this->link->query($queryMenu) or die($this->link->error.__LINE__);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return false;
            echo "failed select";
        }
    }
    
    
    public function MenuUser($url, $userId){
        $userId = strtolower($userId);
        $query = "SELECT * FROM menu_$userId WHERE menuUrl='$url'";
        
        $count = $this->Count($query);
        
        if($count[0] > 0){
            return 'checked';
        }else{
            return '';
        }
    }
    
    
    public function getUserName($userid){
        $query = "SELECT name FROM user WHERE userId='$userid'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    
    public function getClientEmail($id){
        $query = "SELECT email FROM corporate_clients WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function getInvoice(){
        $query = "SELECT id from invoice_no order by id DESC";
        $result = $this->link->query($query);
        $result = $result->fetch_row();
        return $result;
    }
    
}

?>