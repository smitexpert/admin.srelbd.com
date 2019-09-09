<?php 
ob_start();
$main_path = realpath(dirname(__FILE__));
include_once($main_path.'/../lib/Database.php');
include_once($main_path.'/../helper/Format.php');


class Category
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert category
	public function addcat($catname){
		$catname=$this->format->validation($catname);
		$catname = mysqli_real_escape_string($this->db->link,$catname);
		if (!empty($catname)) {
			 	$query="INSERT INTO tbl_categories (catname) VALUES ('$catname')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>insertion successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>insertion failed</span>";
				return $msg;
			}
		}else{
				$msg="<span class='msgbar'>cat field must not be empty</span>";
				return $msg;
		}
	}


//view category
	public function selectCat($query){
		if (!empty($query)) {
			$selectcat = $this->db->select($query);
			if ($selectcat) {
				return $selectcat;
			}
		}
	}





//edit  cat name;
	public function editCat($catname,$catid){
		$catname = $this->format->validation($catname);
		$catname = mysqli_real_escape_string($this->db->link,$catname);

		if (!empty($catname) && !empty($catid)) {
			$query = "UPDATE tbl_categories SET catname='$catname' WHERE catId = '$catid'";
			$queryres=$this->db->Update($query);
			if ($queryres) {
				$msg="<span class='msgbar'>update successfull</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>update failed</span>";
				return $msg;
			}
		}else{
			headr('Location:catlist.php');
		}

	}


//delet category
	public function deleteCat($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>category successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Cannot delete</span>";
				return $msg;
			}
		}
	}





}

 ?>