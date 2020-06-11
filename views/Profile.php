<?php 
      include("connection.php");
	  include("userCTRL.php");
	  include("locCTRL.php");
	  
	  
      session_start();
	  if(!isset($_SESSION['username']))
	  {
		header("Location:LogIn.php");
		die();
      }
	  
      $username = $_SESSION["username"];	  
	  $userCTRL = new userCTRL;
	  $locCTRL = new locCTRL;
	  
	  $locNames = $locCTRL->getLocNames1($conn);
	  
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
				
				 <!--Buttons-->
			   <div class="nav navbar-nav navbar-right" id="join">
				 <button id="delete" class="btn btn-danger" data-toggle="modal" data-target="#del-modal">Delete</button>&nbsp &nbsp
				 <button id="logout" class="btn btn-default" data-toggle="modal" data-target="#log-modal">LogOut</button>
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
						 <br>
						 <form action="upload.php" method="POST" enctype="multipart/form-data" id="btn-form">
							<input type="file" name="fileToUpload" id="choose">
							<button type="button" class="btn btn-default btn-xs" id="upload">Upload</button>
						 </form>
					   </div>
				  </div>
				  
				  <div class="col-md-2 col-xs-4" id="PRdata">				  
					 <h2><?php echo $fullname; ?></h2>
					 <h4><?php echo $username; ?></h4>
					 <h4><?php echo $email; ?></h4>
					 
					<br>
					 <?php if($type == "Business") { ?>
					 <button id="Buss" type="submit" class="btn btn-default">Add Business</button>
					 <?php } ?>
				 </div>
					
				  <div class="col-md-3 col-xs-2"></div>
				</div>

				<br>
				<!--Add options-->				
				<div class="row">
				  <div class="col-xs-3"></div>
				  <div class="col-xs-6">
					
						 <form class="form-horizontal" id="add-modal" action="userCTRL.php" method="post" enctype="multipart/form-data">
						 
								 <div class="form-group">
									  <label for="city"><b>Select cities:</b></label>
									  <select class="form-control" id="city" name="city">
										<?php foreach($locNames as $loc) { ?>
										<option value="<?php echo $loc; ?>"><?php echo $loc; ?></option>
										<?php } ?>
									  </select>
								</div>
								 
								 <div class="form-group" id="chsSer">
									  <label for="service"><b>Select a service:</b></label>
									  <select class="form-control" id="service" name="service">
									   <option value="null">----------</option>
										<option value="htl">Hotel</option>
										<option value="rest">Restaurant</option>
										<option value="att">Attaraction</option>
										<option value="travel">Transport</option>
									  </select>
								</div>
								
								<div class="form-group" id="HTLinputs">
								    <label><b>Details:</b></label>
									<input type="text" class="form-control" name="htlname" placeholder="Hotel Name"><br>
									<input type="number" class="form-control" name="room" placeholder="No. of rooms"><br>
									<input type="number" class="form-control" name="price" placeholder="Price in PKR"><br>
									<input type="number" class="form-control" name="rent" placeholder="Rental"><br>
									<textarea class="form-control" name="htldes" placeholder="Description" id="desc1"></textarea><br>
									
									<input class="hidden" name="BB1" value=0>
									<input type="radio" name="BB1" value=1 > Breakfast &nbsp &nbsp
									
									<input class="hidden" name="WW1" value=0>
									<input type="radio" name="WW1" value=1 > Wifi &nbsp &nbsp
									
									<input class="hidden" name="PP1" value=0>
									<input type="radio" name="PP1" value=1 > Pets Allowed &nbsp &nbsp

									<input class="hidden" name="SS1" value=0>
									<input type="radio" name="SS1" value=1 > Swimming Pool &nbsp &nbsp
									
								</div>
								
								<div class="form-group" id="SERinputs">
								    <label><b>Details:</b></label>
									<input type="text" class="form-control" name="name" placeholder="Name" id="iname"><br>
									<input type="text" class="form-control" name="cat" placeholder="Category" id="category"><br>
									<textarea class="form-control" placeholder="Description" name="des" id="desc1"></textarea>
								</div>					
								
							   <div class="form-group" id="reqinputs">
									<input type="number" step="any" class="form-control" name="lat" placeholder="Latitude"><br>
									<input type="number" step="any" class="form-control" name="lng" placeholder="Longitude"><br>
									
									<label><b>Image:</b></label>
									<input type="file" name="serimage">
									
									<input type="hidden" name="user" value="<?php echo $username; ?>">
									
									<input type="submit" class="btn btn-warning pull-right" name="" value="Add" id="addBTN">
									<button type="button" class="btn btn-warning pull-right" id="cncl">Cancel</button>
							   </div>	
					       </form>
						   
				  </div>
				  <div class="col-xs-3"></div>
				  
				</div>
				
				<!---->
				
				<!--Listing-->
				
				<div class="row center-block container">
					
					<h3 id="RRhead">My Services</h3>
					
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
							   
							   
							   <!--edit modal-->
							   <form class="modal fade" id="edit-modal<?php echo $htls[3]; ?>" method="post" action="serviceCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">Edit <?php echo $htls[0]; ?></h4>
										  </div>
										  <div class="modal-body">
											
											<div class="form-group" id="HTLinputs">
												<input type="text" class="form-control" name="htlname1" placeholder="Hotel Name"><br>
												<input type="number" class="form-control" name="rooms1" placeholder="No. of rooms"><br>
												<input type="number" class="form-control" name="price1" placeholder="Price in PKR"><br>
												<input type="number" class="form-control" name="rental1" placeholder="Rental"><br>
												<textarea class="form-control" name="desc1" placeholder="Description" ></textarea><br>
												
												<input class="hidden" name="B1" value=0>
												<input type="radio" name="B1" value=1 > Breakfast <br>
												
												<input class="hidden" name="W1" value=0>
												<input type="radio" name="W1" value=1 > Wifi <br>
												
												
												<input class="hidden" name="P1" value=0>
												<input type="radio" name="P1" value=1 > Pets Allowed <br>

												<input class="hidden" name="S1" value=0>
												<input type="radio" name="S1" value=1 > Swimming Pool <br>
												<br>
												
												<input class="hidden" name="htlID2" value=<?php echo $htls[3]; ?>>
											</div>
											
										  </div>
										  <div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal">Cancel</button>
											<input name="edithtl" type="submit" class="btn btn-warning" value="Edit">
										  </div>
										</div>
									</div>
								</form>
							   
							   
							   <div class="col-xs-3" id="detail">
								 <br>
								 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-modal<?php echo $htls[3]; ?>">Edit</button>
								 <br><br>
								 
								 <form action="Service.php">
								   <input class="hidden" name="htlID" value="<?php echo $htls[3]; ?>">
								   <button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
							     </form>
					
								
								<form class="modal fade" id="del-modal2<?php echo $htls[3]; ?>" method="post" action="serviceCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title">Delete <?php echo $htls[0]; ?></h4>
										  </div>
										  <div class="modal-body">
											<p>Are you sure you want to delete this hotel?<p>
											<input class="hidden" name="htlID1" value="<?php echo $htls[3]; ?>">
										  </div>
										  <div class="modal-footer">
											<button class="btn" data-dismiss="modal">No</button>
											<input name="htlDel" type="submit" class="btn btn-danger" value="Yes">
										  </div>
										</div>
									</div>
								</form>
					
								 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#del-modal2<?php echo $htls[3]; ?>">Delete</button>
								 
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
									   
									   
									   <!--edit modal-->
									   <form class="modal fade" id="edit-modalR<?php echo $R[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Edit <?php echo $R[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													
													<div class="form-group" id="HTLinputs">
														<input type="text" class="form-control" name="restname1" placeholder="Restaurant Name"><br>
														<input type="text" class="form-control" name="restcat" placeholder="Category"><br>
														<textarea class="form-control" name="descR1" placeholder="Description" ></textarea><br>
														
														<input class="hidden" name="restID2" value=<?php echo $R[3]; ?>>
													</div>
													
												  </div>
												  <div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal">Cancel</button>
													<input name="editrest" type="submit" class="btn btn-warning" value="Edit">
												  </div>
												</div>
											</div>
										</form>
									   
									   
									   <div class="col-xs-3" id="detail">
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-modalR<?php echo $R[3]; ?>">Edit</button>
										 <br><br>
										 
										 <form action="Service.php">
										   <input class="hidden" name="restID" value="<?php echo $R[3]; ?>">
										   <button type="submit" name="restBTN" class="btn btn-warning">Details</button>
										 </form>
							
										<!--del modal-->
										<form class="modal fade" id="del-modalR2<?php echo $R[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Delete <?php echo $R[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													<p>Are you sure you want to delete this restaurant?<p>
													<input class="hidden" name="restID1" value="<?php echo $R[3]; ?>">
												  </div>
												  <div class="modal-footer">
													<button class="btn" data-dismiss="modal">No</button>
													<input name="restDel" type="submit" class="btn btn-danger" value="Yes">
												  </div>
												</div>
											</div>
										</form>
							
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#del-modalR2<?php echo $R[3]; ?>">Delete</button>
										 
									   </div>
									</div>
									<br><br>
									
									<?php } ?>
								   
						   
						   </div>
						   <div id="Attaractions1" class="tab-pane fade in ">
						      
							  <?php foreach($att as $A) { ?>
							
									<div class="row">
									   <div class="col-xs-3" id="pic">
										 <img class="img-responsive" src="<?php echo $A[2]; ?>">
									   </div>
									   
									   <div class="col-xs-6" id="content">
											<h3><?php echo $A[0]; ?></h3>
											<p><?php echo $A[1]; ?></p>
									   </div>
									   
									   
									   <!--edit modal-->
									   <form class="modal fade" id="edit-modalA<?php echo $A[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Edit <?php echo $A[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													
													<div class="form-group" id="HTLinputs">
														<input type="text" class="form-control" name="attname1" placeholder="Name"><br>
														<input type="text" class="form-control" name="attcat" placeholder="Category"><br>
														<textarea class="form-control" name="descatt" placeholder="Description" ></textarea><br>
														
														<input class="hidden" name="attID2" value=<?php echo $A[3]; ?>>
													</div>
													
												  </div>
												  <div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal">Cancel</button>
													<input name="editatt" type="submit" class="btn btn-warning" value="Edit">
												  </div>
												</div>
											</div>
										</form>
									   
									   
									   <div class="col-xs-3" id="detail">
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-modalA<?php echo $A[3]; ?>">Edit</button>
										 <br><br>
										 
										 <form action="Service.php">
										   <input class="hidden" name="attID" value="<?php echo $A[3]; ?>">
										   <button type="submit" name="attBTN" class="btn btn-warning">Details</button>
										 </form>
							
										<!--del modal-->
										<form class="modal fade" id="del-modalA2<?php echo $A[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Delete <?php echo $A[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													<p>Are you sure you want to delete this restaurant?<p>
													<input class="hidden" name="attID1" value="<?php echo $A[3]; ?>">
												  </div>
												  <div class="modal-footer">
													<button class="btn" data-dismiss="modal">No</button>
													<input name="attDel" type="submit" class="btn btn-danger" value="Yes">
												  </div>
												</div>
											</div>
										</form>
							
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#del-modalA2<?php echo $A[3]; ?>">Delete</button>
										 
									   </div>
									</div>
									<br><br>
									
									<?php } ?>
						   
						   
						   </div>
						   <div id="Travel1" class="tab-pane fade in">
							
							<?php foreach($travel as $T) { ?>
							
									<div class="row">
									   <div class="col-xs-3" id="pic">
										 <img class="img-responsive" src="<?php echo $T[2]; ?>">
									   </div>
									   
									   <div class="col-xs-6" id="content">
											<h3><?php echo $T[0]; ?></h3>
											<p><?php echo $T[1]; ?></p>
									   </div>
									   
									   
									   <!--edit modal-->
									   <form class="modal fade" id="edit-modalT<?php echo $T[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Edit <?php echo $T[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													
													<div class="form-group" id="HTLinputs">
														<input type="text" class="form-control" name="travelname1" placeholder="Name"><br>
														<input type="text" class="form-control" name="travelcat" placeholder="Mode"><br>
														<textarea class="form-control" name="travelcatt" placeholder="Description" ></textarea><br>
														
														<input class="hidden" name="travelID2" value=<?php echo $T[3]; ?>>
													</div>
													
												  </div>
												  <div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal">Cancel</button>
													<input name="edittravel" type="submit" class="btn btn-warning" value="Edit">
												  </div>
												</div>
											</div>
										</form>
									   
									   
									   <div class="col-xs-3" id="detail">
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#edit-modalT<?php echo $T[3]; ?>">Edit</button>
										 <br><br>
										 
										 <form action="Service.php">
										   <input class="hidden" name="travelID" value="<?php echo $T[3]; ?>">
										   <button type="submit" name="travelBTN" class="btn btn-warning">Details</button>
										 </form>
							
										<!--del modal-->
										<form class="modal fade" id="del-modalT2<?php echo $T[3]; ?>" method="post" action="serviceCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title">Delete <?php echo $T[0]; ?></h4>
												  </div>
												  <div class="modal-body">
													<p>Are you sure you want to delete this restaurant?<p>
													<input class="hidden" name="travelID1" value="<?php echo $T[3]; ?>">
												  </div>
												  <div class="modal-footer">
													<button class="btn" data-dismiss="modal">No</button>
													<input name="travelDel" type="submit" class="btn btn-danger" value="Yes">
												  </div>
												</div>
											</div>
										</form>
							
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#del-modalT2<?php echo $T[3]; ?>">Delete</button>
										 
									   </div>
									</div>
									<br><br>
									
									<?php } ?>
						   
						   </div>
						  
						</div>
					 
			
			    </div>
			<!---->
				<br><br>
				
						 <!--Rating and reviews-->
				 <div class="row center-block container">
					
					
					<h3 id="RRhead">My Ratings and Reviews</h3>
					
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
							   
			   
							   <form class="modal fade" id="rate<?php echo $rat[4]; ?>" method="post" action="userCTRL.php">
									  <div class="modal-dialog modal-sm">
									   <div class="modal-content">
										  <div class="modal-header">
											<h4 class="modal-title"><?php echo $rat[0]; ?></h4>
										  </div>
										  <div class="modal-body">

										    <label>Rating</label>
											<div class="slidecontainer">
											  <input type="range" min="0" max="10" value="5" name="rating">
											</div>
											 
										    <br>
											<label>Review</label>
											<textarea class="form-control" name="review" placeholder="Description" ></textarea>

											<input class="hidden" name="htlID3" value="<?php echo $rat[4]; ?>">
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
								 <h3 id="rating"><?php echo $rat[2]; ?>/10</h3>
								 <br>
								 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rate<?php echo $rat[4]; ?>" >Rate</button>
								 <br><br>
								 <form action="Service.php">
								   <input class="hidden" name="htlID" value="<?php echo $rat[4]; ?>">
								   <button type="submit" name="htlBTN" class="btn btn-warning">Details</button>
							     </form>
							   </div>
					        </div>
							<br>
							<?php } ?>
						  
						   </div>
						   
						   
						   <div id="Restaurants" class="tab-pane fade in">
								
								<?php foreach($restRR as $rat1) { ?>
									
									<div class="row">
									   <div class="col-xs-3" id="pic">
										 <img class="img-responsive" src="<?php echo $rat1[3]; ?>">
									   </div>
									   
									   <div class="col-xs-6" id="content">
											<h3><?php echo $rat1[0]; ?></h3>
											<p><?php echo $rat1[1]; ?></p>
											</div>
									   
					   
									   <form class="modal fade" id="rateR<?php echo $rat1[4]; ?>" method="post" action="userCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title"><?php echo $rat1[0]; ?></h4>
												  </div>
												  <div class="modal-body">

													<label>Rating</label>
													<div class="slidecontainer">
													  <input type="range" min="0" max="10" value="5" name="rating">
													</div>
													 
													<br>
													<label>Review</label>
													<textarea class="form-control" name="review" placeholder="Description" ></textarea>

													<input class="hidden" name="restID3" value="<?php echo $rat1[4]; ?>">
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
										 <h3 id="rating"><?php echo $rat1[2]; ?>/10</h3>
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateR<?php echo $rat1[4]; ?>" >Rate</button>
										 <br><br>
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
									   
					   
									   <form class="modal fade" id="rateA<?php echo $att1[4]; ?>" method="post" action="userCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title"><?php echo $att1[0]; ?></h4>
												  </div>
												  <div class="modal-body">

													<label>Rating</label>
													<div class="slidecontainer">
													  <input type="range" min="0" max="10" value="5" name="rating">
													</div>
													 
													<br>
													<label>Review</label>
													<textarea class="form-control" name="review" placeholder="Description" ></textarea>

													<input class="hidden" name="attID3" value="<?php echo $att1[4]; ?>">
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
										 <h3 id="rating"><?php echo $att1[2]; ?>/10</h3>
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateA<?php echo $att1[4]; ?>" >Rate</button>
										 <br><br>
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
									   
					   
									   <form class="modal fade" id="rateT<?php echo $travel1[4]; ?>" method="post" action="userCTRL.php">
											  <div class="modal-dialog modal-sm">
											   <div class="modal-content">
												  <div class="modal-header">
													<h4 class="modal-title"><?php echo $travel1[0]; ?></h4>
												  </div>
												  <div class="modal-body">

													<label>Rating</label>
													<div class="slidecontainer">
													  <input type="range" min="0" max="10" value="5" name="rating">
													</div>
													 
													<br>
													<label>Review</label>
													<textarea class="form-control" name="review" placeholder="Description" ></textarea>

													<input class="hidden" name="travelID3" value="<?php echo $travel1[4]; ?>">
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
										 <h3 id="rating"><?php echo $travel1[2]; ?>/10</h3>
										 <br>
										 <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#rateT<?php echo $travel1[4]; ?>" >Rate</button>
										 <br><br>
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