
<?php

		include("connection.php");
		include("claimMDL.php");
		
	    class claimCTRL
		{
			function getClaim($c, $t)
			{
				$claim = new claimMDL;
				return $claim->getClaim($c, $t);
			}
			
			function claim($id, $user, $c, $t)
			{
				$claim = new claimMDL;
				$claim->claim($id, $user, $c, $t);
			}
			
			function approve($id, $owner, $claimer, $c, $t)
			{
				$claim = new claimMDL;
				$claim->approve($id, $owner, $claimer, $c, $t);
			}
			
			function decline($id, $owner, $claimer, $c, $t)
			{
				$claim = new claimMDL;
				$claim->decline($id, $owner, $claimer, $c, $t);
			}
			
		}
		
		if(isset($_GET["claimhtl"]))
		{
			$id = $_GET["ID"];
			$user = $_GET["user"];
			
			$claim = new claimCTRL;
		    $claim->claim($id, $user, $conn, "htl");
		}
		else if(isset($_GET["claimrest"]))
		{
			$id = $_GET["ID"];
			$user = $_GET["user"];
			
			$claim = new claimCTRL;
		    $claim->claim($id, $user, $conn, "rest");
		}
		else if(isset($_GET["claimatt"]))
		{
			$id = $_GET["ID"];
			$user = $_GET["user"];
			
			$claim = new claimCTRL;
		    $claim->claim($id, $user, $conn, "att");
		}
		else if(isset($_GET["claimtravel"]))
		{
			$id = $_GET["ID"];
			$user = $_GET["user"];
			
			$claim = new claimCTRL;
		    $claim->claim($id, $user, $conn, "travel");
		}
		
		
		if(isset($_GET["approveHtl"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->approve($id, $owner, $claimer, $conn, "htl");
		}
		else if(isset($_GET["approveRest"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->approve($id, $owner, $claimer, $conn, "rest");
		}
		else if(isset($_GET["approveatt"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->approve($id, $owner, $claimer, $conn, "att");
		}
		else if(isset($_GET["approvetravel"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->approve($id, $owner, $claimer, $conn, "travel");
		}
		
		
		
		if(isset($_GET["declineHtl"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->decline($id, $owner, $claimer, $conn, "htl");
		}
		else if(isset($_GET["declineRest"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->decline($id, $owner, $claimer, $conn, "rest");
		}
		else if(isset($_GET["declineatt"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->decline($id, $owner, $claimer, $conn, "att");
		}
		else if(isset($_GET["declinetravel"]))
		{
			$id = $_GET["id"];
			$owner = $_GET["owner"];
			$claimer = $_GET["claimer"];
			
			$claim = new claimCTRL;
		    $claim->decline($id, $owner, $claimer, $conn, "travel");
		}
		
		
		
		
		
	
?>

