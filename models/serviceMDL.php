
<?php

		include("connection.php");
		
	    class serviceMDL
		{
			
			function getSerNames($c, $t)
			{
				if($t == "htl")
				{
					$query = "Select name from hotels order by name asc";
				}
				else if($t == "rest")
				{
					$query = "Select name from restaurants order by name asc";
				}
				else if($t == "att")
				{
					$query = "Select name from attaractions order by name asc";
				}
				else if($t == "travel")
				{
					$query = "Select name from travel order by name asc";
				}
				
				if($stmt = $c->prepare($query))
				{

					if($stmt->execute())
					{
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							$stmt->bind_result($n);
							$Names = array();
							while($stmt->fetch())
                            {
							  array_push($Names, $n);
							}
						
							return $Names;	
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
			
			
			function getSer($n, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select * from hotels H join lochtl L on L.htlID = H.htlID where H.htlID = ?";
				}
				else if($t == "rest")
				{
					$query = "select * from restaurants H join locrest L on L.restID = H.restID where H.restID = ?";
				}
				else if($t == "att")
				{
					$query = "select * from attaractions H join locatt L on L.attID = H.attID where H.attID = ?";
				}
				else if($t == "travel")
				{
					$query = "select * from travel H join loctravel L on L.travelID = H.travelID where H.travelID = ?";
				}
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("i", $n);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							if($t == "htl")
							{
								$stmt->bind_result($id, $name, $rooms, $price, $rental, $desc, $wifi, $break, $poo, $pet, $img, $city, $id2, $lat, $lng);
								$stmt->fetch();
								$ser = array($id, $name, $rooms, $price, $rental, $desc, $wifi, $break, $poo, $pet, $img, $lat, $lng);
							}
							else if($t == "rest" || $t == "att" || $t == "travel")
							{
								$stmt->bind_result($id, $name, $category, $desc, $img, $city, $id2, $lat, $lng);
								$stmt->fetch();
								$ser = array($id, $name, $desc, $category, $img, $lat, $lng);
							}
							
							
							return $ser;	
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
			
			
			function  getSerRt($n, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select AVG(rating) from likehtl where htlID = ?";
				}
				else if($t == "rest")
				{
					$query = "select AVG(rating) from likerest where restID = ?";
				}
				else if($t == "att")
				{
					$query = "select AVG(rating) from likeatt where attID = ?";
				}
				else if($t == "travel")
				{
					$query = "select AVG(rating) from liketravel where travelID = ?";
				}

				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("i", $n);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($rating);
							$stmt->fetch();
                            
							return $rating;	
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
			
			
			function getSerRev($n, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select * from likehtl H join users U on U.username = H.username where H.htlID = ?";
				}
				else if($t == "rest")
				{
					$query = "select * from likerest H join users U on U.username = H.username where H.restID = ?";
				}
				else if($t == "att")
				{
					$query = "select * from likeatt H join users U on U.username = H.username where H.attID = ?";
				}
				else if($t == "travel")
				{
					$query = "select * from liketravel H join users U on U.username = H.username where H.travelID = ?";
				}
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("i", $n);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($username, $ID, $rating, $review, $fullname, $username1, $password, $email, $img, $date, $type);
							$reviews = array();
							
							while($stmt->fetch())
                            {
							  array_push($reviews, array($username, $rating, $review, $img));
							}
							return $reviews;	
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
			
			
			function delSer($n, $c, $t)
			{
				if($t == "htl")
				{
					$query = "Delete from hotels where htlID = ?";
				}
				else if($t == "rest")
				{
					$query = "Delete from restaurants where restID = ?";
				}
				else if($t == "att")
				{
					$query = "Delete from attaractions where attID = ?";
				}
				else if($t == "travel")
				{
					$query = "Delete from travel where travelID = ?";
				}
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("i", $n);
					
					if($stmt->execute())
					{
					   	echo "<script> alert('Deleted successfully'); </script>";
						echo "<script> location = 'Profile.php'; </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the delHTL query"); </script>');
				}
			}
			
			function editHTL($id, $htlname, $rooms, $price, $rental, $desc, $break, $wifi, $Pet, $Swim, $c)
			{
				$query = "update hotels set name=?, rooms=?, price=?, rental=?, description=?, Wifi=?, breakast=?, pool=?, pets=? where htlID = ?";
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("siddsiiiii", $htlname, $rooms, $price, $rental, $desc, $wifi, $break, $Swim, $Pet,  $id);
					
					if($stmt->execute())
					{
					   	echo "<script> alert('Updated successfully'); </script>";
						echo "<script> location = 'Profile.php'; </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the editHTL query"); </script>');
				}
			}
			
			
			function editSer($i, $n, $ca, $d, $t, $c)
			{
				if($t == "rest")
				{
					$query = "update restaurants set name=?, category=?, description=? where restID = ?";
				}
				if($t == "att")
				{
					$query = "update attaractions set name=?, category=?, description=? where attID = ?";
				}
				if($t == "travel")
				{
					$query = "update travel set name=?, category=?, description=? where travelID = ?";
				}
				
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("sssi", $n, $ca, $d, $i);
					
					if($stmt->execute())
					{
					   	echo "<script> alert('Updated successfully'); </script>";
						echo "<script> location = 'Profile.php'; </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the editSer query"); </script>');
				}
			}
			
			function searchS($c, $i, $t)
			{
				if($t == "htl")
				{
					$query = "select name, description, image, htlID from hotels where name=?";
				}
				else if($t == "rest")
			    {
					$query = "select name, description, image, restID from restaurants where name=?";
				}
				else if($t == "att")
			    {
					$query = "select name, description, image, attID from attaractions where name=?";
				}
				else if($t == "travel")
			    {
					$query = "select name, description, image, travelID from travel where name=?";
				}
				
						  
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $i);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($n, $d, $im, $i);
							
							$result = array();
							while($stmt->fetch())
                            {
							  array_push($result, array($n, $d, $im, $i));
							}
						    
							return $result;
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
			
			
		}