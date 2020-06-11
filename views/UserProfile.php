<?php 
      include("connection.php");
	  include("userCTRL.php");
	  
      session_start();
	  $userCTRL = new userCTRL;
	  
	  $username = $_GET["uname"];
	  $user = $userCTRL->getUserData($username, $conn);
	  
	  $fullname = $user[0];
	  $username = $user[1];
	  $email = $user[3];
	  $image = $user[4];
	  $type = $user[5];
	  
	  if($image == NULL)
	  {
		  $image = "images/12.png";
	  }
	  
	  $hotels = $userCTRL->getbuss($username, $conn, "htl");
	  $RR = $userCTRL->getRR($username, $conn, "htl");
	  
	  $rest = $userCTRL->getbuss($username, $conn, "rest");
	  $restRR = $userCTRL->getRR($username, $conn, "rest");
	  
	  $att = $userCTRL->getbuss($username, $conn, "att");
	  $attRR = $userCTRL->getRR($username, $conn, "att");
	  
	  $travel = $userCTRL->getbuss($username, $conn, "travel");
	  $travelRR = $userCTRL->getRR($username, $conn, "travel");
?>



<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Profile</title>
	
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
				
				 <!--Buttons-->
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
		  <!---->

			<!--profile-->
			
				<div class="row container" id="profile">
				  
				  <div class="col-md-5 col-xs-2"></div>
				  
				  <div class="col-md-2 col-xs-4">
						<div id="image-div" class="center-block">
						 <img src="<?php echo $image; ?>" class="img-circle">
					   </div>
				  </div>
				  
				  <div class="col-md-2 col-xs-4" id="PRdata">				  
					 <h2><?php echo $fullname; ?></h2>
					 <h4><?php echo $username; ?></h4>
					 <h4><?php echo $email; ?></h4>
					
				 </div>
					
				  <div class="col-md-3 col-xs-2"></div>
				</div>

				<br>
				
				
				<!--Listing-->
				
				<div class="row center-block container">
					
					<h3 id="RRhead">Services</h3>
					
					<ul class="nav nav-tabs tabs" id="nav">
						   <li class="active"><a data-toggle="tab" href="#Hotels1">Hotels</a></li>
						   <li><a data-toggle="tab" href="#Restaurants1">Restaurants</a></li>
						   <li><a data-toggle="tab" href="#Attaractions1">Attaractions</a></li>
						   <li><a data-toggle="tab" href="#Travel1">Travel Options</a></li>
					</ul>
					
					    <div class="tab-content">
					
						  <div id="Hotels1" class="tab-pane fade in active">
							
							<?php foreach($hotels as $htls) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $htls[2]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $htls[0]; ?></h3>
									<p><?php echo $htls[1]; ?></p>
							   </div>
							   
							   <div class="col-xs-3" id="detail">
								 <br>
								
								 <form action="Service.php">
								   <input class="hidden" name="htlID" value="<?php echo $htls[3]; ?>">
								   <button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br><br>
							
							<?php } ?>
						  
						   </div>
						   
						   <div id="Restaurants1" class="tab-pane fade in">
								
							<?php foreach($rest as $R) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $R[2]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $R[0]; ?></h3>
									<p><?php echo $R[1]; ?></p>
							   </div>
							   
							   <div class="col-xs-3" id="detail">
								 <br>
								
								 <form action="Service.php">
								   <input class="hidden" name="restID" value="<?php echo $R[3]; ?>">
								   <button type="submit" name="restBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br><br>
							
							<?php } ?>
								
						   </div>
						   
						   
						   <div id="Attaractions1" class="tab-pane fade in">
								
							<?php foreach($att as $A) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $A[2]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $A[0]; ?></h3>
									<p><?php echo $A[1]; ?></p>
							   </div>
							   
							   <div class="col-xs-3" id="detail">
								 <br>
								
								 <form action="Service.php">
								   <input class="hidden" name="attID" value="<?php echo $A[3]; ?>">
								   <button type="submit" name="attBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br><br>
							
							<?php } ?>
						   
						   </div>
						   
						   
						   <div id="Travel1" class="tab-pane fade in ">
						   
							<?php foreach($travel as $T) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $T[2]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $T[0]; ?></h3>
									<p><?php echo $T[1]; ?></p>
							   </div>
							   
							   <div class="col-xs-3" id="detail">
								 <br>
								
								 <form action="Service.php">
								   <input class="hidden" name="travelID" value="<?php echo $T[3]; ?>">
								   <button type="submit" name="travelBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br><br>
							
							<?php } ?>
						   
						   </div>
						  
						</div>
					 
			
			    </div>
			<!---->
				<br><br><br>
				
						 <!--Rating and reviews-->
				 <div class="row center-block container">
					
					
					<h3 id="RRhead">Ratings and Reviews</h3>
					
					<ul class="nav nav-tabs tabs" id="nav">
						   <li class="active"><a data-toggle="tab" href="#Hotels">Hotels</a></li>
						   <li><a data-toggle="tab" href="#Restaurants">Restaurants</a></li>
						   <li><a data-toggle="tab" href="#Attaractions">Attaractions</a></li>
						   <li><a data-toggle="tab" href="#Travel">Travel Options</a></li>
					</ul>
					
					    <div class="tab-content">
					
						  <div id="Hotels" class="tab-pane fade in active">
							
							<?php foreach($RR as $rat) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $rat[3]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $rat[0]; ?></h3>
									<p><?php echo $rat[1]; ?></p>
									</div>

							   <div class="col-xs-3" id="detail">
								 <h3 id="rating"><?php echo $rat[2]; ?>/10</h3>
								 <br>
								 <form action="Service.php">
								   <input class="hidden" name="htlID" value="<?php echo $rat[4]; ?>">
								   <button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br>
							<?php } ?>
						  
						  
						   </div>
						   
						   <div id="Restaurants" class="tab-pane fade in ">
								
						    <?php foreach($restRR as $rat1) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $rat1[3]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $rat1[0]; ?></h3>
									<p><?php echo $rat1[1]; ?></p>
									</div>

							   <div class="col-xs-3" id="detail">
								 <h3 id="rating"><?php echo $rat1[2]; ?>/10</h3>
								 <br>
								 <form action="Service.php">
								   <input class="hidden" name="restID" value="<?php echo $rat1[4]; ?>">
								   <button type="submit" name="restBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br>
							<?php } ?>
						   </div>
						   
						   <div id="Attaractions" class="tab-pane fade in ">
						   
							<?php foreach($attRR as $att1) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $att1[3]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $att1[0]; ?></h3>
									<p><?php echo $att1[1]; ?></p>
									</div>

							   <div class="col-xs-3" id="detail">
								 <h3 id="rating"><?php echo $att1[2]; ?>/10</h3>
								 <br>
								 <form action="Service.php">
								   <input class="hidden" name="attID" value="<?php echo $att1[4]; ?>">
								   <button type="submit" name="attBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br>
							<?php } ?>
						   
						   </div>
						   
						   <div id="Travel" class="tab-pane fade in ">
						   
							<?php foreach($travelRR as $travel1) { ?>
							
							<div class="row">
							   <div class="col-xs-3" id="pic">
								 <img class="img-responsive" src="<?php echo $travel1[3]; ?>">
							   </div>
							   
							   <div class="col-xs-6" id="content">
									<h3><?php echo $travel1[0]; ?></h3>
									<p><?php echo $travel1[1]; ?></p>
									</div>

							   <div class="col-xs-3" id="detail">
								 <h3 id="rating"><?php echo $travel1[2]; ?>/10</h3>
								 <br>
								 <form action="Service.php">
								   <input class="hidden" name="travelID" value="<?php echo $travel1[4]; ?>">
								   <button type="submit" name="travelBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br>
							<?php } ?>
								
						   </div>
						  
						</div>
					 
			
			    </div>
			
			<!---->
		  
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