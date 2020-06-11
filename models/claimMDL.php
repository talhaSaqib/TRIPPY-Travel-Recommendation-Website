
<?php

		include("connection.php");
		
	    class claimMDL
		{
			
			function approve($id, $owner, $claimer, $c, $t)
			{
				if($t == "htl")
				{
					$query="Delete from userhtl where username = ? and htlID = ?";
				}
				else if($t == "rest")
				{
					$query="Delete from userrest where username = ? and restID = ?";
				}
				else if($t == "att")
				{
					$query="Delete from useratt where username = ? and attID = ?";
				}
			    else if($t == "travel")
				{
					$query="Delete from usertravel where username = ? and travelID = ?";
				}
				
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("si", $owner, $id);
					
					if($stmt->execute())
					{
						if($t == "htl")
						{
							$query="INSERT into userhtl
									(username, htlID)
									VALUES
									(?, ?)";
						}
						else if($t == "rest")
						{
							$query="INSERT into userrest
									(username, restID)
									VALUES
									(?, ?)";
						}
						else if($t == "att")
						{
							$query="INSERT into useratt
									(username, attID)
									VALUES
									(?, ?)";
						}
						else if($t == "travel")
						{
							$query="INSERT into usertravel
									(username, travelID)
									VALUES
									(?, ?)";
						}
								
						if($stmt = $c->prepare($query))
						{
							$stmt->bind_param("si", $claimer, $id);
							
							if($stmt->execute())
							{
								if($t == "htl")
								{
									$query="Delete from claimhtl where owner=? and claimer=? and htlID = ?";
								}
								else if($t == "rest")
								{
									$query="Delete from claimrest where owner=? and claimer=? and restID = ?";
								}
								else if($t == "att")
								{
									$query="Delete from claimatt where owner=? and claimer=? and attID = ?";
								}
								else if($t == "travel")
								{
									$query="Delete from claimtravel where owner=? and claimer=? and travelID = ?";
								}
								
								if($stmt = $c->prepare($query))
								{
									$stmt->bind_param("ssi", $owner, $claimer, $id);
									
									if($stmt->execute())
									{
										echo('<script> alert("Approved!"); </script>');
								        echo "<script> location = history.go(-1); </script>";
									}
									else
									{
										echo($stmt->error);
									}
								}
								else
								{
									echo('<script> alert("error in preparing the inner inner approve query"); </script>');
								}
							}
							else
							{
								echo($stmt->error);
							}
						}
					    else
						{
							echo('<script> alert("error in preparing the inner approve query"); </script>');
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the approve query"); </script>');
				}
			}
			
			
			function decline($id, $owner, $claimer, $c, $t)
			{
				if($t == "htl")
				{
					$query="Delete from claimhtl where owner = ? and claimer = ? and htlID = ?";
				}
				else if($t == "rest")
				{
					$query="Delete from claimrest where owner = ? and claimer = ? and restID = ?";
				}
				else if($t == "att")
				{
					$query="Delete from claimatt where owner = ? and claimer = ? and attID = ?";
				}
				else if($t == "travel")
				{
					$query="Delete from claimtravel where owner = ? and claimer = ? and travelID = ?";
				}
				
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("ssi", $owner, $claimer, $id);
					
					if($stmt->execute())
					{
						echo('<script> alert("Declined!"); </script>');
						echo "<script> location = history.go(-1); </script>";
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the inner inner approve query"); </script>');
				}
			}
			
			
			function getClaim($c, $t)
			{
				if($t == "htl")
				{
					$query = "select C.htlID, C.owner, C.claimer, C.OwnImg, H.image, U.image, H.name from claimhtl C 
							  join hotels H on C.htlID = H.htlID join users U on U.username = C.claimer";
				}
				else if($t == "rest")
				{
					$query ="select C.restID, C.owner, C.claimer, C.OwnImg, H.image, U.image, H.name from claimrest C 
						     join restaurants H on C.restID = H.restID join users U on U.username = C.claimer";
				}
				else if($t == "att")
				{
					$query ="select C.attID, C.owner, C.claimer, C.OwnImg, H.image, U.image, H.name from claimatt C 
						     join attaractions H on C.attID = H.attID join users U on U.username = C.claimer";
				}
				else if($t == "travel")
				{
					$query ="select C.travelID, C.owner, C.claimer, C.OwnImg, H.image, U.image, H.name from claimtravel C 
						     join travel H on C.travelID = H.travelID join users U on U.username = C.claimer";
				}

				
				if($stmt = $c->prepare($query))
				{
					if($stmt->execute())
					{
						$stmt->store_result();
						
					   	if($stmt->num_rows > 0)
						{
							$stmt->bind_result($id, $owner, $claimer, $oimg, $himg, $cimg, $name);
							$claims = array();
							while($stmt->fetch())
                            {
							  array_push($claims, array($id, $owner, $claimer, $oimg, $himg, $cimg, $name));
							}
							return $claims;
						}
					}
					else
					{
						echo($stmt->error);
					}
				}
				else
				{
					echo('<script> alert("error in preparing the getclaimhtl query"); </script>');
				}
				
			}
			
	
			
			function claim($id, $user, $c, $t)
			{
				if($t == "htl")
				{
					$query = "select U.username, U.image from users U join userhtl H on U.username = H.username where htlID = ?";
				}
				else if($t == "rest")
				{
					$query = "select U.username, U.image from users U join userrest H on U.username = H.username where restID = ?";
				}
				else if($t == "att")
				{
					$query = "select U.username, U.image from users U join useratt H on U.username = H.username where attID = ?";
				}
				else if($t == "travel")
				{
					$query = "select U.username, U.image from users U join usertravel H on U.username = H.username where travelID = ?";
				}
				
				if($stmt = $c->prepare($query))
				{
					$stmt->bind_param("i", $id);
					
					if($stmt->execute())
					{			
						$stmt->store_result();
						
						if($stmt->num_rows > 0)
						{
							$stmt->bind_result($owner, $img);
							$stmt->fetch();
											
											if($t == "htl")
											{
												$query = "Select * from claimhtl where htlID = ? and owner = ? and claimer = ?";
											}
											else if($t == "rest")
											{
												$query = "Select * from claimrest where restID = ? and owner = ? and claimer = ?";
											}
											else if($t == "att")
											{
												$query = "Select * from claimatt where attID = ? and owner = ? and claimer = ?";
											}
											else if($t == "travel")
											{
												$query = "Select * from claimtravel where travelID = ? and owner = ? and claimer = ?";
											}
											
											if($stmt = $c->prepare($query))
											{
												$stmt->bind_param("iss", $id, $owner, $user);
												
												if($stmt->execute())
												{
													$stmt->store_result();
													
													if($stmt->num_rows > 0)
													{
														echo('<script> alert("Already Claimed. Please wait for admin approval"); </script>');
														echo "<script> location = history.go(-1); </script>";
													}
													else
													{
														if($t == "htl")
														{
															$query1 = "INSERT into claimhtl
																	(htlID, owner, claimer, OwnImg)
																	VALUES
																	(?,?,?,?)";
														}
														else if($t == "rest")
														{
															$query1 = "INSERT into claimrest
																	(restID, owner, claimer, OwnImg)
																	VALUES
																	(?,?,?,?)";
														}
														else if($t == "att")
														{
															$query1 = "INSERT into claimatt
																	(attID, owner, claimer, OwnImg)
																	VALUES
																	(?,?,?,?)";
														}
														else if($t == "travel")
														{
															$query1 = "INSERT into claimtravel
																	(travelID, owner, claimer, OwnImg)
																	VALUES
																	(?,?,?,?)";
														}
													}
													
													if($stmt = $c->prepare($query1))
													{
														$stmt->bind_param("isss", $id, $owner, $user, $img);
														
														if($stmt->execute())
														{
															echo "<script> alert('Claimed successfully! Pending Approval'); </script>";
															echo "<script> location = history.go(-1); </script>";
														}
														else{ echo($stmt->error); }
													}
													else{ echo('<script> alert("error in preparing Claim inner query"); </script>'); }
													
												}
												else
												{
													echo($stmt->error);
												}
											}
											else
											{
												echo('<script> alert("error in preparing the claim query"); </script>');
											}
						}
						else
						{
								echo('<script> alert("no owner"); </script>');
								echo "<script> location = history.go(-1); </script>";
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
		}
			

?>
		
		
		
		
		