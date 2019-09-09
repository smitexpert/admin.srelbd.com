<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";

class Priceset
{

	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}



//CREATE ROUTE
	public function createRoute($fromdata){

		$route=$this->format->validation($fromdata['route']);
		$route = mysqli_real_escape_string($this->db->link,$route);
		$status=$this->format->validation($fromdata['status']);
		$status = mysqli_real_escape_string($this->db->link,$status);
		if (!empty($route) || !empty($status)) {
			$selectq = "SELECT * FROM tbl_route WHERE route_code=$route";
			$runselectq =$this->selectRoute($selectq);
			if ($runselectq !=false) {
				return $msg = "Route already exist";
			}else{
		 	$query="INSERT INTO tbl_route (route_code,status,dated) VALUES ('$route','$status',NOW())";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>Route Add successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>Route Add failed</span>";
				return $msg;
			} } }else{ $msg="<span class='msgbar'> Fields must not be empty</span>";
				return $msg; } }





//SET ROUTE PRICE
	public function insertPrice($fromdata){

		$routecode=$this->format->validation($fromdata['route_code']);
		$routecode = mysqli_real_escape_string($this->db->link,$routecode);

		$income_or_outgo=$this->format->validation($fromdata['income_or_outgo']);
		$income_or_outgo = mysqli_real_escape_string($this->db->link,$income_or_outgo);

		$goods_type=$this->format->validation($fromdata['goods_type']);
		$goods_type = mysqli_real_escape_string($this->db->link,$goods_type);

		$unit=$this->format->validation($fromdata['unit']);
		$unit = mysqli_real_escape_string($this->db->link,$unit);

		$price=$this->format->validation($fromdata['price']);
		$price = mysqli_real_escape_string($this->db->link,$price);



		if (!empty($routecode) || !empty($income_or_outgo) ||!empty($goods_type) ||  !empty($unit) || !empty($price)) {

			$selectq = "SELECT * FROM `tbl_route_price` WHERE route_code=$routecode AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";
			$runselectq =$this->selectRoute($selectq);
			//echo $t=$runselectq->num_rows();die();
			//$t= mysqli_num_rows($this->db,$runselectq);
			if ($runselectq !=false) {
				return $msg = "Data already exist";
			}else{

		 	$query="INSERT INTO tbl_route_price (route_code,income_or_outgo,goods_type,unit,price,status) VALUES ('$routecode','$income_or_outgo','$goods_type','$unit','$price','1')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>Priceset Successufll !</span>";
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








//CREATE WEIGHT
	public function creatWeight($fromdata){

		$weight=$this->format->validation($fromdata['weight']);
		$weight = mysqli_real_escape_string($this->db->link,$weight);

		$status=$this->format->validation($fromdata['status']);
		$status = mysqli_real_escape_string($this->db->link,$status);

		if (!empty($weight) || !empty($status)) {
			$selectq = "SELECT * FROM tbl_weight WHERE weight=$weight";
			$runselectq =$this->selectRoute($selectq);
			if ($runselectq !=false) {
				return $msg = "Weight already exist";
			}else{
		 	$query="INSERT INTO tbl_weight(weight,status,dated) VALUES ('$weight','$status',NOW())";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>Weight Add successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>Weight Add failed</span>";
				return $msg;
			} } }else{ $msg="<span class='msgbar'> Fields must not be empty</span>";
				return $msg; } }






//view brand
	public function selectRoute($query){
		if (!empty($query)) {
			$selectbrand = $this->db->select($query);
			if ($selectbrand) {
				return $selectbrand;
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