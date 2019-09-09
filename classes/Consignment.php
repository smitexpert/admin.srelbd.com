<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";


class Consignment
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}

//Consignment booking method
	public function bookConsignment($fromdata){

		$sender_type=$this->format->validation($fromdata['sender_type']);
		$sender_type = mysqli_real_escape_string($this->db->link,$sender_type);

		$corpo_clients=$this->format->validation($fromdata['corpo_clients']);
		$corpo_clients = mysqli_real_escape_string($this->db->link,$corpo_clients);

		$sender_name=$this->format->validation($fromdata['sender_name']);
		$sender_name = mysqli_real_escape_string($this->db->link,$sender_name);

		$sender_company=$this->format->validation($fromdata['sender_company']);
		$sender_company = mysqli_real_escape_string($this->db->link,$sender_company);

		$sender_email=$this->format->validation($fromdata['sender_email']);
		$sender_email = mysqli_real_escape_string($this->db->link,$sender_email);		

		$sender_contact=$this->format->validation($fromdata['sender_contact']);
		$sender_contact = mysqli_real_escape_string($this->db->link,$sender_contact);		

		$sender_country=$this->format->validation($fromdata['sender_country']);
		$sender_country = mysqli_real_escape_string($this->db->link,$sender_country);		

		$sender_addr=$this->format->validation($fromdata['sender_addr']);
		$sender_addr = mysqli_real_escape_string($this->db->link,$sender_addr);		

		$recipient_name=$this->format->validation($fromdata['recipient_name']);
		$recipient_name = mysqli_real_escape_string($this->db->link,$recipient_name);		

		$recipient_email=$this->format->validation($fromdata['recipient_email']);
		$recipient_email = mysqli_real_escape_string($this->db->link,$recipient_email);		

		$recipient_contact1=$this->format->validation($fromdata['recipient_contact1']);
		$recipient_contact1 = mysqli_real_escape_string($this->db->link,$recipient_contact1);		

		$recipient_contact2=$this->format->validation($fromdata['recipient_contact2']);
		$recipient_contact2 = mysqli_real_escape_string($this->db->link,$recipient_contact2);		

		$recipient_addr=$this->format->validation($fromdata['recipient_addr']);
		$recipient_addr = mysqli_real_escape_string($this->db->link,$recipient_addr);		

		$dest_country=$this->format->validation($fromdata['dest_country']);
		$dest_country = mysqli_real_escape_string($this->db->link,$dest_country);		

		$recipient_zipcode=$this->format->validation($fromdata['recipient_zipcode']);
		$recipient_zipcode = mysqli_real_escape_string($this->db->link,$recipient_zipcode);		

		$addi_comment=$this->format->validation($fromdata['addi_comment']);
		$addi_comment = mysqli_real_escape_string($this->db->link,$addi_comment);		

		$goods_title=$this->format->validation($fromdata['goods_title']);
		$goods_title = mysqli_real_escape_string($this->db->link,$goods_title);				

		$income_or_outgo=$this->format->validation($fromdata['income_or_outgo']);
		$income_or_outgo = mysqli_real_escape_string($this->db->link,$income_or_outgo);		

		$goods_type=$this->format->validation($fromdata['goods_type']);
		$goods_type = mysqli_real_escape_string($this->db->link,$goods_type);		

		// $goods_quantity=$this->format->validation($fromdata['goods_quantity']);
		// $goods_quantity = mysqli_real_escape_string($this->db->link,$goods_quantity);		

		$goods_weight=$this->format->validation($fromdata['goods_weight']);
		$goods_weight = mysqli_real_escape_string($this->db->link,$goods_weight);		

		$consignment_charge=$this->format->validation($fromdata['consignment_charge']);
		$consignment_charge = mysqli_real_escape_string($this->db->link,$consignment_charge);		

		$clientPrice=$this->format->validation($fromdata['clientPrice']);
		$clientPrice = mysqli_real_escape_string($this->db->link,$clientPrice);		

		$total_charge=$this->format->validation($fromdata['total_charge']);
		$total_charge = mysqli_real_escape_string($this->db->link,$total_charge);			

		$trackID=$this->format->validation($fromdata['trackID']);
		$trackID = mysqli_real_escape_string($this->db->link,$trackID);				

		$custom_trackID=$this->format->validation($fromdata['custom_trackID']);
		$custom_trackID = mysqli_real_escape_string($this->db->link,$custom_trackID);		

		// $booking_date=$this->format->validation($fromdata['booking_date']);
		// $booking_date = mysqli_real_escape_string($this->db->link,$booking_date);		

		$booking_date_exp=$this->format->validation($fromdata['booking_date_exp']);
		$booking_date_exp = mysqli_real_escape_string($this->db->link,$booking_date_exp);

		$stuff_asign=$this->format->validation($fromdata['stuff_asign']);
		$stuff_asign = mysqli_real_escape_string($this->db->link,$stuff_asign);

		$booked_by=$this->format->validation($fromdata['booked_by']);
		$booked_by = mysqli_real_escape_string($this->db->link,$booked_by);

		$cons_status=$this->format->validation($fromdata['cons_status']);
		$cons_status = mysqli_real_escape_string($this->db->link,$cons_status);
		$date = date("Y-m-d");

		if (!empty($sender_type)  || 
			!empty($sender_name) || 
			!empty($sender_company) || 
			!empty($sender_email) || 
			!empty($sender_contact) || 
			!empty($sender_country) || 
			!empty($sender_addr) || 
			!empty($recipient_name) || 
			!empty($recipient_email) || 
			!empty($recipient_contact1) || 
			!empty($recipient_addr) || 
			!empty($dest_country) || 
			!empty($income_or_outgo) || 
			!empty($goods_type) || 
			!empty($goods_weight) || 
			!empty($consignment_charge) || 
			!empty($total_charge) || 			
			!empty($trackID) || 						
			!empty($booked_by) || 
			!empty($stuff_asign) || 
			!empty($cons_status)
			) {
			 $query="INSERT INTO tbl_consignment 
			 (sender_type,sender_id,sender_name,sender_company,sender_email,sender_contact,sender_country,sender_addr,recipient_name,recipient_email,recipient_contact1,recipient_contact2,recipient_addr,dest_country,recipient_zipcode,addi_comment,goods_title,income_or_outgo,goods_type,goods_weight,consignment_charge,CorpoClientPrice,total_charge,track_id,custom_trackID,booking_date,booking_date_exp,booked_by,assigned_to,consignment_status) 
			 VALUES 
			 (
			 '$sender_type',
			 '$corpo_clients',
			 '$sender_name',
			 '$sender_company',
			 '$sender_email',
			 '$sender_contact',
			 '$sender_country',
			 '$sender_addr',
			 '$recipient_name',
			 '$recipient_email',
			 '$recipient_contact1',
			 '$recipient_contact2',
			 '$recipient_addr',
			 '$dest_country',
			 '$recipient_zipcode',
			 '$addi_comment',
			 '$goods_title',
			 '$income_or_outgo',
			 '$goods_type',
			 '$goods_weight',
			 '$consignment_charge',
			 '$clientPrice',
			 '$total_charge',			 
			 '$trackID',
			 '$custom_trackID',
			 '$date',
			 '$booking_date_exp',
			 '$booked_by',
			 '$stuff_asign',
			 '$cons_status'
			 )";

			$insres=$this->db->insert($query);
			if ($insres) {
				$msg="<span class='msgbar'>insertion successfull</span>";
				return $msg;
			}else{
				$msg = "<span class='msgbar'>insertion failed</span>";
				return $msg;
			}
		}else{
				$msg="<span class='msgbar'> Fields must not be empty</span>";
				return $msg;
		}
	}





//view country
	public function selectConsignment($query){
		if (!empty($query)) {
			$selectCountry = $this->db->select($query);
			if ($selectCountry) {
				return $selectCountry;
			}
		}
	}	

	public function selectConsignment2($query2){
		if (!empty($query2)) {
			$selectCountry2 = $this->db->select($query2);
			if ($selectCountry2) {
				return $selectCountry2;
			}
		}
	}


//edit  cat name;
	public function updatemenifest($cour_comp_id,$consid,$selectedocurprice){
		// $cour_comp_id = $this->format->validation($cour_comp_id);
		// $cour_comp_id = mysqli_real_escape_string($this->db->link,$cour_comp_id);

		if (!empty($cour_comp_id) && !empty($consid)&& !empty($selectedocurprice)) {
			$query = "UPDATE tbl_consignment SET menifested=$cour_comp_id,delivery_charge=$selectedocurprice WHERE id=$consid";
			$queryres=$this->db->Update($query);
			if ($queryres) {
				$msg="<span class='msgbar'>	Maminfest Setting successfull</span>";
				header('Location:manifest.php?consid='.$consid.'&&msg='.$msg);
			}else{
				$msg="<span class='msgbar'>update failed</span>";
				return $msg;
			}
		}else{
			header('Location:manifest.php?consid=$consid');
		}

	}



	//MAKE DELIVERD
	public function makedelivered($consid){
		// $cour_comp_id = $this->format->validation($cour_comp_id);
		// $cour_comp_id = mysqli_real_escape_string($this->db->link,$cour_comp_id);

		if (!empty($consid)) {
			$query = "UPDATE tbl_consignment SET consignment_status=2 WHERE id=$consid";
			$queryres=$this->db->Update($query);
			if ($queryres) {
				$msg="<span class='msgbar'>	Consignment made Delivered</span>";
				header('Location:consignment_list.php?msg='.$msg);
			}else{
				$msg="<span class='msgbar'>update failed</span>";
				return $msg;
			}
		}else{
			header('Location:consignment_list.php');
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