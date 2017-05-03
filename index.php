<?php
require 'auth/dbcon.php';
session_start();
if(isset($_SESSION['user'])){
//	do nothing
}
else{
//	header("Location:auth/auth.php");

	echo '<script>window.stop();alert("Login First");window.location.href="auth/auth.php";</script>';
}
?>

<html>
<head>
	<title>Ajax Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<script src="js/bootstrap.js"></script>
	<script src="js/jQuery-v3.1.1.js"></script>
	<style type="text/css">
		#msg{
			font-size: 14px;
			font-family: Garamond;
		}
	</style>
</head>
<body>
<nav class="container-fluid navbar navbar-default navbar-fixed-top" style="position: relative;">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="font-size: 22px;">Home</a>
    </div> 
      
      <ul class="nav navbar-nav navbar-right" style="font-size: 14px;"><?php
      if(isset($_SESSION['user'])=="")
      {

      }
      else{?>
            
            <li class="active"><a ><?php echo $_SESSION['user'];?></a></li>
            <li role="separator" class="divider"></li>
            <li><button style="height: 50px;" class="btn btn-danger" id="logout" title="Logout"><span class="glyphicon glyphicon-off"></span> Logout &nbsp;&nbsp;</button></li> 
  <?php  }
    ?>
      </ul> 
</nav>
<div class="col-md-3">

<input type="text" name="to" id="to" class="form-control" disabled />
<textarea rows="4" autofocus="autofocus" id="myname" type="text" class="form-control" placeholder="enter a text to send
press SHIFT+ENTER to enter new line
press Enter to send" required></textarea>
<button type="submit" class="btn btn-primary" onclick="add_data()">Send</button>

<!-- <input type='submit' value='Delete' id='delete' class="btn btn-danger"/> -->
<!-- <input type='reset' value='Clear' class="btn btn-warning" id="clear"/> -->
<div >members<br/>
<?php
// $conn = mysqli_connect("localhost","root","","chat");
if(isset($_SESSION['user']))
{
	$me = $_SESSION['user'];
}
$get = "select username from person where username!='$me'";
$run = $conn->query($get);
echo "<table><tr>";
while($row = mysqli_fetch_array($run)){
	echo "<td><a id='sendTo' class='btn btn-default'>".$row[0]."</a></td>";

}
echo "</tr></table>";
?>
</div>
<div id="msg" class="alert"></div>
</div><hr>
<div id="demo" class="col-md-6"></div>

<script language="javascript" type="text/javascript">
//clear the textbox
$("#clear").click(function(){ 
		document.getElementById("myname").value = "";
	});

$("#logout").click(function(){
    window.location.href="auth/logout.php";
   // window.load_data.href = "auth/auth.php";
});


var To; 
$(".btn-default,#sendTo").click(function(){
	To= this.innerHTML;
	document.getElementById("to").value = To;

	document.getElementById("myname").focus();
});


$(function(){
	$('#ld').show().html("Loading. .. ...");
	window.setTimeout(function(){$('#ld').fadeOut(1000);},2000);
	$("#msg").hide();

$("#myname").keypress(function(event){ 
        // if(event.which==13){
        // 	
        // }
        if(event.keyCode==13 && !event.shiftKey){

	//document.getElementById("myname").value += "\r\n";
        	add_data();
        }
    });

	$('#delete').click(function(){
	var info = document.getElementById("myname").value;
		$.ajax({
		   type: "POST",
		   url: "delete.php",
		   data: {info:info},
		   dataType: 'json',
		   success: function(data){$("#msg").fadeIn();
				if(data.status=='success')
			  	{
			  		$("#msg").removeClass("alert-danger").addClass("alert-success");
			  		
			  		document.getElementById("msg").innerHTML =  data.status+" Deleted";
			  	}
			  	else if(data.status=='Error'){
			  		$("#msg").fadeIn();
			  		$("#msg").removeClass("alert-success").addClass("alert-danger");
			  		if(info=="")
			  		{
			  			document.getElementById("msg").innerHTML = data.status+" Name empty";
			  		}
			  		else
			  		{	
			  			document.getElementById("msg").innerHTML = data.status+" Name not found";
			  		}
			  	}
			  	$("#msg").delay(700).fadeOut("slow");
			  	load_data();
			  },
			error: function(data){
				$("#msg").addClass("alert-danger").slideDown();
			  	document.getElementById("msg").innerHTML = data.status+" Failed to delete";
			  	$("#msg").delay(1000).fadeOut();
			  }
		 
		});
	});
	//load_data();
setInterval(load_data,2500);
});



function load_data(){
	if(To==undefined){
		var data = null;
	}else{
		var data = To;
	}
	$.ajax({
		   type: "GET",
		   url: "data.php?to="+data,
		  success:function(data) 
		   {
		    	$('#demo').html(data); 
		   },
		   error:function(data) 
		   {
		    $('#demo').html(data);    
		   }
		}); 
	
}

function add_data(){
	var data = document.getElementById("to").value;
	var data2= document.getElementById("myname").value;
//	 alert(data);
	$("#msg").hide();
	$.ajax({
		type: "POST",
		url: "add.php?to="+data,
		data: {name:data2},
		success: function(data){
			if(data!=="Success")
			{
				$("#msg").fadeIn();
				$("#msg").removeClass("alert-success").addClass("alert-danger");
				document.getElementById("msg").innerHTML =  data;
				$("#msg").fadeOut(3000);
			}
			else if(data=="Success"){
				document.getElementById("myname").value = "";
				$("#msg").fadeIn();
				$("#msg").removeClass("alert-danger");
				document.getElementById("msg").innerHTML =  "<span class='glyphicon glyphicon-ok'><span>";
				$("#msg").fadeOut(1500);
			}
		}

	});
	//load_data();
};

</script>
<div id="ld" class="alert alert-info" style="margin:20% 40%;"></div>
</body>
</html>