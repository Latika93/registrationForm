<?php	

function PDO_db_connect(){
	$db_host="localhost"; 
	$db_user="root";	
	$db_password="";	
	$db_name="myproject";
	try
	{
		$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected Sucess..!!";
		return $db;
	}
	catch(PDOEXCEPTION $e)
	{
		echo "Error throws";
		$e->getMessage();
	}
}

function mysql_db_connect(){
	$db_host="localhost"; 
	$db_user="root";	
	$db_password="";	
	$db_name="myproject";
	try
	{
		$db = mysqli_connect($db_host, $db_user, $db_password, $db_name);
		return $db;
        //echo "Connected";
	}
	catch(PDOEXCEPTION $e)
	{
		$e->getMessage();
	}
}

$conn = mysql_db_connect();

?>