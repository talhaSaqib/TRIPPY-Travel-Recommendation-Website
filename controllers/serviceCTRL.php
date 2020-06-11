
<?php

		include("connection.php");
		include("serviceMDL.php");
		
	    class serviceCTRL
		{
			
			function getSerNames($c, $t)
			{
				$service = new serviceMDL;
				return $service->getSerNames($c, $t);
			}
			
			function getSer($n, $c, $t)
			{
				$service = new serviceMDL;
				return $service->getSer($n, $c, $t);
			}
			
			function getSerRt($n, $c, $t)
			{
				$service = new serviceMDL;
				return $service->getSerRt($n, $c, $t);
			}
			
			function getSerRev($n, $c, $t)
			{
				$service = new serviceMDL;
				return $service->getSerRev($n, $c, $t);
			}
			
			function delSer($n, $c, $t)
			{
				$service = new serviceMDL;
				$service->delSer($n, $c, $t);
			}
			
			function editHTL($id, $htlname, $rooms, $price, $rental, $desc, $break, $wifi, $Pet, $Swim, $conn)
			{
				$service = new serviceMDL;
				$service->editHTL($id, $htlname, $rooms, $price, $rental, $desc, $break, $wifi, $Pet, $Swim, $conn);
			}
			
			function editSer($i, $n, $c, $d, $t, $co)
			{
				$service = new serviceMDL;
				$service->editSer($i, $n, $c, $d, $t, $co);
			}
			
			function searchS($c, $i, $t)
			{
				$service = new serviceMDL;
				$result =  $service->searchS($c, $i, $t);
				
				if($result == NULL)
				{
						echo "<script> alert('No Result Found'); </script>";
						echo "<script> location = history.go(-1); </script>";
				}
				else 
				{
					return $result;
				}
			}

		}
		

		 if(isset($_POST["htlDel"]))
	     {
			  $htlID = $_POST["htlID1"];
			  $ser = new serviceCTRL;
			  
			  $ser->delSer($htlID, $conn, "htl");
	     }
		 else if(isset($_POST["restDel"]))
	     {
			  $restID = $_POST["restID1"];
			  $ser = new serviceCTRL;
			  
			  $ser->delSer($restID, $conn, "rest");
	     }
		 else if(isset($_POST["attDel"]))
	     {
			  $attID = $_POST["attID1"];
			  $ser = new serviceCTRL;
			  
			  $ser->delSer($attID, $conn, "att");
	     }
		 else if(isset($_POST["travelDel"]))
	     {
			  $travelID = $_POST["travelID1"];
			  $ser = new serviceCTRL;
			  
			  $ser->delSer($travelID, $conn, "travel");
	     }
		
		
		if(isset($_POST["edithtl"]))
		{
			$flag = 0;
			
			$id = $_POST["htlID2"];
			
			$htlname = $_POST["htlname1"];
			if($htlname == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$htlname = trim(stripslashes(htmlspecialchars($htlname)));
			
			$rooms = $_POST["rooms1"];
			if($rooms == NULL)
			{
				echo "<script> alert('Rooms are empty!'); </script>";
				$flag = 1;
			}
			$rooms = trim(stripslashes(htmlspecialchars($rooms)));
			
			$price = $_POST["price1"];
			if($price == NULL)
			{
				echo "<script> alert('Price is empty!'); </script>";
				$flag = 1;
			}
			$price = trim(stripslashes(htmlspecialchars($price)));
			
			$rental = $_POST["rental1"];
			if($rental == NULL)
			{
				echo "<script> alert('Rental is empty!'); </script>";
				$flag = 1;
			}
			$rental = trim(stripslashes(htmlspecialchars($rental)));
			
			$desc = $_POST["desc1"];
			if($desc == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$desc = trim(stripslashes(htmlspecialchars($desc)));
			
			$break = $_POST["B1"];
			$wifi = $_POST["W1"];
			$Pet = $_POST["P1"];
			$Swim = $_POST["S1"];

			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$service = new serviceCTRL;
				$service->editHTL($id, $htlname, $rooms, $price, $rental, $desc, $break, $wifi, $Pet, $Swim, $conn);
			}			
		}
		
		
		if(isset($_POST["editrest"]))
		{
			$flag = 0;
			
			$id = $_POST["restID2"];
			
			$restname = $_POST["restname1"];
			if($restname == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$restname = trim(stripslashes(htmlspecialchars($restname)));
			
			$catR = $_POST["restcat"];
			if($catR == NULL)
			{
				echo "<script> alert('Category is empty!'); </script>";
				$flag = 1;
			}
			$catR = trim(stripslashes(htmlspecialchars($catR)));
			
			$descR = $_POST["descR1"];
			if($descR == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$descR = trim(stripslashes(htmlspecialchars($descR)));
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$service = new serviceCTRL;
				$service->editSer($id, $restname, $catR, $descR, "rest", $conn);
			}			
		}
		
		if(isset($_POST["editatt"]))
		{
			$flag = 0;
			
			$id = $_POST["attID2"];
			
			$attname = $_POST["attname1"];
			if($attname == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$attname = trim(stripslashes(htmlspecialchars($attname)));
			
			$catR = $_POST["attcat"];
			if($catR == NULL)
			{
				echo "<script> alert('Category is empty!'); </script>";
				$flag = 1;
			}
			$catR = trim(stripslashes(htmlspecialchars($catR)));
			
			$descR = $_POST["descatt"];
			if($descR == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$descR = trim(stripslashes(htmlspecialchars($descR)));
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$service = new serviceCTRL;
				$service->editSer($id, $attname, $catR, $descR, "att", $conn);
			}			
		}
	
	    if(isset($_POST["edittravel"]))
		{
			$flag = 0;
			
			$id = $_POST["travelID2"];
			
			$attname = $_POST["travelname1"];
			if($attname == NULL)
			{
				echo "<script> alert('Name is empty!'); </script>";
				$flag = 1;
			}
			$attname = trim(stripslashes(htmlspecialchars($attname)));
			
			$catR = $_POST["travelcat"];
			if($catR == NULL)
			{
				echo "<script> alert('Category is empty!'); </script>";
				$flag = 1;
			}
			$catR = trim(stripslashes(htmlspecialchars($catR)));
			
			$descR = $_POST["desctravel"];
			if($descR == NULL)
			{
				echo "<script> alert('Description is empty!'); </script>";
				$flag = 1;
			}
			$descR = trim(stripslashes(htmlspecialchars($descR)));
			
			
			if($flag == 1)
			{
				echo "<script> location = 'Profile.php'; </script>";
			}
            else
			{				
				$service = new serviceCTRL;
				$service->editSer($id, $attname, $catR, $descR, "travel", $conn);
			}			
		}
		
		
		
	
?>

