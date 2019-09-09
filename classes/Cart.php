<?php 
ob_start();
$main_path = realpath(dirname(__FILE__));
include_once($main_path.'/../lib/Database.php');
include_once($main_path.'/../helper/Format.php');



class Cart
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


public function inserttoCart($quantity,$prodId){
	$prodId    = mysqli_real_escape_string($this->db->link,$prodId);
	$quantity  = $this->format->validation($quantity);
	$quantity  = mysqli_real_escape_string($this->db->link,$quantity);
	$sessionId = session_id();

	$getprodquery  = "SELECT * FROM tbl_product WHERE productId = '$prodId'";
	$restproddataq = $this->db->select($getprodquery);
	$finalproddata =$restproddataq->fetch_assoc();
	$productName   = $finalproddata['productName'];
	$productPrice  = $finalproddata['productPrice'];
	$prodImg       = $finalproddata['productImg'];

	$cartcheckq = "SELECT * FROM tbl_cart WHERE productId = '$prodId' AND sessId = '$sessionId'";
	$runcatchkq = $this->db->select($cartcheckq);
	if ($runcatchkq) {
		$msg="<span class='msgbar'>Product already added to your cart <a href='cart.php'>go to your cart</a></span>";
		return $msg;
	}else{
			$insertQuery="INSERT INTO tbl_cart (sessId,productId,productName,productPrice,quantity,image) VALUES ('$sessionId','$prodId','$productName','$productPrice','$quantity','$prodImg')";
			if ($insertQuery) {
			$insCart = $this->db->insert($insertQuery);
			if ($insCart) {
				$msg="<span class='msgbar'>Product added to cart successfully! <a href='cart.php'>go to your cart</a></span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>Product not added to cart!</span>";
				return $msg;
			}
	}
}
	
}


	public function selectcartdata($query){
		if (!empty($query)) {
			$selectCart = $this->db->select($query);
			if ($selectCart) {
				return $selectCart;
			}
		}
	}


	public function updateQuantity($updateqntt){
		if (!empty($updateqntt)) {
			$updatQuantity = $this->db->Update($updateqntt);
			if ($updatQuantity) {
				header('Location:cart.php');
			}else{$msge= "not updated quantity";return $msg;}
		}
		
	}


}