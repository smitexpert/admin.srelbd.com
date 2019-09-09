<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Stuffset
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}
//insert stuff
	public function insertStuff($fromdata){

		$stuffname=$this->format->validation($fromdata['stuffname']);
		$stuffname = mysqli_real_escape_string($this->db->link,$stuffname);

		$stuffmail=$this->format->validation($fromdata['stuffmail']);
		$stuffmail = mysqli_real_escape_string($this->db->link,$stuffmail);

		$stuffcontact1=$this->format->validation($fromdata['stuffcontact1']);
		$stuffcontact1 = mysqli_real_escape_string($this->db->link,$stuffcontact1);		

		$stuffcontact2=$this->format->validation($fromdata['stuffcontact2']);
		$stuffcontact2 = mysqli_real_escape_string($this->db->link,$stuffcontact2);

		$stuffaddress=$this->format->validation($fromdata['stuffaddress']);
		$stuffaddress = mysqli_real_escape_string($this->db->link,$stuffaddress);

		$stuffRole=$this->format->validation($fromdata['stuffRole']);
		$stuffRole = mysqli_real_escape_string($this->db->link,$stuffRole);

		$stuffPassword=$this->format->validation($fromdata['stuffPassword']);
		$stuffPassword = mysqli_real_escape_string($this->db->link,$stuffPassword);

		$stuffStatus=$this->format->validation($fromdata['stuffStatus']);
		$stuffStatus = mysqli_real_escape_string($this->db->link,$stuffStatus);		

		$date = date("j/n/Y");

		if (!empty($stuffname) || !empty($stuffmail) || !empty($stuffcontact1) || !empty($stuffcontact2) || !empty($stuffaddress) || !empty($stuffRole) || !empty($stuffPassword) || !empty($stuffStatus) || !empty($date)) {

			$selectq = "SELECT * FROM tbl_stuff WHERE stuff_name='$stuffname' AND stuff_email='$stuffmail' AND password='$stuffPassword'";
			$runselectq =$this->selectStuff($selectq);
			if ($runselectq !=false) {
				return $msg = "Stuff Name / Email / Password already exist";
			}else{		
			$query="INSERT INTO tbl_stuff (stuff_name,stuff_email,stuff_contact1,stuff_contact2,stuff_addr,stuff_role,password, stuff_status,created_at) VALUES ('$stuffname','$stuffmail','$stuffcontact1','$stuffcontact2','$stuffaddress','$stuffRole','$stuffPassword','$stuffStatus','$date')";
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
	public function selectStuff($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
		}
	}


//edit  cat name;
	public function editStuff($brandname,$brandid){
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
	public function deleteStuff($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>Stuff successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Stuff delete</span>";
				return $msg;
			}
		}
	}





}

 ?>