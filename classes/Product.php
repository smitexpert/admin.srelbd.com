<?php 
ob_start();
$main_path = realpath(dirname(__FILE__));
include_once($main_path.'/../lib/Database.php');
include_once($main_path.'/../helper/Format.php');


class Product
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//Insert product

	public function insertProduct($data,$file){ 

		$productName=$this->format->validation($data['productName']);
		$productName=mysqli_real_escape_string($this->db->link,$data['productName']);

		$catId=$this->format->validation($data['catId']);
		$catId=mysqli_real_escape_string($this->db->link,$data['catId']);

		$brandId=$this->format->validation($data['brandId']);
		$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);

		$productDesc=$this->format->validation($data['productDesc']);
		$productDesc=mysqli_real_escape_string($this->db->link,$data['productDesc']);

		$productPrice=$this->format->validation($data['productPrice']);
		$productPrice=mysqli_real_escape_string($this->db->link,$data['productPrice']);

		$productType=$this->format->validation($data['productType']);
		$productType=mysqli_real_escape_string($this->db->link,$data['productType']);


		//image upload protion
		$permittedImg = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['productImg']['name'];
		$file_size = $_FILES['productImg']['size'];
		$file_temp = $_FILES['productImg']['tmp_name'];

		$file_explod = explode('.', $file_name);
		$file_extnsn = strtolower(end($file_explod));
		$unique_img = substr(md5(time()), 0, 10).'.'.$file_extnsn;
		$uploaded_file = "uploads/".$unique_img;

		//empty checking
		if ($productName == "" || $catId == "" || $brandId == "" || $productDesc == "" || $productPrice == "" || $productType == "") {
			return $errmsg = "<span>Please fill all the field.</span>";
		}else{
			if ($file_size > 1048567) {
				echo "<span class='msgbar'>File size must be less than 1mb.</span>";
			}elseif (in_array($file_extnsn, $permittedImg) === false) {
				echo "<span class='msgbar'>You can upload only".implode(',', $permittedImg)."</span>";
			}else{
			move_uploaded_file($file_temp, $uploaded_file);
			$query = "INSERT INTO tbl_product (productName,catId,brandId,productDesc,	productPrice,productImg,productType)VALUES('$productName','$catId','$brandId','$productDesc','$productPrice','$uploaded_file','$productType')";
			$insproduct = $this->db->insert($query);
			if ($insproduct) {
				$msg="<span class='msgbar'>insertion successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>insertion failed</span>";
				return $msg;
			}
		}
	}
	}

//view product
	public function selectProduct($query){
		if (!empty($query)) {
			$selectcat = $this->db->select($query);
			if ($selectcat) {
				return $selectcat;
			}
		}
	}








//edit  product;
	public function editProduct($data,$file,$prodid){
		$productName=$this->format->validation($data['productName']);
		$productName=mysqli_real_escape_string($this->db->link,$data['productName']);

		$catId=$this->format->validation($data['catId']);
		$catId=mysqli_real_escape_string($this->db->link,$data['catId']);

		$brandId=$this->format->validation($data['brandId']);
		$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);

		$productDesc=$this->format->validation($data['productDesc']);
		$productDesc=mysqli_real_escape_string($this->db->link,$data['productDesc']);

		$productPrice=$this->format->validation($data['productPrice']);
		$productPrice=mysqli_real_escape_string($this->db->link,$data['productPrice']);

		$productType=$this->format->validation($data['productType']);
		$productType=mysqli_real_escape_string($this->db->link,$data['productType']);


		//image upload protion
		$permittedImg = array('jpg','jpeg','png','gif');
		$file_name = $_FILES['productImg']['name'];
		$file_size = $_FILES['productImg']['size'];
		$file_temp = $_FILES['productImg']['tmp_name'];

		$file_explod = explode('.', $file_name);
		$file_extnsn = strtolower(end($file_explod));
		$unique_img = substr(md5(time()), 0, 10).'.'.$file_extnsn;
		$uploaded_file = "uploads/".$unique_img;

		//empty checking
		if ($productName == "" || $catId == "" || $brandId == "" || $productDesc == "" || $productPrice == "" || $productType == "") {
			return $errmsg = "<span class='msgbar'>Please fill all the required field.</span>";
		}else{


				if (!empty($file_name)) {
				if ($file_size > 1048567) {
					echo "<span class='msgbar'>File size must be less than 1mb.</span>";
				}elseif (in_array($file_extnsn, $permittedImg) === false) {
					echo "<span class='msgbar'>You can upload only".implode(',', $permittedImg)."</span>";
				}else{
				move_uploaded_file($file_temp, $uploaded_file);
				}
				}else{
					 // echo "<script>window.location = 'productlist.php';</script>";
					 // die();
				}


			$query = "UPDATE tbl_product set  
			 productName='$productName',
			 catId='$catId',
			 brandId='$brandId',
			 productDesc='$productDesc',
			 productPrice='$productPrice',
			 productImg='$uploaded_file',
			 productType='$productType'
			 WHERE productId = '$prodid'";


			$updateProduct = $this->db->Update($query);
			if ($updateProduct) {
				$msg="<span class='msgbar'>update successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>update failed</span>";
				return $msg;
			}



	
	
		}
	}









//delet category
	public function deleteProduct($prodid){
			$selectq = "SELECT productImg FROM tbl_product WHERE productId='$prodid'";
			$selectres=$this->db->select($selectq);
			if ($selectres) {
				while ($datares=$selectres->fetch_assoc()) {
					$imglink = $datares['productImg'];
					unlink($imglink);
				}
			}

			$delquery = "DELETE FROM tbl_product WHERE productId='$prodid'";
			$delfinal=$this->db->Delete($delquery);
			if ($delfinal) {
				$msg="<span class='msgbar'>product successfully deleted</span>";
				return $msg;
			}else{
				$msg="<span class='msgbar'>Cannot delete</span>";
				return $msg;
			}
	}





}

 ?>