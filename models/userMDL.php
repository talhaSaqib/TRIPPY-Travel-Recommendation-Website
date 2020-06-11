
<?php

		include("connection.php");
		
	    class user
		{
			
			function signup($f,$u,$p,$e,$t, $c)
			{ 
			    $query = 
			    "insert into users
			    (fullname, username, password, email, date, Type)
			    values
			    (?, ?, ?, ?, CURRENT_TIMESTAMP, ?)";
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("sssss", $f, $u, $p, $e, $t);
					if($stmt->execute())
					{
						session_start();
						$_SESSION["username"] = $u;
						
						echo "<script> location = 'Profile.php' </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the Signup query"); </script>');
				}
			}
			
			
			function login($u, $pass, $c)
			{
				$query = "select * from users where username = ?";
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $u);
					if($stmt->execute())
					{
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							$stmt->bind_result($f, $u, $p, $e, $i, $d, $t);
							$stmt->fetch();
							
							if(password_verify($pass, $p))
							{
								session_start();
								$_SESSION["username"] = $u;
								
								echo "<script> location = 'Profile.php' </script>";
							}
							else
							{
								echo '<script> alert("Wrong Password"); </script>' ;
								echo "<script> location = 'LogIn.php' </script>";
							}
						}
						else
						{
							echo('<script> alert("Wrong Username"); </script>');
							echo "<script> location = 'LogIn.php' </script>";
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the Login query"); </script>');
				}
				
			}
			
			function checkUsername($u, $c)
			{
				$query = "Select * from users where username = ?";
		        if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $u);
					
					if($stmt->execute())
					{			
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							return true;
						}
						else
						{
							return false;	
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the Check query"); </script>');
				}
			}
			
			
			function getUser($u, $c)
			{
				$query = "Select * from users where username = ?";
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $u);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							$stmt->bind_result($f, $u, $p, $e, $i, $d, $t);
							$stmt->fetch();

							$user = array($f,$u,$p,$e,$i,$t);
							return $user;	
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the getUser query"); </script>');
				}
			}
			
			
			function delUser($u, $c)
			{
				$query = "Delete from users where username = ?";
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $u);
					
					if($stmt->execute())
					{
					   	echo "<script> alert('Deleted successfully'); </script>";
						echo "<script> location = 'logout.php'; </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the delUser query"); </script>');
				}
			}
			
			
			function getbuss($u, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select * from userhtl U join hotels A on A.htlID = U.htlID where U.username = ?";
				}
				else if($t == "rest")
			    {
					$query = "select * from userRest U join restaurants A on A.restID = U.restID where U.username = ?";
				}
				else if($t == "att")
			    {
					$query = "select * from useratt U join attaractions A on A.attID = U.attID where U.username = ?";
				}
				else if($t == "travel")
			    {
					$query = "select * from usertravel U join travel A on A.travelID = U.travelID where U.username = ?";
				}
				
						  
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $u);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							if($t == "htl")
							{
								$stmt->bind_result($u, $i, $ii, $n, $r, $pr, $re, $d, $w, $b, $p, $pe, $im);
							}
							else if($t == "rest" || $t == "att" || $t == "travel")
							{
								$stmt->bind_result($u, $i, $ii, $n, $c, $d, $im);
							}
							
							
							$buss = array();
							while($stmt->fetch())
                            {
							  array_push($buss, array($n, $d, $im, $i));
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
			
			
			function getRR($n, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select * from likehtl U join hotels A on A.htlID = U.htlID where U.username = ?";
				}
				else if($t == "rest")
				{
					$query = "select * from likerest U join restaurants A on A.restID = U.restID where U.username = ?";
				}
				else if($t == "att")
				{
					$query = "select * from likeatt U join attaractions A on A.attID = U.attID where U.username = ?";
				}
				else if($t == "travel")
				{
					$query = "select * from liketravel U join travel A on A.travelID = U.travelID where U.username = ?";
				}

				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("s", $n);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							if($t == "htl")
							{
								$stmt->bind_result($user, $id, $rating, $review, $id2, $name, $room, $price, $rental, $desc, $w, $br, $poo, $pet, $img);
							}
							else if($t == "rest" || $t == "att" || $t == "travel")
							{
								$stmt->bind_result($user, $id, $rating, $review, $id2, $name, $category, $desc, $img);
							}
							
							$RR = array();
							while($stmt->fetch())
                            {
							  array_push($RR, array($name, $review, $rating, $img, $id));
							}
							
							return $RR;
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

			function rate($u, $id, $rat, $rev, $c, $t)
			{
				if($t == "htl")
				{
					$query = "Select * from likehtl where htlID = ? and username = ?";
				}
				else if($t == "rest")
				{
					$query = "Select * from likerest where restID = ? and username = ?";
				}
				else if($t == "att")
				{
					$query = "Select * from likeatt where attID = ? and username = ?";
				}
				else if($t == "travel")
				{
					$query = "Select * from liketravel where travelID = ? and username = ?";
				}
				
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("is", $id, $u);
					
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							if($t == "htl")
							{
								$query1 = "Update likehtl set rating = ?, review = ? where htlID = ? and username= ?";
							}
							else if($t == "rest")
							{
							    $query1 = "Update likerest set rating = ?, review = ? where restID = ? and username= ?";
							}
							else if($t == "att")
							{
							    $query1 = "Update likeatt set rating = ?, review = ? where attID = ? and username= ?";
							}
							else if($t == "travel")
							{
							    $query1 = "Update liketravel set rating = ?, review = ? where travelID = ? and username= ?";
							}
						}
						else
						{
							if($t == "htl")
							{
									$query1 = "INSERT into likehtl
											(rating, review, htlID, username)
											VALUES
											(?,?,?,?)";
							}
							else if($t == "rest")
							{
								$query1 = "INSERT into likerest
											(rating, review, restID, username)
											VALUES
											(?,?,?,?)";
							}
							else if($t == "att")
							{
								$query1 = "INSERT into likeatt
											(rating, review, attID, username)
											VALUES
											(?,?,?,?)";
							}
							else if($t == "travel")
							{
								$query1 = "INSERT into liketravel
											(rating, review, travelID, username)
											VALUES
											(?,?,?,?)";
							}
							
						}
						
						if($stmt = $c->prepare($query1))
						{
							$stmt->bind_param("dsis", $rat, $rev, $id, $u);
							
							if($stmt->execute())
							{
								echo "<script> alert('Rated successfully'); </script>";
								echo "<script> location = history.go(-1); </script>";
							}
							else{ echo($stmt->error); }
						}
						else{ echo('<script> alert("error in preparing the update or insert query"); </script>'); }
						
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the rate query"); </script>');
				}
			}
			
			
			function addhtl($user, $city, $name, $room, $price, $rent, $htldes, $wifi, $break, $pool, $pet, $lat, $lng, $image, $c)
			{
				$query  = "Insert into hotels
						   (name, rooms, price, rental, description, Wifi, breakast, pool, pets, image)
						   values
						   (?,?,?,?,?,?,?,?,?,?)";
						   
				if($stmt = $c->prepare($query))
				{
					$img = "images/".$image[0];
					
					$stmt->bind_param("siddsiiiis", $name, $room, $price, $rent, $htldes, $wifi, $break, $pool, $pet, $img);
					
					if($stmt->execute())
					{
						//upload image
						if(move_uploaded_file($image[1], $img))
						{
							//echo("<script> alert('Image uploaded Successfully'); </script>");
						}
						
						//get ID
						$id = $c->insert_id;
						
						$query = "Insert into userhtl
								  (username, htlID)
								  values
								  (?,?)";
								  
						if($stmt = $c->prepare($query))
						{
							$stmt->bind_param("si", $user, $id);

							if($stmt->execute())
							{
								$query = "Insert into lochtl
								  (city, htlID, lat, lng)
								  values
								  (?,?,?,?)";
								  
								if($stmt = $c->prepare($query))
								{
									$stmt->bind_param("sidd", $city, $id, $lat, $lng);
							
									if($stmt->execute())
									{
										echo('<script> alert("Added Successfully"); </script>');
										echo "<script> location = 'Profile.php'; </script>";
									}
									else
									{
										echo($stmt->error);
									}
								}
								else
								{
									echo('<script> alert("error in preparing the lochtl query"); </script>');
								}
								
							}
							else
							{
								echo($stmt->error);
							}
						}
						else
						{
							echo('<script> alert("error in preparing the insert userhtl query"); </script>');
						}

						
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the inserthtl query"); </script>');
				}
			}
				
			function addser($user, $city, $name, $cat, $des, $lat, $lng, $image, $t, $c)
			{
				if($t == "rest")
				{
					$query  = "Insert into restaurants
						   (name, category, description, image)
						   values
						   (?,?,?,?)";
				}
				else if($t == "att")
				{
					$query  = "Insert into attaractions
						   (name, category, description, image)
						   values
						   (?,?,?,?)";
				}
				else if($t == "travel")
				{
					$query  = "Insert into travel
						   (name, category, description, image)
						   values
						   (?,?,?,?)";
				}
					   
				if($stmt = $c->prepare($query))
				{
					$img = "images/".$image[0];
					
					$stmt->bind_param("ssss", $name, $cat, $des, $img);
					
					if($stmt->execute())
					{
						//upload image
						if(move_uploaded_file($image[1], $img))
						{
							//echo("<script> alert('Image uploaded Successfully'); </script>");
						}
						
						//get ID
						$id = $c->insert_id;
						
						if($t == "rest")
						{
							$query = "Insert into userrest
									  (username, restID)
									  values
									  (?,?)";
						}
						else if($t == "att")
						{
							$query = "Insert into useratt
									  (username, attID)
									  values
									  (?,?)";
						}
						else if($t == "travel")
						{
							$query = "Insert into usertravel
									  (username, travelID)
									  values
									  (?,?)";
						}
								  
						if($stmt = $c->prepare($query))
						{
							$stmt->bind_param("si", $user, $id);

							if($stmt->execute())
							{
								if($t == "rest")
								{
									$query = "Insert into locrest
									  (city, restID, lat, lng)
									  values
									  (?,?,?,?)";
								}
								else if($t == "att")
								{
									$query = "Insert into locatt
									  (city, attID, lat, lng)
									  values
									  (?,?,?,?)";
								}
								else if($t == "travel")
								{
									$query = "Insert into loctravel
									  (city, travelID, lat, lng)
									  values
									  (?,?,?,?)";
								}
								
								
								if($stmt = $c->prepare($query))
								{
									$stmt->bind_param("sidd", $city, $id, $lat, $lng);
							
									if($stmt->execute())
									{
										echo('<script> alert("Added Successfully"); </script>');
										echo "<script> location = 'Profile.php'; </script>";
									}
									else
									{
										echo($stmt->error);
									}
								}
								else
								{
									echo('<script> alert("error in preparing the locser query"); </script>');
								}
								
							}
							else
							{
								echo($stmt->error);
							}
						}
						else
						{
							echo('<script> alert("error in preparing the insert userser query"); </script>');
						}

						
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the insertser query"); </script>');
				}
			}
		
			
		}
	
?>

