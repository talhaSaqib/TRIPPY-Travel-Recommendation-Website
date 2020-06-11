<?php 
      include("connection.php");
	  include("serviceCTRL.php");
	  //include("locCTRL.php");
	  
      session_start();
	  
	  $ser = new serviceCTRL;
      $username = $_SESSION["username"];	  
	  $htlflag = 0;
	  $restflag = 0;
	  $attflag = 0;
	  $travelflag = 0;
	  
	  if(isset($_GET["htlBTN"]))
	  {
		  $htlflag = 1;
		  $ID = $_GET["htlID"];
		  
		  $htl = $ser->getSer($ID, $conn, "htl");
		  
		  $name = $htl[1];
		  $rooms = $htl[2];
		  $price = $htl[3];
		  $rental = $htl[4];
		  $desc = $htl[5];
		  $wifi = $htl[6];
		  $break = $htl[7];
		  $pool = $htl[8];
		  $pet = $htl[9];
		  $img = $htl[10];
		  $lat = $htl[11];
		  $lng = $htl[12];
		  
		  $rating = $ser->getSerRt($ID, $conn, "htl");
		  if($rating == NULL)
		  {
			  $rating = 0;
		  }
		  
		  $reviews = $ser->getSerRev($ID, $conn, "htl");
		  
		  $btn = "RRhtl";
		  $ID3 = "htlID3";
		  $claim = "claimhtl";
		  $srch = "Hotels";
		  $srchbtn = "srchhtl";
		  
		  $Names = $ser->getSerNames($conn, "htl");
	  }
	  
	  if(isset($_GET["restBTN"]))
	  {
		  $restflag = 1;
		  $ID = $_GET["restID"];
		  
		  $rest = $ser->getSer($ID, $conn, "rest");
		  
		  $name = $rest[1];
		  $desc = $rest[2];
		  $cat = $rest[3];
		  $img = $rest[4];
		  $lat = $rest[5];
		  $lng = $rest[6];
		  
		  $rating = $ser->getSerRt($ID, $conn, "rest");
		  if($rating == NULL)
		  {
			  $rating = 0;
		  }
		  
		  $reviews = $ser->getSerRev($ID, $conn, "rest");
		  
		  $btn = "RRrest";
		  $ID3 = "restID3";
		  $claim = "claimrest";
		  $srch = "Restaurants";
		  $srchbtn = "srchrest";
		  $Names = $ser->getSerNames($conn, "rest");
	  }
	 
	  if(isset($_GET["attBTN"]))
	  {
		  $attflag = 1;
		  $ID = $_GET["attID"];
		  
		  $att = $ser->getSer($ID, $conn, "att");
		  
		  $name = $att[1];
		  $desc = $att[2];
		  $cat = $att[3];
		  $img = $att[4];
		  $lat = $att[5];
		  $lng = $att[6];
		  
		  $rating = $ser->getSerRt($ID, $conn, "att");
		  if($rating == NULL)
		  {
			  $rating = 0;
		  }
		  
		  $reviews = $ser->getSerRev($ID, $conn, "att");
		  
		  $btn = "RRatt";
		  $ID3 = "attID3";
		  $claim = "claimatt";
		  $srch = "Attaractions";
		  $srchbtn = "srchatt";
		  $Names = $ser->getSerNames($conn, "att");
	  }

	  if(isset($_GET["travelBTN"]))
	  {
		  $travelflag = 1;
		  $ID = $_GET["travelID"];
		  
		  $travel = $ser->getSer($ID, $conn, "travel");
		  
		  $name = $travel[1];
		  $desc = $travel[2];
		  $cat = $travel[3];
		  $img = $travel[4];
		  $lat = $travel[5];
		  $lng = $travel[6];
		  
		  $rating = $ser->getSerRt($ID, $conn, "travel");
		  if($rating == NULL)
		  {
			  $rating = 0;
		  }
		  
		  $reviews = $ser->getSerRev($ID, $conn, "travel");
		  
		  $btn = "RRtravel";
		  $ID3 = "travelID3";
		  $claim = "claimtravel";
		  $srch = "Travel Options";
		  $srchbtn = "srchtravel";
		  $Names = $ser->getSerNames($conn, "travel");
	  }
	  
	  
	  
?>

<html>
			
			<script> 
				var locations = <?php echo json_encode($Names); ?>;	
			</script>
			
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
   


   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Service</title>
	
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
		  <div class="row main container-fluid center-block" id="SER" style="background: url('../<?php echo $img; ?>'); background-size: cover;">
			   <div class="row">
			     <div class="col-sm-4">
				 </div>
				 
				 <div class="col-sm-4 ">
				 <h1><?php echo $name; ?></h1>
				 </div>
			     
				 <div class="col-sm-4 ">
				 </div>
			   </div>
			   
			   <!--search bar-->
			   <div class="row" id="search">
			    <div class="col-xs-2">
				 </div>
				 
				 <div class="col-xs-8">
				 <form class="search" action="SearchResult.php" method="get">
				   <div class="form-group">
				      <input id="srch" type="text" class="form-control" name="srch" placeholder="Search <?php echo $srch ?>">
					   <div id="autocomplete"></div>
					  <button type="submit" class="btn btn-default center-block" name="<?php echo $srchbtn ?>" id="srchBTN">Search</button>
				 </div>
				 </form>
				 </div>
			     
				 <div class="col-xs-12">
				 </div>
			   </div>
			   <!---->  
		  </div>
		  
		  <!--modal-->
					<form class="modal fade" id="rate" method="post" action="userCTRL.php">
							  <div class="modal-dialog modal-sm">
							   <div class="modal-content">
								  <div class="modal-header">
									<h4 class="modal-title"><?php echo $name; ?></h4>
								  </div>
								  <div class="modal-body">

									<label>Rating</label>
									<div class="slidecontainer">
									  <input type="range" min="0" max="10" value="5" name="rating">
									</div>
									 
									<br>
									<label>Review</label>
									<textarea class="form-control" name="review" placeholder="Description" ></textarea>
									
									
									<input class="hidden" name="<?php echo $ID3; ?>" value="<?php echo $ID; ?>">
									<input class="hidden" name="username1" value="<?php echo $username; ?>">
									
								  </div>
								  <div class="modal-footer">
									<button class="btn btn-default" data-dismiss="modal">Cancel</button>
									<input name="<?php echo $btn; ?>" type="submit" class="btn btn-warning" value="Submit">
								  </div>
								</div>
							</div>
						</form>
		  
		  <!--Tabs-->
		  <div class="row center-block container">
			
			<ul class="nav nav-tabs tabs " id="nav">
				   <li class="active"><a data-toggle="tab" href="#Details">Details</a></li>
				   <li><a data-toggle="tab" href="#RR">Ratings and Reviews</a></li>
			</ul>
			
			<div class="tab-content">
			
				  <div id="Details" class="tab-pane fade in active">
					
					<div class="col-xs-9">
					   <?php if($htlflag == 1) { ?>
						<h3><b>Price: </b><?php echo $price; ?><h3>
						<h3><b>Rental: </b><?php echo $rental; ?><h3>
						<br>
					   <?php } 
							 else if($restflag == 1 || $attflag == 1 || $travelflag == 1) {
					   ?>
					   <h3><b>Category: </b><?php echo $cat; ?><h3>
					   <br>
					   <?php } ?>
					   
						<h4><b>Description</b><h4>
						<p><?php echo $desc; ?></p>
						
					<?php if($htlflag == 1) { ?>
						<br><br><br>
						<?php if($wifi) { ?>
						<h4><b>Wifi Available</b></h4>
						<?php } ?>
						
						<?php if($pet) { ?>
						<h4><b>Pets Allowed</b></h4>
						<?php } ?>
						
						<?php if($pool) { ?>
						<h4><b>Swimming Pool</b></h4>
						<?php } ?>
						
						<?php if($break) { ?>
						<h4><b>Breakfast</b></h4>
						<?php } ?>
					<?php } ?>
					</div>
					
					<div class="col-xs-3">
					    <!--AVG RATING-->
						<h1 style="padding-left: 15px"><b><?php echo $rating; ?>/10</b></h1>
						<h6 style="padding-left:15px"><b>Avg Rating</b></h6>
						<br>
					    <?php if(isset($_SESSION['username'])) { ?>
					     <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rate">Rate</button>
						  <?php } ?>
						  <?php if(!isset($_SESSION['username'])) { ?>
					      <a href="LogIn.php"><button type="submit" class="btn btn-default">Rate</button></a>
						  <?php } ?>
						<br><br>
						
						
						 <?php if(isset($_SESSION['username'])) { ?>
					     
						<form action="claimCTRL.php">
	
						   <input class="hidden" name="ID" value="<?php echo $ID; ?>">
						   <input class="hidden" name="user" value="<?php echo $username; ?>">
						   
						   <button type="submit" name="<?php echo $claim; ?>" class="btn btn-warning">Claim</button>
						 </form>
						 <?php } ?>
						 <?php if(!isset($_SESSION['username'])) { ?>
					     <a href="LogIn.php"><button type="submit" class="btn btn-warning">Claim</button></a>
						 <?php } ?>
					</div>
					
				  </div>
				  

				  <div id="RR" class="tab-pane fade">
				  <br>
					
					<?php foreach($reviews as $revs) { ?>
					
					<?php 
						if($revs[0] != $username)
						{
					      $link = "UserProfile.php?uname=$revs[0]";
						}
						else
						{
						   $link = "Profile.php";	
						}
					?>
					
					
					<div class="row">
					   <div class="col-xs-1" id="dp">
					     <a href="<?php echo $link; ?>"><img class="img-circle" src="<?php if($revs[3] != NULL) {echo $revs[3];} else echo"images/12.png"; ?>" width="60px" height="60px"></a>
					   </div>
					   
					   <div class="col-xs-8" id="content">
							<h4><?php echo $revs[0]; ?></h4>
							<p><?php echo $revs[2];  ?></p>
					   </div>
					   
					   <div class="col-xs-3" id="detail">
					     <h3 id="rating"><?php echo $revs[1]; ?>/10</h3>
						 
					   </div>
					</div>
					<br>
					
					<?php } ?>
					
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
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<!--For google map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUeGFx-N_ICbB8sE9UH8sEVizJrPvd120&callback=myMap"></script>
    <!--script-->
	<script src="js/script.js"></script>
</html>