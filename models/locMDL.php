
<?php

		include("connection.php");
		include("serviceMDL.php");
		
	    class location
		{
			function getLocNames($c)
			{
				$query = "Select name from cities order by name asc";
				
				if($stmt = $c->prepare($query))
				{

					if($stmt->execute())
					{
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							$stmt->bind_result($n);
							$locNames = array();
							while($stmt->fetch())
                            {
							  array_push($locNames, $n);
							}
						
							return $locNames;	
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the locName query"); </script>');
				}
				
			}
			
			
			function getLocData($x, $c)
			{
				$query = "Select * from cities where name = ?";
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $x);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
						  
							$stmt->bind_result($id,$n,$lt,$ln,$i);
							$stmt->fetch();
                            
							$loc = array($n,$lt,$ln,$i);
							return $loc;	
						}
						else
						{
							echo('<script> alert("No ctiy found"); </script>');
							echo "<script> location = 'Trippy.php'; </script>";
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the locName query"); </script>');
				}
			}
			
			function getBuss($name, $c, $t)
			{
				$ser = new serviceMDL;
				if($t == "htl")
				{
					$query = "select * from lochtl U join hotels A on A.htlID = U.htlID where U.city = ?";
				}
				else if($t == "rest")
				{
					$query = "select * from locrest U join restaurants A on A.restID = U.restID where U.city = ?";
				}
				else if($t == "att")
				{
					$query = "select * from locatt U join attaractions A on A.attID = U.attID where U.city = ?";
				}
				else if($t == "travel")
				{
					$query = "select * from loctravel U join travel A on A.travelID = U.travelID where U.city = ?";
				}
						  
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $name);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							if($t == "htl")
							{
								$stmt->bind_result($city, $id, $lat, $lng, $id2, $name, $room, $price, $rental, $desc, $w, $br, $poo, $pet, $img);
							}
							else if($t == "rest" || $t == "att" || $t == "travel")
							{
								$stmt->bind_result($city, $id, $lat, $lng, $id2, $name, $category, $desc, $img);

							}
							
						    $buss = array();	
							while($stmt->fetch())
                            {
								if($t == "htl")
								{
									$rating = $ser->getSerRt($id, $c, "htl");
									if($rating == Null){$rating = 0;}
									array_push($buss, array($name, $price, $desc, $img, $rating, $id));
								}
								else if($t == "rest")
								{
									$rating = $ser->getSerRt($id, $c, "rest");
									if($rating == Null){$rating = 0;}
									array_push($buss, array($name, $category, $desc, $img, $rating, $id));
								}
								else if($t == "att")
								{
									$rating = $ser->getSerRt($id, $c, "att");
									if($rating == Null){$rating = 0;}
									array_push($buss, array($name, $category, $desc, $img, $rating, $id));
								}
								else if($t == "travel")
								{
									$rating = $ser->getSerRt($id, $c, "travel");
									if($rating == Null){$rating = 0;}
									array_push($buss, array($name, $category, $desc, $img, $rating, $id));
								}
							}
							
							return $buss;
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the getBuss query"); </script>');
				}
			}
			
			
			
			function htlfilter($pmin, $pmax, $rmin, $rmax, $city, $c)
			{
				$query = "select A.name, A.price, A.description, A.image, A.htlID from lochtl U join hotels A on A.htlID = U.htlID where U.city = ? and price >= ? and price <= ?";
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("sii", $city, $pmin, $pmax);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($name, $price, $desc, $img, $id);
							
							$ser = new serviceMDL;
						    $buss = array();	
							while($stmt->fetch())
                            {
									$rating = $ser->getSerRt($id, $c, "htl");
									if($rating == Null){$rating = 0;}
									
									if(($rating >= $rmin) && ($rating <= $rmax))
									{
										array_push($buss, array($name, $price, $desc, $img, $rating, $id));
									}
							}
							return $buss;
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the htlfilter query"); </script>');
				}
				
				
			}
			
			
			function serfilter($rmin, $rmax, $city, $c, $t)
			{
				if($t == "rest")
				{
					$query = "select A.name, A.description, A.image, A.restID from locrest U join restaurants A on A.restID = U.restID where U.city = ?";
				}
				else if($t == "att")
				{
					$query = "select A.name, A.description, A.image, A.attID from locatt U join attaractions A on A.attID = U.attID where U.city = ?";
				}
				else if($t == "travel")
				{
					$query = "select A.name, A.description, A.image, A.travelID from loctravel U join travel A on A.travelID = U.travelID where U.city = ?";
				}
				
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $city);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($name, $desc, $img, $id);
							
							$ser = new serviceMDL;
						    $buss = array();	
							while($stmt->fetch())
                            {
									if($t == "rest")
									{
										$rating = $ser->getSerRt($id, $c, "rest");
									}
									else if($t == "att")
									{
										$rating = $ser->getSerRt($id, $c, "att");
									}
									else if($t == "travel")
									{
										$rating = $ser->getSerRt($id, $c, "travel");
									}
									
									
									if($rating == Null){$rating = 0;}
									
									if(($rating >= $rmin) && ($rating <= $rmax))
									{
										array_push($buss, array($name, $desc, $img, $rating, $id));
									}
							}
							return $buss;
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the serfilter query"); </script>');
				}
				
				
			}
			
				
		}
			
			
	
?>

