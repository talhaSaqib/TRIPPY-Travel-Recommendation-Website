<!DOCTYPE html>

<html>

   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          
          <title>Log In</title>
	
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
		   
		     <div class="col-md-4 col-xs-6 login" id="Block">
			  
					<h1>Welcome</h1>
					<hr>
			   
			   <form id="logForm" action="loginCTRL.php" method="post">
			   <span id="uerror"></span>
					<div class="form-group">
					<input id="username" type="text" class="form-control" name="username" placeholder="Username" maxlength=20>
					</div>
					
					<span id="perror"></span>
					<div class="form-group">
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
					</div>
					
					<button id="log" type="submit" name="log" class="btn btn-default btn-lg center-block">Log in</button>
			   
			   </form>
			  
			   <br>
			   <a href="SignUp.php">Don't have an account? Sign up</a>
			   
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