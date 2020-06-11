<?php

      include("connection.php");
	  include("claimCTRL.php");
	  
      session_start();
	  
	  $claim = new claimCTRL;

      $hotels = $claim->getClaim($conn, "htl");
	  $rest = $claim->getClaim($conn, "rest");
	  $att = $claim->getClaim($conn, "att");
	  $travel = $claim->getClaim($conn, "travel");
	  
		
	  
?>



<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Admin</title>
	
          <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">		  
		  <link rel="stylesheet" type="text/css" href="css/join.css">
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
				
			   </div>
			   
			</div>
		  </nav>
   
   
		 <div class= "container" id="claimCont">
		    <div class="row">
		     
		   
		     <div class="col-xs-12" id="Block">
			  
				<h2 id="Cheader">Claim Requests</h2>
				
			<ul class="nav nav-tabs tabs" id="nav">
				   <li class="active"><a data-toggle="tab" href="#Hotels1">Hotels</a></li>
				   <li><a data-toggle="tab" href="#Restaurants1">Restaurants</a></li>
				   <li><a data-toggle="tab" href="#Attaractions1">Attaractions</a></li>
				   <li><a data-toggle="tab" href="#Travel1">Travel Options</a></li>
			</ul>
			
		   <div class="tab-content">
			
			 <div id="Hotels1" class="tab-pane fade in active">
					
				<?php foreach($hotels as $htls) 
				
				{
				   if($htls[3] == NULL)
				   {
					   $htls[3] = "images/12.png";
				   }
				   if($htls[5] == NULL)
				   {
					   $htls[5] = "images/12.png";
				   }
				   
				
				?>
			
				<div class="row">
				   <div class="col-xs-3" >
					 <img class="img-responsive" src="<?php echo $htls[4]; ?>">
				   </div>
				   
				   <div class="col-xs-6" id="content">
						<a href="Service.php?htlBTN=1&htlID=<?php echo $htls[0]; ?>"><h2 id="heading"><b><?php echo $htls[6]; ?></b></h2></a>

						<p class="ptext">Owned By: <?php echo $htls[1]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $htls[1]; ?>"><img class="img-circle" src="<?php echo $htls[3]; ?>" width="30px" height="30px"></a>
						 <br>
						<p  class="ptext">Claimed By: <?php echo $htls[2]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $htls[2]; ?>"><img class="img-circle" src="<?php echo $htls[5]; ?>" width="30px" height="30px"></a>
				   </div>
				   
				   <div class="col-xs-3">
					 <form action="claimCTRL.php">
					   <input class="hidden" name="id" value="<?php echo $htls[0]; ?>">
					   <input class="hidden" name="owner" value="<?php echo $htls[1]; ?>">
					   <input class="hidden" name="claimer" value="<?php echo $htls[2]; ?>">
					   
					   <button type="submit" name="approveHtl" class="btn btn-warning" id="claimbtn">Approve</button>
						<br><br>
						<button type="submit" name="declineHtl" class="btn btn-danger" id="claimbtn1">Decline</button>
					 </form>
				   </div>
				   
				</div>
			    <br>
			    <?php } ?>
				
			   </div>
			   
			   
			    <div id="Restaurants1" class="tab-pane fade in">
				<?php foreach($rest as $R) 
				
				{
				   if($R[3] == NULL)
				   {
					   $R[3] = "images/12.png";
				   }
				   if($R[5] == NULL)
				   {
					   $R[5] = "images/12.png";
				   }
				   
				
				?>
			
				<div class="row">
				   <div class="col-xs-3" >
					 <img class="img-responsive" src="<?php echo $R[4]; ?>">
				   </div>
				   
				   <div class="col-xs-6" id="content">
						<a href="Service.php?restBTN=1&restID=<?php echo $R[0]; ?>"><h2 id="heading"><b><?php echo $R[6]; ?></b></h2></a>

						<p class="ptext">Owned By: <?php echo $R[1]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $R[1]; ?>"><img class="img-circle" src="<?php echo $R[3]; ?>" width="30px" height="30px"></a>
						 <br>
						<p  class="ptext">Claimed By: <?php echo $R[2]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $R[2]; ?>"><img class="img-circle" src="<?php echo $R[5]; ?>" width="30px" height="30px"></a>
				   </div>
				   
				   <div class="col-xs-3">
					 <form action="claimCTRL.php">
					   <input class="hidden" name="id" value="<?php echo $R[0]; ?>">
					   <input class="hidden" name="owner" value="<?php echo $R[1]; ?>">
					   <input class="hidden" name="claimer" value="<?php echo $R[2]; ?>">
					   
					   <button type="submit" name="approveRest" class="btn btn-warning" id="claimbtn">Approve</button>
						<br><br>
						<button type="submit" name="declineRest" class="btn btn-danger" id="claimbtn1">Decline</button>
					 </form>
				   </div>
				   
				</div>
			    <br>
			    <?php } ?>
					
					
				</div>

			    <div id="Attaractions1" class="tab-pane fade in ">
				
				<?php foreach($att as $A) 
				
				{
				   if($A[3] == NULL)
				   {
					   $A[3] = "images/12.png";
				   }
				   if($A[5] == NULL)
				   {
					   $A[5] = "images/12.png";
				   }
				   
				
				?>
			
				<div class="row">
				   <div class="col-xs-3" >
					 <img class="img-responsive" src="<?php echo $A[4]; ?>">
				   </div>
				   
				   <div class="col-xs-6" id="content">
						<a href="Service.php?attBTN=1&attID=<?php echo $A[0]; ?>"><h2 id="heading"><b><?php echo $A[6]; ?></b></h2></a>

						<p class="ptext">Owned By: <?php echo $A[1]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $A[1]; ?>"><img class="img-circle" src="<?php echo $A[3]; ?>" width="30px" height="30px"></a>
						 <br>
						<p  class="ptext">Claimed By: <?php echo $A[2]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $A[2]; ?>"><img class="img-circle" src="<?php echo $A[5]; ?>" width="30px" height="30px"></a>
				   </div>
				   
				   <div class="col-xs-3">
					 <form action="claimCTRL.php">
					   <input class="hidden" name="id" value="<?php echo $A[0]; ?>">
					   <input class="hidden" name="owner" value="<?php echo $A[1]; ?>">
					   <input class="hidden" name="claimer" value="<?php echo $A[2]; ?>">
					   
					   <button type="submit" name="approveatt" class="btn btn-warning" id="claimbtn">Approve</button>
						<br><br>
						<button type="submit" name="declineatt" class="btn btn-danger" id="claimbtn1">Decline</button>
					 </form>
				   </div>
				   
				</div>
			    <br>
			    <?php } ?>
					
				
				</div>

				<div id="Travel1" class="tab-pane fade in ">
				
				<?php foreach($travel as $T) 
				
				{
				   if($T[3] == NULL)
				   {
					   $T[3] = "images/12.png";
				   }
				   if($T[5] == NULL)
				   {
					   $T[5] = "images/12.png";
				   }
				   
				
				?>
			
				<div class="row">
				   <div class="col-xs-3" >
					 <img class="img-responsive" src="<?php echo $T[4]; ?>">
				   </div>
				   
				   <div class="col-xs-6" id="content">
						<a href="Service.php?travelBTN=1&travelID=<?php echo $T[0]; ?>"><h2 id="heading"><b><?php echo $T[6]; ?></b></h2></a>

						<p class="ptext">Owned By: <?php echo $T[1]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $T[1]; ?>"><img class="img-circle" src="<?php echo $T[3]; ?>" width="30px" height="30px"></a>
						 <br>
						<p  class="ptext">Claimed By: <?php echo $T[2]; ?></p><br class="hidden-lg">
						<a href="UserProfile.php?uname=<?php echo $T[2]; ?>"><img class="img-circle" src="<?php echo $T[5]; ?>" width="30px" height="30px"></a>
				   </div>
				   
				   <div class="col-xs-3">
					 <form action="claimCTRL.php">
					   <input class="hidden" name="id" value="<?php echo $T[0]; ?>">
					   <input class="hidden" name="owner" value="<?php echo $T[1]; ?>">
					   <input class="hidden" name="claimer" value="<?php echo $T[2]; ?>">
					   
					   <button type="submit" name="approvetravel" class="btn btn-warning" id="claimbtn">Approve</button>
						<br><br>
						<button type="submit" name="declinetravel" class="btn btn-danger" id="claimbtn1">Decline</button>
					 </form>
				   </div>
				   
				</div>
			    <br>
			    <?php } ?>
				
				</div>
				
			   </div>
			   
			 </div>
			
			</div>
		   </div>
	      
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