
<?php
	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), "", time()-86400, "/");
	}
	session_unset();
	session_destroy();
	
	echo "<script> location = 'LogIn.php'; </script>";
?>

