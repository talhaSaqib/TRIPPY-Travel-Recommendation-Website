<?php 
      include("connection.php");
	  include("locCTRL.php");
	  
      session_start();
	  $username = $_SESSION["username"];
	  
	  $locCTRL = new locCTRL;
	  $locNames = $locCTRL->getLocNames1($conn);
	  
	  
	    if(isset($_GET["search"]))
		{
			$input = $_GET["srch"];
			$loc = new locCTRL;
			
			$input = trim(stripslashes(htmlspecialchars($input)));
			
			$city = $loc->getLocData($input, $conn);
		}
		
		$name = $city[0];
		$lat = $city[1];
		$lng = $city[2];
		$img = $city[3];
		
		$hotels = $locCTRL->getBuss($name, $conn, "htl");
		$rest = $locCTRL->getBuss($name, $conn, "rest");
		$att = $locCTRL->getBuss($name, $conn, "att");
		$travel = $locCTRL->getBuss($name, $conn, "travel");
		
?>


<html>
		<script> 
				var locations = <?php echo json_encode($locNames); ?>;	
		</script> 



   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Location</title>
	
          <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">	  
		  <link rel="stylesheet" type="text/css" href="css/style.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		  
		  
		  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   </head>

   <body>
				<!--modals-->
				 <form class="modal fade" id="log-modal" action="logout.php">
		            <div class="modal-dialog modal-sm">
			           <div class="modal-content">
				          <div class="modal-header">
				            <h4 class="modal-title">Log Out</h4>
				          </div>
			              <div class="modal-body">
				            <p>Are you sure you want to log out?<p>
				          </div>
				          <div class="modal-footer">
				            <button class="btn btn-default" data-dismiss="modal">No</button>
				            <input type="submit" class="btn btn-warning" value="Yes">
				          </div>
			            </div>
			        </div>
		        </form>
				
				<form class="modal fade" id="del-modal" method="post" action="deleteCTRL.php">
				      <div class="modal-dialog modal-sm">
			           <div class="modal-content">
				          <div class="modal-header">
				            <h4 class="modal-title">Delete Profile</h4>
				          </div>
			              <div class="modal-body">
				            <p>Are you sure you want to delete your profile?<p>
				          </div>
				          <div class="modal-footer">
				            <button class="btn btn-default" data-dismiss="modal">No</button>
				            <input name="deleteUser" type="submit" class="btn btn-danger" value="Yes">
				          </div>
			            </div>
			        </div>
		        </form>
   
   
		<!--navbar-->
	   <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			<div class="container">
			
				   <div class="navbar-header">
					   <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					     <span class="sr-only">Toggle navigation</span>
						 <span class="icon-bar"></span>
						 <span class="icon-bar"></span>
						 <span class="icon-bar"></span>
					   </button>
				       <a class="navbar-brand" href="Trippy.php">Trippy</a>
				   </div>
				   
				   
			 
			 <div class="collapse navbar-collapse" id="navbar-collapse">
			 
			    <ul class="nav navbar-nav navbar-left" id="nav">
				   <li ><a href="Trippy.php">Home</a></li>
				   <li ><a href="Hotels.php">Hotels</a></li>
				   <li ><a href="Restaurants.php">Restaurants</a></li>
				   <li><a href="Attaractions.php">Attaractions</a></li>
				   <li><a href="Travel.php">Travel Options</a></li>
				</ul>
				
				 <!--join-->
			   <div class="nav navbar-nav navbar-right" id="join">
					
			     <?php if(!isset($_SESSION['username'])) { ?>
			     <a href="SignUp.php"><button type="submit" class="btn btn-default">Join</button></a>
				 <?php }?>
				 <?php if(isset($_SESSION['username'])) { ?>
				  <a href="Profile.php"><button type="submit" class="btn btn-default">Profile</button></a>&nbsp &nbsp
				 <button id="logout" class="btn btn-default" data-toggle="modal" data-target="#log-modal">LogOut</button>
			     <?php }?>
			   </div>
				
			   </div>
			   
			</div>
		  </nav>
		  
		  <!--main-->
		  <div class="row main container-fluid center-block" id="LOC" style="background: url('../<?php echo $img; ?>'); background-size: cover;"> 
			   <div class="row">
			     <div class="col-sm-4">
				 </div>
				 
				 <div class="col-sm-4 ">
				 <h1 id="cityname"><?php echo $name; ?></h1>
				 </div>
			     
				 <div class="col-sm-4 ">
				 </div>
			   </div>
			   
			   <!--search bar-->
			   <div class="row" id="search">
			    <div class="col-xs-2">
				 </div>
				 
				 <div class="col-xs-8">
				 <form class="search" action="location.php" method="get">
				   <div class="form-group">
				      <input id="srch" type="text" name="srch" class="form-control" placeholder="Enter City">
					  <div id="autocomplete"></div>
					  <button type="submit" class="btn btn-default center-block" name="search" id="srchBTN">Search</button>
				 </div>
				 </form>
				 </div>
			     
				 <div class="col-xs-12">
				 </div>
			   </div>
			   <!---->  
		  </div>
		  
		  <!--Tabs-->
		  <div class="row center-block container">
			
			<ul class="nav nav-tabs tabs " id="nav">
				   <li class="active"><a data-toggle="tab" href="#Hotels">Hotels</a></li>
				   <li><a data-toggle="tab" href="#Restaurants">Restaurants</a></li>
				   <li><a data-toggle="tab" href="#Attaractions">Attaractions</a></li>
				   <li><a data-toggle="tab" href="#Travel">Travel Options</a></li>
			</ul>
			
			<div class="tab-content">
				
				<!--<p style="text-align: center; color: #00b8e6" id="loading"><b>Please wait while loading....</b></p>-->
			
				  <div id="Hotels" class="tab-pane fade in active">
					
					<!--slider-->
					<div class="row" id="sliders">
					
						<div class="col-xs-3"></div>
						
						<div class="col-xs-3">
						
							<label>Price:</label>
							<div id="range"></div>
							<p>
								<b>Amount: </b><span id="amount"></span>
								<input type="hidden" value="0" id="minv">
								<input type="hidden" value="7000" id="maxv">
							</p>
							
						</div>
						
						<div class="col-xs-3">
							<label>Rating:</label>
							<div id="range1"></div>
							<p>
								<b>Score: </b><span id="amount1"></span>
								<input type="hidden" value="0" id="mins">
								<input type="hidden" value="10" id="maxs">
							</p>
							
						</div>
						
						<div class="col-xs-3"></div>
					
					</div>
					
					<!--<div class="row" id="checkboxes">
					
						<div class="col-xs-4"></div>
						
						<div class="col-xs-4">
						
							<div class="checkbox center-block">
							  <label><input type="checkbox" value="" class="filter"><b>WIFI</b></label>&nbsp &nbsp
							  <label><input type="checkbox" value="" class="filter"><b>Breakfast</b></label>&nbsp &nbsp
							  <label><input type="checkbox" value="" class="filter"><b>Pool</b></label>&nbsp &nbsp
							  <label><input type="checkbox" value="" class="filter"><b>Pets Allowed</b></label>
							</div>
						
						</div>
					
						<div class="col-xs-4"></div>
					
					</div>-->
					<br>
					
					<div id="replace">
					<?php foreach($hotels as $htl) { ?>
					
					<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="<?php echo $htl[3]; ?>">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3><?php echo $htl[0]; ?></h3>
							<h4>Rs.<?php echo $htl[1]; ?></h4>
							<p><?php echo $htl[2]; ?></p>
							</div>
					   
								<form class="modal fade" id="rate<?php echo $htl[5]; ?>" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title"><?php echo $htl[0]; ?></h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="htlID3" value="<?php echo $htl[5]; ?>">
											<input class="hidden" name="username1" value="<?php echo $username; ?>">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRhtl" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b><?php echo $htl[4]; ?>/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  <?php if(isset($_SESSION['username'])) { ?>
					     <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rate<?php echo $htl[5]; ?>">Rate</button>
						  <?php } ?>
						  <?php if(!isset($_SESSION['username'])) { ?>
					      <a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>
						  <?php } ?>
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="htlID" value="<?php echo $htl[5]; ?>">
								<button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					<?php } ?>
					
				  </div>
				  </div>
				  
				  <!--**Restaurants**-->
				  <div id="Restaurants" class="tab-pane fade">
					
					<!--slider-->
					<div class="row" id="sliders">
					
						<div class="col-xs-4"></div>
						
						<div class="col-xs-4">
							<label>Rating:</label>
							<div id="rangerest"></div>
							<p>
								<b>Score: </b><span id="amountrest"></span>
								<input type="hidden" value="0" id="minsrest">
								<input type="hidden" value="10" id="maxsrest">
							</p>
							
						</div>
						
						<div class="col-xs-4"></div>
					
					</div>
					
					
					<div id="replacerest">
					<?php foreach($rest as $R) { ?>
					
					<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="<?php echo $R[3]; ?>">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3><?php echo $R[0]; ?></h3>
							<h4><?php echo $R[1]; ?></h4>
							<p><?php echo $R[2]; ?></p>
							</div>
					   
								<form class="modal fade" id="rateR<?php echo $R[5]; ?>" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title"><?php echo $R[0]; ?></h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="restID3" value="<?php echo $R[5]; ?>">
											<input class="hidden" name="username1" value="<?php echo $username; ?>">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRrest" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b><?php echo $R[4]; ?>/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  <?php if(isset($_SESSION['username'])) { ?>
					     <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateR<?php echo $R[5]; ?>">Rate</button>
						  <?php } ?>
						  <?php if(!isset($_SESSION['username'])) { ?>
					      <a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>
						  <?php } ?>
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="restID" value="<?php echo $R[5]; ?>">
								<button type="submit" name="restBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					<?php } ?>
					
					</div>
					</div>
				  
				  <!--**Attaractions**-->
				  <div id="Attaractions" class="tab-pane fade">
						
						<!--slider-->
					<div class="row" id="sliders">
					
						<div class="col-xs-4"></div>
						
						<div class="col-xs-4">
							<label>Rating:</label>
							<div id="rangeatt"></div>
							<p>
								<b>Score: </b><span id="amountatt"></span>
								<input type="hidden" value="0" id="minsatt">
								<input type="hidden" value="10" id="maxsatt">
							</p>
							
						</div>
						
						<div class="col-xs-4"></div>
					
					</div>
						
						
				  <div id="replaceatt">
					<?php foreach($att as $A) { ?>
					
					<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="<?php echo $A[3]; ?>">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3><?php echo $A[0]; ?></h3>
							<h4><?php echo $A[1]; ?></h4>
							<p><?php echo $A[2]; ?></p>
							</div>
					   
								<form class="modal fade" id="rateA<?php echo $A[5]; ?>" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title"><?php echo $A[0]; ?></h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="attID3" value="<?php echo $A[5]; ?>">
											<input class="hidden" name="username1" value="<?php echo $username; ?>">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRatt" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b><?php echo $A[4]; ?>/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  <?php if(isset($_SESSION['username'])) { ?>
					     <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateA<?php echo $A[5]; ?>">Rate</button>
						  <?php } ?>
						  <?php if(!isset($_SESSION['username'])) { ?>
					      <a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>
						  <?php } ?>
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="attID" value="<?php echo $A[5]; ?>">
								<button type="submit" name="attBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					<?php } ?>
					
				  </div>
				  </div>
				  
				  <!--**Travel**-->
				  <div id="Travel" class="tab-pane fade">
					
					<!--slider-->
					<div class="row" id="sliders">
					
						<div class="col-xs-4"></div>
						
						<div class="col-xs-4">
							<label>Rating:</label>
							<div id="rangetravel"></div>
							<p>
								<b>Score: </b><span id="amounttravel"></span>
								<input type="hidden" value="0" id="minstravel">
								<input type="hidden" value="10" id="maxstravel">
							</p>
							
						</div>
						
						<div class="col-xs-4"></div>
					
					</div>
					
					
				   <div id="replacetravel">
					<?php foreach($travel as $T) { ?>
					
					<div class="row">
					   <div class="col-xs-3" id="pic">
					     <img class="img-responsive" src="<?php echo $T[3]; ?>">
					   </div>
					   
					   <div class="col-xs-6" id="content">
							<h3><?php echo $T[0]; ?></h3>
							<h4><?php echo $T[1]; ?></h4>
							<p><?php echo $T[2]; ?></p>
							</div>
					   
								<form class="modal fade" id="rateT<?php echo $T[5]; ?>" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title"><?php echo $T[0]; ?></h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="travelID3" value="<?php echo $T[5]; ?>">
											<input class="hidden" name="username1" value="<?php echo $username; ?>">
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="RRtravel" type="submit" class="btn btn-warning" value="Submit">
										  </div>
										</div>
									</div>
								</form>
					   
					   
					   <div class="col-xs-3" id="detail">
					     <h2 id="rating"><b><?php echo $T[4]; ?>/10</b></h2>
						 <h6><b>Avg Rating</b></h6>
						 <br>
						  <?php if(isset($_SESSION['username'])) { ?>
					     <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateT<?php echo $T[5]; ?>">Rate</button>
						  <?php } ?>
						  <?php if(!isset($_SESSION['username'])) { ?>
					      <a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>
						  <?php } ?>
						 <br><br>
						 <form action="Service.php">
								<input class="hidden" name="travelID" value="<?php echo $T[5]; ?>">
								<button type="submit" name="travelBTN" class="btn btn-warning">Details</button>
					     </form>
					   </div>
					</div>
					<br>
					
					<?php } ?>
					
				  </div>
				  </div>
				  
			</div>
		     
		  </div>
		  
		  
		   <!--Map Api-->
		  
		  <div class="row center-block" id="map">
		    <input class="hidden" id="lat" value=<?php echo $lat; ?>>
		    <input class="hidden" id="lng" value=<?php echo $lng; ?>>
		  </div>
		  
		  <!--Form-->
        <div class="row center-block" id="form-container">
		 
		 <div class="col-sm-6 col-xs-12" id="head-block">
		     <h1>YOU CAN CONTACT <br>US HERE</h1>
			 <hr>
			 <p>Yup! You can. But don't just randomly send us 'Hi' messages, lol.<p>
		  </div>
		  
		  <div class="col-sm-6 col-xs-12" id="form-block">  
			<form class="form-horizontal">
			  <div class="form-group">
			     <label class="sr-only">Subject</label>
				 <input type="text" placeholder="Subject" class="form-control">
			  </div>
			  <div class="form-group">
			     <label class="sr-only">Email</label>
				 <input type="email" placeholder="@Email" class="form-control">
			  </div>
			  <div class="form-group">
			     <label class="sr-only">Message</label>
				 <textarea placeholder="Message" class="form-control msg" rows="3"></textarea>
			  </div>
			  <div class="checkbox">
				  <label>
				  <input type="checkbox"> I am not a Robot.
				  </label>
			  </div>
			  <button type="submit" class="btn btn-warning pull-right">Submit</button>
			  </form>
		  </div>
		
		</div>
		  
		  <!--Bottom-->
		<div class="row center-block container-fluid" id="link-block">
		
		<div class="row">
		 <div class="col-xs-8 bout">
		   <h2>About Us</h2>
		   <p id="about">Trippy, the world's largest travel site*, enables travelers to unleash the full potential of every trip. 
		   With over 600 million reviews and opinions covering the world's largest selection of travel listings worldwide – 
		   covering approximately 7.5 million accommodations, airlines, attractions, and restaurants -- Trippy provides 
		   travelers with the wisdom of the crowds to help them decide where to stay, how to fly, what to do and where to eat.
		   Trippy also compares prices from more than 200 hotel booking sites so travelers can find the lowest price on the 
		   hotel that's right for them. Trippy-branded sites are available in 49 markets, and are home to the world's largest
		   travel community of 455 million average monthly unique visitors**, all looking to get the most out of every trip.
		   Trippy: Know better. Book better. Go better.</p>
		   
		 </div>
		 
		 <div class="col-xs-2 linkk">
		   <h4>Guests</h4>
		   <a href="">Hiroshima.tk</a></br>
		   <a href="">Splite</a></br>
		   <a href="">Ballroom</a></br>
		   <a href="">Yumy.pk</a></br>
		   <a href="">Burj-Sham</a></br>
		   <a href="">Pioneer</a></br>
		 </div>
		 
		 <div class="col-xs-2 linkk">
		   <h4>Contacts</h4>
		   <a href="">Hiroshima.tk</a></br>
		   <a href="">Splite</a></br>
		   <a href="">Ballroom</a></br>
		   <a href="">Yumy.pk</a></br>
		   <a href="">Burj-Sham</a></br>
		   <a href="">Pioneer</a></br>
		 </div>
		 
		</div>
		
		 <div class="row center-block" id="copyrights">
		   <div id="social">
            <a href="#" class="fa fa-twitter"></a>
		    <a href="#" class="fa fa-facebook"></a>
		    <a href="#" class="fa fa-pinterest"></a>
		   </div>
		    <h4>Copyrights-@TalhaSaqib-15L4172</h4>
		 </div>
		
		</div>
		  
		  <!--Jmp to top-->
		<a href="#" class="scrollTop">^</a>
	      
   </body>
   
   <!--JS CDN-->	
	<!--<script src="//code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
	<!--if CDN fails then local version-->
    <script>window.jQuery || document.write('<script src="js/jquery-3.2.1.min.js"><\/script>')</script>
	<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<!--For google map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUeGFx-N_ICbB8sE9UH8sEVizJrPvd120&callback=myMap"></script>
    <!--script-->
	<script src="js/script.js"></script>
</html>