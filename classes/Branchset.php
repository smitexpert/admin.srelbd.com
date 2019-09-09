<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Branchset
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert country
	public function insertBranch($fromdata){

		$Branchname=$this->format->validation($fromdata['Branchname']);
		$Branchname = mysqli_real_escape_string($this->db->link,$Branchname);

		$Branchmail=$this->format->validation($fromdata['Branchmail']);
		$Branchmail = mysqli_real_escape_string($this->db->link,$Branchmail);

		$Branchcontact=$this->format->validation($fromdata['Branchcontact']);
		$Branchcontact = mysqli_real_escape_string($this->db->link,$Branchcontact);		

		$Branchaddr=$this->format->validation($fromdata['Branchaddr']);
		$Branchaddr = mysqli_real_escape_string($this->db->link,$Branchaddr);

		$Branchman=$this->format->validation($fromdata['Branchman']);
		$Branchman = mysqli_real_escape_string($this->db->link,$Branchman);

		$BranchStatus=$this->format->validation($fromdata['BranchStatus']);
		$BranchStatus = mysqli_real_escape_string($this->db->link,$BranchStatus);		

		$Branchabout=$this->format->validation($fromdata['Branchabout']);
		$Branchabout = mysqli_real_escape_string($this->db->link,$Branchabout);

		$date = date("j/n/Y");

		if (!empty($Branchname) || !empty($Branchmail) || !empty($Branchcontact) || !empty($Branchaddr) || !empty($Branchman) || !empty($BranchStatus) || !empty($Branchabout) || !empty($date)) {

			$selectq = "SELECT * FROM tbl_branch WHERE branch_name='$Branchname' AND branch_contact='$Branchcontact' AND branch_email='$Branchmail'";

			$runselectq =$this->selectBranch($selectq);
			if ($runselectq !=false) {
				return $msg = "Branch already exist";
			}else{
			 	$query="INSERT INTO tbl_branch (branch_name,branch_contact,branch_email,branch_address,branch_about,branch_status,dated) VALUES ('$Branchname','$Branchcontact','$Branchmail','$Branchaddr','$Branchabout','$BranchStatus','$date')";
				$insres=$this->db->insert($query);
                
                //get branch id from tbl_branches
                
                $selectBranchId = "SELECT branch_id FROM tbl_branch WHERE branch_name = '$Branchname'";
                $selectId = $this->db->insert($selectBranchId);
                $id = "";
                
                while($row = $selectId->fetch_assoc()){
                   $id = $row['branch_id']; 
                }
                
                $queryManager="INSERT INTO branch_managers (branch_id, manager_id, status) VALUES ('$id','$Branchman','1')";
				$insert2=$this->db->insert($queryManager);
                
                
			if ($insres) {
				$msg="<span class='msgbar'>insertion successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>insertion failed</span>";
				return $msg;
			}
		}
		}else{
				$msg="<span class='msgbar'> Fields must not be empty</span>";
				return $msg;
		}


	}




//view country
	public function selectBranch($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
		}
	}


//edit  cat name;
	public function editBranch($brandname,$brandid){
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
	public function deleteBranch($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>Branch successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Branch delete</span>";
				return $msg;
			}
		}
	}





}

 ?>