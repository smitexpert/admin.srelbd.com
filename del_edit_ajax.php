<?php 

ob_start();
require __DIR__."/classes/Courcompanyset.php";
$Courcompanyset = new Courcompanyset();

if ($_POST['action']=="deletedata") {
	$delid = $_POST['delid'];
	$query = $_POST['query'];
	$runquery = $Courcompanyset->deletedata($query);
	if ($runquery) {
		echo "data deleted";
	}else{
		echo "not deleted";
	}
}