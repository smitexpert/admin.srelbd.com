<?php 
/**
* formatiing helper class
*/
class Formatting
{
	
	function __construct()
	{	
	}

	public function validation($data){
	  $data = trim($data);
	  $data = stripcslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	 }


}


 ?>