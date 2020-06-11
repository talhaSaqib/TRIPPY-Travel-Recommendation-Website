
<?php
		include("connection.php");
		include("locMDL.php");
		
		session_start();
		$username = $_SESSION["username"];
		
	    class locCTRL
		{
			
			function getLocNames1($c)
			{ 
			    $loc = new location;
				return $loc->getLocNames($c);
			}
			
			function getLocData($i,$c)
			{ 
			    $loc = new location;
			    return $loc->getLocData($i, $c);
			}
			
			function getBuss($n, $c, $t)
			{
				$loc = new location;
			    return $loc->getBuss($n, $c, $t);
			}
			
			function htlfilter($pmin, $pmax, $rmin, $rmax, $city, $c)
			{
				$loc = new location;
				return $loc->htlfilter($pmin, $pmax, $rmin, $rmax, $city, $c);
			}
			
			function serfilter($rmin, $rmax, $city, $c, $t)
			{
				$loc = new location;
				return $loc->htlfilter($rmin, $rmax, $city, $c, $t);
			}
			
		}
		
		//ajax data decoding
		//hotel
		$obj = json_decode($_GET["x"], false);
		
		if($obj->htlfil)
		{
			
			$pmin = $obj->pmin;
			$pmax = $obj->pmax;
			$rmin = $obj->rmin;
			$rmax = $obj->rmax;
			$city = $obj->city;
			
			$loc = new locCTRL;
			$hotels = $loc->htlfilter($pmin, $pmax, $rmin, $rmax, $city, $conn);
			
			if($hotels != null)
			{
				
				foreach($hotels as $htl) 
				{
					if(isset($_SESSION["username"])) 
					{
						$string = '<button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rate'.$htl[5].'">Rate</button>';
					}
					else if(!isset($_SESSION["username"]))
					{
						$string = '<a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>';
					}
					
					
				  echo  '
					
					<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="'.$htl[3].'">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3>'.$htl[0].'</h3>
							<h4>Rs.'.$htl[1].'</h4>
							<p>'.$htl[2].'</p>
							</div>
					   
								<form class="modal fade" id="rate'.$htl[5].'" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">'.$htl[0].'</h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="htlID3" value="'.$htl[5].'">
											<input class="hidden" name="username1" value="'.$username.'">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRhtl" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b>'.$htl[4].'/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						
						 <!--ratebutton-->
						 '.$string.'
						  
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="htlID" value="'.$htl[5].'">
								<button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
				  </div>
				 ';
				}
			}
			else
			{
				echo "<h3 style='text-align: center; color: #00b8e6'><b>No Result Found</b></h3>";
			}
		}
		
		//make it generic next time!!!
		//service
		$obj = json_decode($_GET["y"], false);
		
		if($obj->restfil)
		{
			
			$rmin = $obj->rmin;
			$rmax = $obj->rmax;
			$city = $obj->city;
			$t = $obj->type;
			
			$loc = new locCTRL;
			$rest = $loc->serfilter($rmin, $rmax, $city, $conn, $t);
			
			if($rest != null)
			{
				foreach($rest as $R) 
				{
					if(isset($_SESSION["username"])) 
					{
						$string = '<button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateR'.$R[5].'">Rate</button>';
					}
					else if(!isset($_SESSION["username"]))
					{
						$string = '<a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>';
					}
					
					
				  echo  
				  '
						<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="'.$R[3].'">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3>'.$R[0].'</h3>
							<h4>'.$R[1].'</h4>
							<p>'.$R[2].'</p>
							</div>
					   
								<form class="modal fade" id="rateR'.$R[5].'" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">'.$R[0].'</h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="restID3" value="'.$R[5].'">
											<input class="hidden" name="username1" value="'.$username.'">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRrest" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b>'.$R[4].'/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  
						  '.$string.'
						  
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="restID" value="'.$R[5].'">
								<button type="submit" name="restBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					</div>
				  
				  ';
				}
			}
			else
			{
				echo "<h3 style='text-align: center; color: #00b8e6'><b>No Result Found</b></h3>";
			}
		}
		
		$obj1 = json_decode($_GET["z"], false);
		if($obj1->attfil)
		{
			
			$rmin = $obj->rmin;
			$rmax = $obj->rmax;
			$city = $obj->city;
			$t = $obj->type;
			
			$loc = new locCTRL;
			$att = $loc->serfilter($rmin, $rmax, $city, $conn, $t);
			
			if($att != null)
			{
				foreach($att as $A) 
				{
					if(isset($_SESSION["username"])) 
					{
						$string = '<button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateA'.$A[5].'">Rate</button>';
					}
					else if(!isset($_SESSION["username"]))
					{
						$string = '<a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>';
					}
					
					
				  echo  
				  '
						<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="'.$A[3].'">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3>'.$A[0].'</h3>
							<h4>'.$A[1].'</h4>
							<p>'.$A[2].'</p>
							</div>
					   
								<form class="modal fade" id="rateA'.$A[5].'" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">'.$A[0].'</h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="attID3" value="'.$A[5].'">
											<input class="hidden" name="username1" value="'.$username.'">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRatt" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b>'.$A[4].'/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  
						  '.$string.'
						  
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="attID" value="'.$A[5].'">
								<button type="submit" name="attBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					</div>
				  
				  ';
				}
			}
			else
			{
				echo "<h3 style='text-align: center; color: #00b8e6'><b>No Result Found</b></h3>";
			}
		}
		
		$obj = json_decode($_GET["a"], false);
		if($obj->travelfil)
		{
			$rmin = $obj->rmin;
			$rmax = $obj->rmax;
			$city = $obj->city;
			$t = $obj->type;
			
			$loc = new locCTRL;
			$travel = $loc->serfilter($rmin, $rmax, $city, $conn, $t);
			
			if($travel != null)
			{
				foreach($travel as $T) 
				{
					if(isset($_SESSION["username"])) 
					{
						$string = '<button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateT'.$T[5].'">Rate</button>';
					}
					else if(!isset($_SESSION["username"]))
					{
						$string = '<a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>';
					}
					
					
				  echo  
				  '
						<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="'.$T[3].'">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3>'.$T[0].'</h3>
							<h4>'.$T[1].'</h4>
							<p>'.$T[2].'</p>
							</div>
					   
								<form class="modal fade" id="rateT'.$T[5].'" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">'.$T[0].'</h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="travelID3" value="'.$T[5].'">
											<input class="hidden" name="username1" value="'.$username.'">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRtravel" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b>'.$T[4].'/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  
						  '.$string.'
						  
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="travelID" value="'.$T[5].'">
								<button type="submit" name="travelBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					</div>
				  
				  ';
				}
			}
			else
			{
				echo "<h3 style='text-align: center; color: #00b8e6'><b>No Result Found</b></h3>";
			}
		}
		
		
		
		
	
?>

