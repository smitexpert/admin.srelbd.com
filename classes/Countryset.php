<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Countryset
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert country
	public function insertCountry($fromdata){

		$countryName=$this->format->validation($fromdata['countryName']);
		$countryName = mysqli_real_escape_string($this->db->link,$countryName);		

		$countryTag=$this->format->validation($fromdata['countryTag']);
		$countryTag = mysqli_real_escape_string($this->db->link,$countryTag);

		$countryRoute=$this->format->validation($fromdata['route_code']);
		$countryRoute = mysqli_real_escape_string($this->db->link,$countryRoute);

		$status=$this->format->validation($fromdata['status']);
		$status = mysqli_real_escape_string($this->db->link,$status);

		if (!empty($countryName) || !empty($countryTag) || !empty($countryRoute) || !empty($status)) {

			// $selectq = "SELECT * FROM tbl_country WHERE country_name='$countryName' AND country_route=$countryRoute";
			$selectq = "SELECT * FROM tbl_country WHERE country_name='$countryName'";
			$runselectq =$this->selectCountry($selectq);
			if ($runselectq !=false) {
				return $msg = "Country already exist";
			}else{

			 	$query="INSERT INTO tbl_country (country_name,country_tag,country_route,status) VALUES ('$countryName','$countryTag','$countryRoute','$status')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$countryName = "";
				$countryTag = "";
				$countryRoute = "";
				$status = "";
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
	public function selectCountry($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
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

 ?>