<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Designationset
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert country
	public function insertDesignation($fromdata){

		$designationTitle=$this->format->validation($fromdata['designationTitle']);
		$designationTitle = mysqli_real_escape_string($this->db->link,$designationTitle);

		$designationstatus=$this->format->validation($fromdata['designationstatus']);
		$designationstatus = mysqli_real_escape_string($this->db->link,$designationstatus);

		$date = date("j/n/Y");

		if (!empty($designationTitle) || !empty($designationstatus) || !empty($date)) {

			$selectq = "SELECT * FROM tbl_designation WHERE designation_title='$designationTitle'";

			$runselectq =$this->selectDesignation($selectq);
			if ($runselectq !=false) {
				return $msg = "Designation already exist";
			}else{
			 	$query="INSERT INTO tbl_designation (designation_title,status,dated) VALUES ('$designationTitle','$designationstatus','$date')";
				$insres=$this->db->insert($query);
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
	public function selectDesignation($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
		}
	}


//edit  cat name;
	public function editDesignation($brandname,$brandid){
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
	public function deleteDesignation($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>Designation successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Designation delete</span>";
				return $msg;
			}
		}
	}





}

 ?>