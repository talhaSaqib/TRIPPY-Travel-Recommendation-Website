<?php 
      include("connection.php");
	  include("serviceCTRL.php");
      session_start();
	  
	    //search
		if(isset($_GET["srchhtl"]))
		{
			$input = $_GET["srch"];
			$ser = new serviceCTRL;
			
			$ID = "htlID";
			$btn = "htlBTN";
			
			$result =  $ser->searchS($conn, $input, "htl");
		}
		else if(isset($_GET["srchrest"]))
		{
			$input = $_GET["srch"];
			$ser = new serviceCTRL;
			
			$ID = "restID";
			$btn = "restBTN";
			
			$result = $ser->searchS($conn, $input, "rest");
		}
		else if(isset($_GET["srchatt"]))
		{
			$input = $_GET["srch"];
			$ser = new serviceCTRL;
			
			$ID = "attID";
			$btn = "attBTN";
			
			$result = $ser->searchS($conn, $input, "att");
		}
		else if(isset($_GET["srchtravel"]))
		{
			$input = $_GET["srch"];
			$ser = new serviceCTRL;
			
			$ID = "travelID";
			$btn = "travelBTN";
			
			$result = $ser->searchS($conn, $input, "travel");
		}
	 
	  
	 
	  
?>



<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Search Result</title>
	
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
		  </nav>
   
   
		 <div class= "container" id="claimCont">
		    <div class="row">
		     
		   
		     <div class="col-xs-12" id="Block">
			  
				<h2 id="Cheader">Search Result</h2>
				<hr>
			
			 <div id="result">
				
							<?php foreach($result as $R) { ?>
							
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
								   <input class="hidden" name="<?php echo $ID; ?>" value="<?php echo $R[3]; ?>">
								   <button type="submit" name="<?php echo $btn; ?>" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br><br>
							
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