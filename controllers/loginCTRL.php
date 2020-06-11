
<?php
        include("connection.php");
		include("userMDL.php");
		
		$user = new user;
	  
		 if(isset($_POST["log"]))
		{
			function validateFormData($formData)
			{
				   $formData = trim( stripslashes( htmlspecialchars( $formData)));
				   return $formData;
			}  
			
			$username = validateFormData($_POST["username"]);
			$password = validateFormData($_POST["password"]);
			
			$user->login($username, $password, $conn);
		}
		mysqli_close($conn);
	  
	  
?>

