
<?php
    include("connection.php");
	include("userMDL.php");
	
	$user = new user;
	
      if(isset($_POST["nameToCheck"]) && $_POST["nameToCheck"] != "")
	  {
	  
	    function validateFormData($formData)
			{
				   $formData = trim( stripslashes( htmlspecialchars($formData)));
				   return $formData;
			}
		$u = validateFormData($_POST["nameToCheck"]);
		
		
	    if($user->checkUsername($u, $conn))
		{
			echo "*Username already exists";
		}		
	    else
		{
			echo "";
		}
	    mysqli_close($conn);
	  }
      
?>

