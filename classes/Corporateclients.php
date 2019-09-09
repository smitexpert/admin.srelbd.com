<?php 
ob_start();
// include_once('/../lib/Database.php');
// include_once('/../helper/Format.php');
/*require __DIR__.'/../lib/Session.php';*/
require_once __DIR__."/../lib/Database.php";
require_once __DIR__."/../helper/Format.php";

/*Session::checkSession();*/

class Corporateclients
{
	private $db;
	private $format;

	public function __construct(){
		$this->db = new Database();
		$this->format = new Formatting();

	}


//CREATE CORPORATE CLIENT
	public function insertCorpoclient($fromdata){

		$client_name=$this->format->validation($fromdata['client_name']);
		$client_name = mysqli_real_escape_string($this->db->link,$client_name);

		$client_company=$this->format->validation($fromdata['client_company']);
		$client_company = mysqli_real_escape_string($this->db->link,$client_company);

		$client_mail=$this->format->validation($fromdata['client_mail']);
		$client_mail = mysqli_real_escape_string($this->db->link,$client_mail);


		$client_contact=$this->format->validation($fromdata['client_contact']);
		$client_contact = mysqli_real_escape_string($this->db->link,$client_contact);

		$client_addr=$this->format->validation($fromdata['client_addr']);
		$client_addr = mysqli_real_escape_string($this->db->link,$client_addr);		

		$bank_name=$this->format->validation($fromdata['bank_name']);
		$bank_name = mysqli_real_escape_string($this->db->link,$bank_name);

		$account_name=$this->format->validation($fromdata['account_name']);
		$account_name = mysqli_real_escape_string($this->db->link,$account_name);

		$acc_num=$this->format->validation($fromdata['acc_num']);
		$acc_num = mysqli_real_escape_string($this->db->link,$acc_num);


		$discount=$this->format->validation($fromdata['discount']);
		$discount = mysqli_real_escape_string($this->db->link,$discount);
		
		$client_assignee=$this->format->validation($fromdata['corpoAssignTo']);
		$client_assignee = mysqli_real_escape_string($this->db->link,$client_assignee);		

		$member_type=$this->format->validation($fromdata['member_type']);
		$member_type = mysqli_real_escape_string($this->db->link,$member_type);		

		$client_status=$this->format->validation($fromdata['client_status']);
		$client_status = mysqli_real_escape_string($this->db->link,$client_status);

        $password = md5('123456');
        $created_by = Session::get('adminId');

		if (!empty($client_name) || !empty($client_company) || !empty($client_mail) || !empty($client_contact) || !empty($client_addr)) {

			$selectq = "SELECT * FROM corporate_clients WHERE name='$client_name' AND company_name='$client_company' AND email='$client_mail' ";
			$runselectq =$this->selectCorpoClient($selectq);
			if ($runselectq !=false) {
				return $msg = "Company already exist";
			}else{

			 	$query="INSERT INTO corporate_clients (name, email, company_name, address, contact, bank_name, bank_account_name, bank_acount_number, member_type, discount_offer, password, assign_to, created_by, created_date, update_date, status) VALUES ('$client_name', '$client_mail', '$client_company','$client_addr','$client_contact','$bank_name','$account_name','$acc_num','$member_type','$discount', '$password', '$client_assignee', '$created_by',NOW(), NOW(), '1')";
				$insres=$this->db->insert($query);
			if ($insres) {
                    $newQuery = "INSERT INTO corporate_accounts (corporate_client_email, credit_limit, cash_amount, debit_amount, update_date, balance, update_by) VALUES ('$client_mail', '0', '0', '0', NOW(), '0', '$created_by')";
                    $newResult = $this->db->insert($newQuery);
                if($newResult){
                    
				$msg="<span class='msgbar'>Insertion Successufll !</span>";
				return $msg;
                }
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


//CORPORATE CLIENT LIST
	public function selectCorpoClient($query){
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
			$query = "UPDATE tbl_bratbl_corporate_clientsnds SET brandname='$brandname' WHERE brandId = '$brandid'";
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




//CORPORATE CLIENT PRICE SET
	public function insertCorpoPrice($corp_client,$route_code,$income_or_outgo,$goods_type,$unit,$price){

		$corp_client=$this->format->validation($corp_client);
		$corp_client = mysqli_real_escape_string($this->db->link,$corp_client);

		$routecode=$this->format->validation($route_code);
		$routecode = mysqli_real_escape_string($this->db->link,$routecode);

		$income_or_outgo=$this->format->validation($income_or_outgo);
		$income_or_outgo = mysqli_real_escape_string($this->db->link,$income_or_outgo);

		$goods_type=$this->format->validation($goods_type);
		$goods_type = mysqli_real_escape_string($this->db->link,$goods_type);

		$unit=$this->format->validation($unit);
		$unit = mysqli_real_escape_string($this->db->link,$unit);

		$price=$this->format->validation($price);
		$price = mysqli_real_escape_string($this->db->link,$price);


		if (!empty($corp_client) || !empty($routecode) || !empty($income_or_outgo) ||!empty($goods_type) ||  !empty($unit) || !empty($price)) {

			$selectq = "SELECT * FROM `tbl_corpo_client_price` WHERE corpo_client_id=$corp_client AND route_code=$routecode AND income_or_outgo='$income_or_outgo' AND goods_type='$goods_type' AND unit=$unit";
			$runselectq =$this->selectCorpoClient($selectq);
			//echo $t=$runselectq->num_rows();die();
			//$t= mysqli_num_rows($this->db,$runselectq);
			if ($runselectq !=false) {
				return $msg = "Data already exist";
			}else{

		 	$query="INSERT INTO tbl_corpo_client_price (corpo_client_id,route_code,income_or_outgo,goods_type,unit,price,status) VALUES ('$corp_client','$routecode','$income_or_outgo','$goods_type','$unit','$price','1')";
				$insres=$this->db->insert($query);
			if ($insres) {
				$msg="Priceset Successufll";
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




	public function searchClientPrice($data){
			$corp_client=$data['corp_client'];
			$searchSelectPrice = "SELECT * FROM tbl_corpo_client_price WHERE corpo_client_id=$corp_client";
			$runsrchselelctprice =$this->db->select($searchSelectPrice);
			if ($runsrchselelctprice !=false) {
				return $msg = "Data Not Found";
			}else{
				return $runsrchselelctprice;
			}
	}








//CORPORATE CLIENT PRICE SET
	public function insertStuffTarget($stuffID,$targetamount,$dateFrom,$dateTo){

		$stuffID=$this->format->validation($stuffID);
		$stuffID = mysqli_real_escape_string($this->db->link,$stuffID);

		$targetamount=$this->format->validation($targetamount);
		$targetamount = mysqli_real_escape_string($this->db->link,$targetamount);

		$dateFrom=$this->format->validation($dateFrom);
		$dateFrom = mysqli_real_escape_string($this->db->link,$dateFrom);

		$dateTo=$this->format->validation($dateTo);
		$dateTo = mysqli_real_escape_string($this->db->link,$dateTo);


		if (!empty($stuffID) || !empty($targetamount) || !empty($dateFrom) ||!empty($dateTo)) {
			

			$selectq2 = "SELECT * FROM `tbl_stuff_target` WHERE stuff_id=$stuffID AND targeted_amount=$targetamount AND date_from='$dateFrom' AND date_to='$dateTo'";
			$runselectq2 =$this->selectCorpoClient($selectq2);
			//echo $t=$runselectq->num_rows();die();
			//$t= mysqli_num_rows($this->db,$runselectq);
			if ($runselectq2 !=false) {
				return $msg = "Data already exist";
			}else{
				
		 	$query2="INSERT INTO tbl_stuff_target (stuff_id,targeted_amount,date_from,date_to,status,dated) VALUES ('$stuffID','$targetamount','$dateFrom','$dateTo',1,NOW())";
				$insres2=$this->db->insert($query2);
			if ($insres2) {
				return $msg="Successfully Target Setted";
				
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








}
