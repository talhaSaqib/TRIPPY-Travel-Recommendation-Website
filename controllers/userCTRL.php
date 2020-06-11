
<?php

		include("connection.php");
		include("userMDL.php");
		
	    class userCTRL
		{
			function getUserData($u, $c)
			{ 
			    $user = new user;
				return $user->getUser($u, $c);
			}
			
			function deleUser($u, $c)
			{ 
			    $user = new user;
				$user->delUser($u, $c);
			}
			
			function getbuss($u, $c, $t)
			{ 
			    $user = new user;
				return $user->getbuss($u, $c, $t);
			}
			
			function getRR($u, $c, $t)
			{ 
			    $user = new user;
				return $user->getRR($u, $c, $t);
			}
			
            function rate($u, $ID, $rat, $rev, $conn, $t)
			{
				$service = new user;
				$service->rate($u, $ID, $rat, $rev, $conn, $t);
			}
			
			function addhtl($user, $city, $name, $room, $price, $rent, $htldes, $wifi, $break, $pool, $pet, $lat, $lng, $image, $c)
			{
				$user1 = new user;
			    $user1->addhtl($user, $city, $name, $room, $price, $rent, $htldes, $wifi, $break, $pool, $pet, $lat, $lng, $image, $c);
			}
			
			function addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $t, $c)
			{
				$user1 = new user;
			    $user1->addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $t, $c);
			}
			
		}
		
		 if(isset($_POST["RRhtl"]))
	     {
			  $htlID = $_POST["htlID3"];
			  $rat = $_POST["rating"];
			  $rev = $_POST["review"];
			  $u = $_POST["username1"];
			 
			  $user = new userCTRL;
			  $user->rate($u, $htlID, $rat, $rev, $conn, "htl");
	     }
		 else if(isset($_POST["RRrest"]))
	     {
			  $restID = $_POST["restID3"];
			  $rat = $_POST["rating"];
			  $rev = $_POST["review"];
			  $u = $_POST["username1"];
			 
			  $user = new userCTRL;
			  $user->rate($u, $restID, $rat, $rev, $conn, "rest");
	     }
		 else if(isset($_POST["RRatt"]))
	     {
			  $attID = $_POST["attID3"];
			  $rat = $_POST["rating"];
			  $rev = $_POST["review"];
			  $u = $_POST["username1"];
			 
			  $user = new userCTRL;
			  $user->rate($u, $attID, $rat, $rev, $conn, "att");
	     }
		 else if(isset($_POST["RRtravel"]))
	     {
			  $travelID = $_POST["travelID3"];
			  $rat = $_POST["rating"];
			  $rev = $_POST["review"];
			  $u = $_POST["username1"];
			 
			  $user = new userCTRL;
			  $user->rate($u, $travelID, $rat, $rev, $conn, "travel");
	     }
		 
		 
		 
		 		 
		function checkImage()
		{
				$target_dir = "images/";
				$target_file = $target_dir . basename($_FILES["serimage"]["name"]);
				$tempimg = $_FILES["serimage"]["tmp_name"];
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$image = $_FILES["serimage"]["name"];
				
				// Check if image file is an actual image or fake image
				$check = getimagesize($tempimg);
				if($check == false) 
				{
					echo "<script> alert('File is not an image/The image is too large/No Image selected'); </script>";
					return Null;
				}
				
				// Check if file already exists
				if (file_exists($target_file))
				{
					echo "<script> alert('Image with same name already exists. Try changing file name.'); </script>";
					return Null;
				} 
				
				// Check file size (not really needed here as first check is also handling file size but in case we want to restrict to further less size, this would do.)
				if ($_FILES["serimage"]["size"] > 5000000) 
				{
					echo "<script> alert('Sorry, File is too large'); </script>";
					return Null;
				}
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
				{
					echo "<script> alert('Sorry, only JPG, JPEG, PNG files are allowed'); </script>";
					return Null;
				}
				
				$imgarr = array($image, $tempimg);
				return $imgarr;
		}

		 
		 if(isset($_POST["addhtl"]))
		 {
			$flag = 0;
			
			$user = $_POST["user"];
			
			$city = $_POST["city"];
			$service = $_POST["service"];
			
			$name = $_POST["htlname"];
			if($name == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$name = trim(stripslashes(htmlspecialchars($name)));
			
			$room = $_POST["room"];
			if($room == NULL)
			{
				echo "<script> alert('Room entry is empty!'); </script>";
				$flag = 1;
			}
			$room = trim(stripslashes(htmlspecialchars($room)));
			
			$price = $_POST["price"];
			if($price == NULL)
			{
				echo "<script> alert('Price entry is empty!'); </script>";
				$flag = 1;
			}
			$price = trim(stripslashes(htmlspecialchars($price)));
			
			$rent = $_POST["rent"];
			if($rent == NULL)
			{
				echo "<script> alert('Rent entry is empty!'); </script>";
				$flag = 1;
			}
			$rent = trim(stripslashes(htmlspecialchars($rent)));
			
			$htldes = $_POST["htldes"];
			if($htldes == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$htldes = trim(stripslashes(htmlspecialchars($htldes)));
			
			$lat = $_POST["lat"];
			if($lat == NULL)
			{
				echo "<script> alert('Latitude is empty!'); </script>";
				$flag = 1;
			}
			$lat = trim(stripslashes(htmlspecialchars($lat)));
			
			$lng = $_POST["lng"];
			if($lng == NULL)
			{
				echo "<script> alert('Longitude is empty!'); </script>";
				$flag = 1;
			}
			$lng = trim(stripslashes(htmlspecialchars($lng)));
			
			//image
			$image = checkImage();
			if($image == Null)
			{
				$flag = 1;
			}
			
			$break = $_POST["BB1"];
			$wifi = $_POST["WW1"];
			$pet = $_POST["PP1"];
			$pool = $_POST["SS1"];
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$user1 = new userCTRL;
				$user1->addhtl($user, $city, $name, $room, $price, $rent, $htldes, $wifi, $break, $pool, $pet, $lat, $lng, $image, $conn);
			}
		 }


		if(isset($_POST["addrest"]))
		 {
			$flag = 0;
			
			$user = $_POST["user"];
			$city = $_POST["city"];
			$service = $_POST["service"];
			
			$name = $_POST["name"];
			if($name == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$name = trim(stripslashes(htmlspecialchars($name)));
			
			$cat = $_POST["cat"];
			if($cat == NULL)
			{
				echo "<script> alert('Category is empty!'); </script>";
				$flag = 1;
			}
			$cat = trim(stripslashes(htmlspecialchars($cat)));
			
			$des = $_POST["des"];
			if($des == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$des = trim(stripslashes(htmlspecialchars($des)));
			
			$lat = $_POST["lat"];
			if($lat == NULL)
			{
				echo "<script> alert('Latitude is empty!'); </script>";
				$flag = 1;
			}
			$lat = trim(stripslashes(htmlspecialchars($lat)));
			
			$lng = $_POST["lng"];
			if($lng == NULL)
			{
				echo "<script> alert('Longitude is empty!'); </script>";
				$flag = 1;
			}
			$lng = trim(stripslashes(htmlspecialchars($lng)));
			
			//image
			$image = checkImage();
			if($image == Null)
			{
				$flag = 1;
			}
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$user1 = new userCTRL;
				$user1->addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $service, $conn);
			}
		 }
			

		if(isset($_POST["addatt"]))
		 {
			$flag = 0;
			
			$user = $_POST["user"];
			$city = $_POST["city"];
			$service = $_POST["service"];
			
			$name = $_POST["name"];
			if($name == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$name = trim(stripslashes(htmlspecialchars($name)));
			
			$cat = $_POST["cat"];
			if($cat == NULL)
			{
				echo "<script> alert('Category is empty!'); </script>";
				$flag = 1;
			}
			$cat = trim(stripslashes(htmlspecialchars($cat)));
			
			$des = $_POST["des"];
			if($des == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$des = trim(stripslashes(htmlspecialchars($des)));
			
			$lat = $_POST["lat"];
			if($lat == NULL)
			{
				echo "<script> alert('Latitude is empty!'); </script>";
				$flag = 1;
			}
			$lat = trim(stripslashes(htmlspecialchars($lat)));
			
			$lng = $_POST["lng"];
			if($lng == NULL)
			{
				echo "<script> alert('Longitude is empty!'); </script>";
				$flag = 1;
			}
			$lng = trim(stripslashes(htmlspecialchars($lng)));
			
			//image
			$image = checkImage();
			if($image == Null)
			{
				$flag = 1;
			}
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$user1 = new userCTRL;
				$user1->addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $service, $conn);
			}
		 }
			
			
		if(isset($_POST["addtravel"]))
		 {
			$flag = 0;
			
			$user = $_POST["user"];
			$city = $_POST["city"];
			$service = $_POST["service"];
			
			$name = $_POST["name"];
			if($name == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$name = trim(stripslashes(htmlspecialchars($name)));
			
			$cat = $_POST["cat"];
			if($cat == NULL)
			{
				echo "<script> alert('Mode is empty!'); </script>";
				$flag = 1;
			}
			$cat = trim(stripslashes(htmlspecialchars($cat)));
			
			$des = $_POST["des"];
			if($des == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$des = trim(stripslashes(htmlspecialchars($des)));
			
			$lat = $_POST["lat"];
			if($lat == NULL)
			{
				echo "<script> alert('Latitude is empty!'); </script>";
				$flag = 1;
			}
			$lat = trim(stripslashes(htmlspecialchars($lat)));
			
			$lng = $_POST["lng"];
			if($lng == NULL)
			{
				echo "<script> alert('Longitude is empty!'); </script>";
				$flag = 1;
			}
			$lng = trim(stripslashes(htmlspecialchars($lng)));
			
			//image
			$image = checkImage();
			if($image == Null)
			{
				$flag = 1;
			}
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$user1 = new userCTRL;
				$user1->addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $service, $conn);
			}
		 }




		 
?>

