<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Accounts
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert client info to client account table
	public function coropoCollectioninsert($formdata){

		$collection=$this->format->validation($formdata[0]['collection']);
		$collection = mysqli_real_escape_string($this->db->link,$collection);		

		$corposenderid=$this->format->validation($formdata[1]);
		$corposenderid = mysqli_real_escape_string($this->db->link,$corposenderid);

		$corpoclienttype=$this->format->validation($formdata[2]);
		$corpoclienttype = mysqli_real_escape_string($this->db->link,$corpoclienttype);

		$corpoclientname=$this->format->validation($formdata[3]);
		$corpoclientname = mysqli_real_escape_string($this->db->link,$corpoclientname);		
		$date = date("j/n/Y");

		if (!empty($corposenderid) || !empty($corpoclienttype) || !empty($collection) || !empty($corpoclientname)) {

				//$selectq = "SELECT client_id,client_type,client_name FROM tbl_account_corporate";
				//$runselectq =$this->selectAccount($selectq);
				//if ($runselectq !=false) {
					// $query ="INSERT INTO tbl_account_corporate (amount_collection,date) VALUES ('$collection',NOW())";
					// $updateq=$this->db->insert($query);
					// if ($updateq) {
					// 	$msg="<span class='msgbar'>Collection submition successfull</span>";
					// 	return $msg;
					// }else{
					// 	$msg = "<span class='msgbar'>Collection submition failed</span>";
					// 	return $msg;
					// }
				//}//else{
			 	$query="INSERT INTO tbl_account_corporate (client_id,client_type,client_name,amount_collection,date) VALUES ('$corposenderid','$corpoclienttype','$corpoclientname','$collection','$date')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>collection submition successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>Collection submition failed</span>";
				return $msg;
			}
		//}
		}else{
				$msg="<span class='msgbar'> Something went wrong</span>";
				return $msg;
		}


	}


//view country
	public function selectAccount($query){
		if (!empty($query)) {
			$selectCorpoClientAmount = $this->db->select($query);
			if ($selectCorpoClientAmount) {
				return $selectCorpoClientAmount;
			}
		}
	}






//insert into principal account table
	public function principalCollectionInsert($formdata){

		$collection=$this->format->validation($formdata[0]['collection']);
		$collection = mysqli_real_escape_string($this->db->link,$collection);		

		$corposenderid=$this->format->validation($formdata[1]);
		$corposenderid = mysqli_real_escape_string($this->db->link,$corposenderid);

		$corpoclienttype=$this->format->validation($formdata[2]);
		$corpoclienttype = mysqli_real_escape_string($this->db->link,$corpoclienttype);

		$corpoclientname=$this->format->validation($formdata[3]);
		$corpoclientname = mysqli_real_escape_string($this->db->link,$corpoclientname);		
		$date = date("j/n/Y");

		if (!empty($corposenderid) || !empty($corpoclienttype) || !empty($collection) || !empty($corpoclientname)) {

			//$selectq = "SELECT client_id,client_type,client_name FROM tbl_account_corporate";
			//$runselectq =$this->selectAccount($selectq);
			//if ($runselectq !=false) {
				// $query ="INSERT INTO tbl_account_corporate (amount_collection,date) VALUES ('$collection',NOW())";
				// $updateq=$this->db->insert($query);
				// if ($updateq) {
				// 	$msg="<span class='msgbar'>Collection submition successfull</span>";
				// 	return $msg;
				// }else{
				// 	$msg = "<span class='msgbar'>Collection submition failed</span>";
				// 	return $msg;
				// }
			//}//else{
			 	$query="INSERT INTO tbl_account_principal (client_id,client_type,client_name,amount_collection,date) VALUES ('$corposenderid','$corpoclienttype','$corpoclientname','$collection','$date')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>collection submition successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>Collection submition failed</span>";
				return $msg;
			}
		//}
		}else{
				$msg="<span class='msgbar'> Something went wrong</span>";
				return $msg;
		}


	}





//edit  cat name;
	public function editBrand($brandname,$brandid){
		$brandname = $this->format->validation($brandname);
		$brandname = mysqli_real_escape_string($this->db->link,$brandname);

		if (!empty($brandname) && !empty($brandid)) {
			$query = "UPDATE tbl_brands SET brandname='$brandname' WHERE brandId = '$brandid'";
			$queryres=$this->db->Update($query);
			if ($queryres) {
				$msg="<span class='msgbar'>update successfull</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>update failed</span>";
				return $msg;
			}
		}else{
			header('Location:brandlist.php');
		}

	}


//delet category
	public function deleteBrand($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>brand successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Cannot delete</span>";
				return $msg;
			}
		}
	}





}

