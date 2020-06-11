		
$(document).ready(function()
{
	//default autocomplete off
	$("#srch").attr("autocomplete", "off");
	
	function clearDialog()
		{
			$("#autocomplete").empty();
			$("#autocomplete").css("display", "none");
		};
		
		function initDialog()
		{
			
			clearDialog();
			$("#autocomplete").css("display", "block");
			for(var i=0; i<locations.length; i++)
			{
				$("#autocomplete").append("<div>"+locations[i]+"</div>");
			}
			
		};
				//on/off
		$("#srch").focus(function()
		{
			if(!$(this).val())
			{
			  initDialog();
			}
			else
			{
				clearDialog();
			}
		});
		
		$("#srch").blur(function()
		{
			clearDialog();
		});
		
		$("#srch").on("input", function()      //just working for first value (backspaced)
		{
			if(!$(this).val())
			{
			  initDialog();
			}
			else
			{
				clearDialog();
			}
		});
		
				//string match
		$("#srch").on("keyup change paste", function()
		{
			  match($(this).val());
		});
		
				//select
		$("body").on("mousedown", "#autocomplete div", function()
		{
			$("#srch").val($(this).text()).focus();
			clearDialog();
		});
		
		function match(str)
		{
			str = str.toLowerCase();
			clearDialog();
			for(var i=0; i<locations.length; i++)
			{
				if(locations[i].toLowerCase().startsWith(str))
				{
					$("#autocomplete").append("<div>"+locations[i]+"</div>");
				} 
			}
			$("#autocomplete").css("display", "block");
		}
		function clearDialog()
		{
			$("#autocomplete").empty();
			$("#autocomplete").css("display", "none");
		};
		
		function initDialog()
		{
			
			clearDialog();
			$("#autocomplete").css("display", "block");
			for(var i=0; i<locations.length; i++)
			{
				$("#autocomplete").append("<div>"+locations[i]+"</div>");
			}
			
		};
				//on/off
		$("#srch").focus(function()
		{
			if(!$(this).val())
			{
			  initDialog();
			}
			else
			{
				clearDialog();
			}
		});
		
		$("#srch").blur(function()
		{
			clearDialog();
		});
		
		$("#srch").on("input", function()      //just working for first value (backspaced)
		{
			if(!$(this).val())
			{
			  initDialog();
			}
			else
			{
				clearDialog();
			}
		});
		
				//string match
		$("#srch").on("keyup change paste", function()
		{
			  match($(this).val());
		});
		
				//select
		$("body").on("mousedown", "#autocomplete div", function()
		{
			$("#srch").val($(this).text()).focus();
			clearDialog();
		});
		
		function match(str)
		{
			str = str.toLowerCase();
			clearDialog();
			for(var i=0; i<locations.length; i++)
			{
				if(locations[i].toLowerCase().startsWith(str))
				{
					$("#autocomplete").append("<div>"+locations[i]+"</div>");
				} 
			}
			$("#autocomplete").css("display", "block");
		}

	
	
	//scrollTop
	 $(window).scroll(function()
	 {
		 if($(this).scrollTop() > 100)
		 {
			 $(".scrollTop").fadeIn();
		 }
		 else
		 {
			 $(".scrollTop").fadeOut();
		 }
	 });
	 
	 $(".scrollTop").click(function()
	 {
		$("html,body").animate(
		{
			scrollTop: 0
		},800);

        return false;		
	 });
	 
    //Map
	
	$(function myMap()
	{
		var lat = document.getElementById("lat").value;
	    var lng = document.getElementById("lng").value;
		
		if(lat=="")
		{
			lat=38.685516;
		}
		
		if(lng=="")
		{
			lng=40.073324;
		}
		
		myCenter = new google.maps.LatLng(lat, lng);
		var mapProp = 
		{
		  center: myCenter,
		  zoom: 8,
		};
		var map = new google.maps.Map(document.getElementById("map"),mapProp);
		var marker = new google.maps.Marker({position: myCenter});
		marker.setMap(map);
		
	});
	
	//hidden
	$("#choose").hide();
	$("#btn-form").hide();
	
	//upload
	$("#image-div").hover(
	function()
	{
		$("#btn-form").show();
	},
	function()
	{
		$("#btn-form").hide();
	});
	
	$("#upload").click(function()
	{
		$("#choose").click();
	});
	
	$("#choose").change(function()
	{
      $("#btn-form").submit();
    });
	
	//username exist check
	$("#signForm #username").blur(function()
	{
		var username = document.getElementById("username").value;
		if (username != "")
		{
			$("#uerror").html("Checking...");
			var hr = new XMLHttpRequest();
			hr.open("POST", "check-nameCTRL.php", true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					$("#uerror").html(hr.responseText);
				}
			}
			var u = "nameToCheck="+username;
			hr.send(u);
		}
	});
	
	
	//signup
    $("#sign").click(function()
	{
		//getting values
		var fullname = document.getElementById("fullname").value;
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var email = document.getElementById("email").value;
		if(document.getElementById("N").checked)
		{
		   var normal = document.getElementById("N").value;
		}
		else
		{
			var normal = "";
		}
		if(document.getElementById("B").checked)
		{
		   var buss = document.getElementById("B").value;
		}
		else
		{
			var buss = "";
		}
		
		var flag = 0;
		
		//checking values
		if(fullname === "")
		{
		  $("#nerror").html("*Full name must not be empty");
		  flag = 1;
		}
		else
		{
			$("#nerror").html("");
		}
		
		if(username === "")
		{
		  $("#uerror").html("*User name must not be empty");
		  flag = 1;
		}
		else
		{   
			//from ajax
			var error = document.getElementById("uerror").innerHTML;
			if( error.match(/[a-z]/i) || error.includes("*")) 
		    {
			  flag = 1;
		    }
		}
		
		if(password === "")
		{
		  $("#perror").html("*Kindly enter a password");
		  flag = 1;
		}
		else if(password.length < 7)
		{
		  $("#perror").html("*Password should be greater than 6 digits");
		  flag = 1;
		}
		else
		{
			$("#perror").html("");
		}
		
		if(email === "")
		{
		  $("#merror").html("*Email must not be empty");
		  flag = 1;
		}
		else if(email.indexOf("@") === -1)
		{
		  $("#merror").html("*Email must contain '@' and part following it");
		  flag = 1;
		}
		else
		{
			$("#merror").html("");
		}
		
		
		//return
		if(flag === 1)
		{
		    return false;
		}
		else
		{
			return true;
		}
	});
	
	//login
    $("#log").click(function()
	{
		//getting values
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var flag = 0;
		
		//checking values
		if(username === "")
		{
		  $("#uerror").html("*Please enter a valid user name");
		  flag = 1;
		}
		else
		{
			$("#uerror").html("");
		}
		
		if(password === "")
		{
		  $("#perror").html("*Please enter a valid password");
		  flag = 1;
		}
		else
		{
			$("#perror").html("");
		}
		
		//return
		if(flag === 1)
		{
		    return false;
		}
		else
		{
			return true;
		}
	});
	
	   //add business show/hide
		$("#add-modal").hide();
		$("#HTLinputs").hide();
		$("#SERinputs").hide();
		$("#reqinputs").hide();
		
		$("#Buss").click(function()
		{
			$("#add-modal").show();
		});
		
		$("#cncl").click(function()
		{
			$("#add-modal").hide();
		});
		
        $("#service").change(function()
		{
			if($("#service").val() == "htl") 
			{
				$("#HTLinputs").show();
				$("#SERinputs").hide();
				
				$("#reqinputs").show();
				
				$("#iname").attr("placeholder", "Hotel Name");
				$("#addBTN").attr("name", "addhtl");
			} 
			else if($("#service").val() == "rest") 
			{
				$("#HTLinputs").hide();
				$("#SERinputs").show();
				
				$("#reqinputs").show();
				
				$("#iname").attr("placeholder", "Restaurant Name");
				$("#category").attr("placeholder", "Category (Fast-Food/Desi/Chinese/etc)");
				$("#addBTN").attr("name", "addrest");
			}
			else if($("#service").val() == "att") 
			{
				$("#HTLinputs").hide();
				$("#SERinputs").show();
				
				$("#reqinputs").show();
				
				$("#iname").attr("placeholder", "Name");
				$("#category").attr("placeholder", "Category (Park/Monument/Club/etc)");
				$("#addBTN").attr("name", "addatt");
				
			}
		    else if($("#service").val() == "travel") 
			{
				$("#HTLinputs").hide();
				$("#SERinputs").show();
				
				$("#reqinputs").show();
				
				$("#iname").attr("placeholder", "Name");
				$("#category").attr("placeholder", "Mode");
				$("#addBTN").attr("name", "addtravel");
			} 
			else if($("#service").val() == "null") 
			{
				$("#HTLinputs").hide();
				$("#SERinputs").hide();
				
				$("#reqinputs").hide();
			}
       });
	
		//search filters
		$("#range, #range1").click(function()
		{
			var pmin = document.getElementById("minv").value;
			var pmax = document.getElementById("maxv").value;
			var rmin = document.getElementById("mins").value;
			var rmax = document.getElementById("maxs").value;
			var city = document.getElementById("cityname").innerHTML;
			
			
			var data = { "htlfil":1, "pmin":pmin, "pmax":pmax, "rmin":rmin, "rmax":rmax, "city":city };
			var x = JSON.stringify(data);
			
			var hr = new XMLHttpRequest();
			hr.open("GET", "locCTRL.php?x="+x, true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					//alert(hr.responseText);	
					$("#replace").html(hr.responseText);
				}
			}
			hr.send();
			
		});
		
		$("#rangerest").click(function()
		{
			var rmin = document.getElementById("minsrest").value;
			var rmax = document.getElementById("maxsrest").value;
			var city = document.getElementById("cityname").innerHTML;
			var type = "rest";
			
			var data = { "restfil":1, "rmin":rmin, "rmax":rmax, "city":city, "type":type };
			var y = JSON.stringify(data);
			
			var hr = new XMLHttpRequest();
			hr.open("GET", "locCTRL.php?y="+y, true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					//alert(hr.responseText);	
					$("#replacerest").html(hr.responseText);
				}
			}
			hr.send();
			
		});
		
		$("#rangeatt").click(function()
		{
			
			var rmin = document.getElementById("minsatt").value;
			var rmax = document.getElementById("maxsatt").value;
			var city = document.getElementById("cityname").innerHTML;
			var type = "att";
			
			var data = { "attfil":1, "rmin":rmin, "rmax":rmax, "city":city, "type":type };
			var z = JSON.stringify(data);
			
			var hr = new XMLHttpRequest();
			hr.open("GET", "locCTRL.php?z="+z, true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					//alert(hr.responseText);	
					$("#replaceatt").html(hr.responseText);
				}
			}
			hr.send();
			
		});
		
		$("#rangetravel").click(function()
		{
			var rmin = document.getElementById("minstravel").value;
			var rmax = document.getElementById("maxstravel").value;
			var city = document.getElementById("cityname").innerHTML;
			var type = "travel";
			
			var data = { "travelfil":1, "rmin":rmin, "rmax":rmax, "city":city, "type":type };
			var a = JSON.stringify(data);
			
			var hr = new XMLHttpRequest();
			hr.open("GET", "locCTRL.php?a="+a, true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					//alert(hr.responseText);	
					$("#replacetravel").html(hr.responseText);
				}
			}
			hr.send();
			
		});
		
	
		//Sliders in Location
		$("#range").slider(
			{
				range: true,
				min: 0,
				max: 7000,
				values: [ 0, 7000 ],
				slide: function( event, ui ) 
				{
					$("#amount").html( "Rs." + ui.values[0] + " - Rs." + ui.values[1] );
					$("#minv").val(ui.values[0]);
					$("#maxv").val(ui.values[1]);
				}
			});
			
		$("#range1").slider(
			{
				range: true,
				min: 0,
				max: 10,
				values: [ 0, 10 ],
				slide: function( event, ui ) 
				{
					$("#amount1").html( "Rs." + ui.values[0] + " - Rs." + ui.values[1] );
					$("#mins").val(ui.values[0]);
					$("#maxs").val(ui.values[1]);
				}
			});
			
			$("#rangerest").slider(
			{
				range: true,
				min: 0,
				max: 10,
				values: [ 0, 10 ],
				slide: function( event, ui ) 
				{
					$("#amountrest").html( "Rs." + ui.values[0] + " - Rs." + ui.values[1] );
					$("#minsrest").val(ui.values[0]);
					$("#maxsrest").val(ui.values[1]);
				}
			});
			
			$("#rangeatt").slider(
			{
				range: true,
				min: 0,
				max: 10,
				values: [ 0, 10 ],
				slide: function( event, ui ) 
				{
					$("#amountatt").html( "Rs." + ui.values[0] + " - Rs." + ui.values[1] );
					$("#minsatt").val(ui.values[0]);
					$("#maxsatt").val(ui.values[1]);
				}
			});
			$("#rangetravel").slider(
			{
				range: true,
				min: 0,
				max: 10,
				values: [ 0, 10 ],
				slide: function( event, ui ) 
				{
					$("#amounttravel").html( "Rs." + ui.values[0] + " - Rs." + ui.values[1] );
					$("#minstravel").val(ui.values[0]);
					$("#maxstravel").val(ui.values[1]);
				}
			});
		
	    
	
});

   
   
   
   
   
   