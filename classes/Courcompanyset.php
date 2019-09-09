<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Courcompanyset
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//insert courier company
	public function insertcourComp($fromdata){

		$courcompname=$this->format->validation($fromdata['courcompname']);
		$courcompname = mysqli_real_escape_string($this->db->link,$courcompname);

		$based=$this->format->validation($fromdata['based']);
		$based = mysqli_real_escape_string($this->db->link,$based);

		$fuelcost=$fromdata['fuelcost'];
        
		$airlinescost=$fromdata['airlinescost'];

		$status=$this->format->validation($fromdata['currency']);
		$status = mysqli_real_escape_string($this->db->link,$status);

		if (!empty($courcompname) || !empty($status)) {

			$selectq = "SELECT * FROM principals_name WHERE principal_name='$courcompname'";
			$runselectq =$this->db->select($selectq);
			if ($runselectq !=false) {
				return $msg = "Company already exist";
			}else{

			 	$query="INSERT INTO principals_name (principal_name, based, currency, fuel_cost, airlines_cost, dated) VALUES ('$courcompname', '$based', '$status', '$fuelcost', '$airlinescost', NOW())";
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





//SET PRINCIPAL PRICE
	public function insertPrincipalPrice($courcompval2 ,$courcomcntry ,$route_code2,$income_or_outgo2,$goods_type2,$unit2,$price2){


		$courcompval2=$this->format->validation($courcompval2);
		$courcompval2 = mysqli_real_escape_string($this->db->link,$courcompval2);		

		$route_code2=$this->format->validation($route_code2);
		$route_code2 = mysqli_real_escape_string($this->db->link,$route_code2);				

		$courcomcntry;
		// $coutry_id=$this->format->validation($fromdata['country']);
		//$coutry_id = mysqli_real_escape_string($this->db->link,$coutry_id);

		$income_or_outgo2=$this->format->validation($income_or_outgo2);
		$income_or_outgo2 = mysqli_real_escape_string($this->db->link,$income_or_outgo2);

		$goods_type2=$this->format->validation($goods_type2);
		$goods_type2 = mysqli_real_escape_string($this->db->link,$goods_type2);

		$unit2=$this->format->validation($unit2);
		$unit2 = mysqli_real_escape_string($this->db->link,$unit2);

		$price2=$this->format->validation($price2);
		$price2 = mysqli_real_escape_string($this->db->link,$price2);



		if (!empty($courcompval2)  || !empty($income_or_outgo2) ||!empty($goods_type2) ||  !empty($unit2) || !empty($price2)) {



if (empty($courcomcntry) && !empty($route_code2)) {


					$selectq = "SELECT * FROM `tbl_principal_price` WHERE cour_company='$courcompval2' AND route_code=$route_code2 AND income_or_outgo='$income_or_outgo2' AND goods_type='$goods_type2' AND unit=$unit2";
					$runselectq =$this->db->select($selectq);

				if ($runselectq !=false) {
					return $msg = "Data already exist";
				}else{


				 	$query="INSERT INTO tbl_principal_price (cour_company,route_code,income_or_outgo,goods_type,unit,price,status) VALUES ('$courcompval2','$route_code2','$income_or_outgo2','$goods_type2','$unit2','$price2','1')";
						$insres=$this->db->insert($query);

				if ($insres) {
					$msg="<span class='msgbar'>Priceset Successufll !</span>";
					return $msg;
				}else{
					$msg = "<span class='msgbar'>insertion failed</span>";
					return $msg;
				}
				}



}elseif(empty($route_code2) && !empty($courcomcntry)){
	

				$selectq = "SELECT * FROM `tbl_principal_price` WHERE cour_company='$courcompval2' AND country_id=$courcomcntry AND income_or_outgo='$income_or_outgo2' AND goods_type='$goods_type2' AND unit=$unit2";
				$runselectq =$this->db->select($selectq);
				if ($runselectq !=false) {
					return $msg = "Data already exist";
				}else{

			 	$query="INSERT INTO tbl_principal_price (cour_company,country_id,income_or_outgo,goods_type,unit,price,status) VALUES ('$courcompval2','".mysqli_real_escape_string($this->db->link,$courcomcntry)."','$income_or_outgo2','$goods_type2','$unit2','$price2','1')";
					$insres=$this->db->insert($query);

				if ($insres) {
					$msg="<span class='msgbar'>Priceset Successufll !</span>";
					return $msg;
				}else{
					$msg = "<span class='msgbar'>insertion failed</span>";
					return $msg;
				}
			}

}else {
	echo "something wrong";
}




			
		}else{
				$msg="<span class='msgbar'> Fields must not be empty</span>";
				return $msg;
		}
	}








//SET PRINCIPAL PRICE
	public function insertCourcompRoute($cour_comp,$routecode,$coutry_id,$status){


		$cour_comp=$this->format->validation($cour_comp);
		$cour_comp = mysqli_real_escape_string($this->db->link,$cour_comp);		

		$routecode=$this->format->validation($routecode);
		$routecode = mysqli_real_escape_string($this->db->link,$routecode);				

		$coutry_id=$this->format->validation($coutry_id);
		$coutry_id = mysqli_real_escape_string($this->db->link,$coutry_id);		

		$status=$this->format->validation($status);
		$status = mysqli_real_escape_string($this->db->link,$status);



		if (!empty($cour_comp) || !empty($routecode) || !empty($coutry_id) || !empty($status)) {
			$selectq = "SELECT * FROM `tbl_cour_comp_route` WHERE company_id='$cour_comp' AND route_code=$routecode AND cntry_id=$coutry_id";
			$runselectq =$this->db->select($selectq);
			//echo $t=$runselectq->num_rows();die();
			//$t= mysqli_num_rows($this->db,$runselectq);
			if ($runselectq !=false) {
				return $msg = "Data already exist";
			}else{

		 	$query="INSERT INTO tbl_cour_comp_route (company_id,route_code,cntry_id,dated,status) VALUES ('$cour_comp','$routecode','$coutry_id',NOW(),$status)";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>Route Setting Successufll !</span>";
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





//view courier company
	public function selectcourComp($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
		}
	}


//edit  cat name;
	public function editcourComp($brandname,$brandid){
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
	public function deletecourComp($query){
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





	public function deletedata($query){
		if ($query) {
			$delfinal=$this->db->Delete($query);
			if ($delfinal) {
				$msg="<span class='msgbar'>successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Cannot delete</span>";
				return $msg;
			}
		}
	}







}

 ?>