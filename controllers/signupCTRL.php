
<?php

		include("connection.php");
		include("userMDL.php");
		
		$user = new user;
		
	    if(isset($_POST["sign"]))
		{
			   //build a function that validate data
			   function validateFormData($formData)
			   {
				   $formData = trim( stripslashes( htmlspecialchars( $formData)));
				   return $formData;
			   }  
		       $flag = 0;
		   
			//checks	
			if(!$_POST["fullname"])
			{
				$nameError = "*Full name must not be empty";
				echo "<script> alert('$nameError'); </script>";
				$flag = 1;
			}
			else
			{
				$fullname = validateFormData($_POST["fullname"]);
			}
			
			if(!$_POST["username"])
			{
				$userError = "*User name must not be empty";
				echo "<script> alert('$userError'); </script>";
				$flag = 1;
			}
			else
			{
				$tempName = $_POST["username"];
			    
	            if($user->checkUsername($tempName, $conn))
		        {
			       $userError1 = "*Username already exists";
				   echo "<script> alert('$userError1'); </script>";
				   $flag = 1;
		        }
				else
				{
				   $username = validateFormData($_POST["username"]);
				}
			}
			
			if(!$_POST["password"])
			{
				$pError = "*Kindly enter a password";
				echo "<script> alert('$pError'); </script>";
				$flag = 1;
			}
			else if(strlen($_POST["password"]) < 7)
			{
				$pError = "*Password should be greater than 6 digits";
				echo "<script> alert('$pError'); </script>";
				$flag = 1;
			}
			else
			{
				$password = validateFormData($_POST["password"]);
				$hashedpass = password_hash($password, PASSWORD_DEFAULT);
			}
			
			if(!$_POST["email"])
			{
				$eError = "*Email must not be empty";
				echo "<script> alert('$eError'); </script>";
				$flag = 1;
			}
			else
			{
				$email = validateFormData($_POST["email"]);
			}
			
			$type = $_POST["formRadio"];
			
			//insert check
			if($flag == 1)
			{
				echo "<script> location = 'SignUp.php' </script>";
			}
			else
			{
				$user->signup($fullname, $username, $hashedpass, $email, $type, $conn);
			}
		}
		mysqli_close($conn);
	
?>

