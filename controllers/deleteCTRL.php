
<?php
	include("connection.php");
	include("userMDL.php");
	
	session_start();
	$username = $_SESSION["username"];	   
	
	if(!isset($_POST["deleteUser"]))
	{
		echo("here1");
		$userMDL = new user;
		$userMDL->delUser($username, $conn);	
	}
	
?>

