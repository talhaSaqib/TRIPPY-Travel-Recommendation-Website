<!DOCTYPE html>

<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Sign Up</title>
	
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
		 <div class= "container">
		    <div class="row">
		     
			 <div class="col-md-4 col-xs-3">
				<a href="Trippy.php"><h2 id="logo">Trippy</h2></a>
			 </div>
		   
		     <div class="col-md-4 col-xs-6" id="Block">
			  
					<h1>Join Today</h1>
					<hr>
			   
			   <form id="signForm" action="signupCTRL.php" method="post">
			   
			        <span id="nerror"></span>
					<div class="form-group">
					<input id="fullname" type="text" class="form-control" name="fullname" placeholder="Full Name" maxlength=30>
					</div>
					
					<span id="uerror"></span>
					<div class="form-group">
					<input id="username" type="text" class="form-control" name="username" placeholder="Username" maxlength=30>
					</div>
					
					<span id="perror"></span>
					<div class="form-group">
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
					</div>
					
					<span id="merror"></span>
					<div class="form-group">
					<input id="email" type="email" class="form-control" name="email" placeholder="Email">
					</div>
					
					
					<div id="usr">User Type</div>
					<div class="radio">
				      <label>
					     <input id="N" type="radio" name="formRadio" value="Normal" checked="checked"> Normal &nbsp &nbsp
				      </label>
					  <label>
					     <input id="B" type="radio" name="formRadio" value="Business"> Business
				      </label>
					</div>
					
					<br>
					<button id="sign" type="submit" name="sign" class="btn btn-default btn-lg center-block">Sign up</button>
			   
			   </form>
			  
			   <br>
			   <a href="LogIn.php">Already have an account? Login</a>
			   
			 </div>
			   
			 <div class="col-md-4 col-xs-3">
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