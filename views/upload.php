
<?php
        include("connection.php");
		session_start();
	    
		$target_dir = "images/";
	    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$flag = 0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$image = $_FILES["fileToUpload"]["name"];
		
		// Check if image file is an actual image or fake image
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check == false) 
		{
			echo "<script> alert('Either file is not an image OR the image is too large'); </script>";
			$flag = 1;
		}
		
		// Check if file already exists
		else if (file_exists($target_file))
		{
			echo "<script> alert('Image with same name already exists. Try changing file name.'); </script>";
			$flag = 1;
		} 
		
		// Check file size (not really needed here as first check is also handling file size but in case we want to restrict to further less size, this would do.)
		else if ($_FILES["fileToUpload"]["size"] > 500000) 
		{
			echo "<script> alert('Sorry, File is too large'); </script>";
			$flag = 1;
		}
		
		// Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
		{
			echo "<script> alert('Sorry, only JPG, JPEG, PNG files are allowed'); </script>";
			$flag = 1;
		}
		
		// Check if $flag is still 0
		if ($flag == 0) 
		{
			$username = $_SESSION["username"];
			$query = "Update users
				      set image = 'images/$image'
					  where username = '$username'";
			if (mysqli_query($conn, $query))
			{
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
				{
					echo "<script> alert('File uploaded successfully'); </script>";
					echo "<script> location = 'Profile.php'; </script>";
				}
				else
				{
					$query1 = "Update users
				              set image = ''
					          where username = '$username'";
					if(!mysqli_query($conn, $query1))
					{
						echo "Error: ".$query1."<br>".mysqli_error($conn);
					}
					else
					{
						echo "<script> alert('Sorry, File failed to upload'); </script>";
						echo "<script> location = 'Profile.php'; </script>";
					}
				}
			}
			else 
			{
				echo "<script> alert('Sorry, File failed to upload'); </script>";
				echo "Error: ".$query."<br>".mysqli_error($conn);
			}
		}
		else
		{
			echo "<script> location = 'Profile.php'; </script>";
		}
		
	    mysqli_close($conn); 
?>

