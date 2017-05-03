<?php
include 'dbcon.php';
include 'country.php';
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Authentification</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jQuery-v3.1.1.js"></script>
	<script type="text/javascript" src="../js/jquery.validate.js"></script>
	<script src="../js/regValidation.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/style.css"/>
	<script src="../js/sweetalert.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="../css/sweetalert.css"/>

</head>
<body class=""> 
<nav class="container-fluid navbar navbar-default navbar-fixed-top" style="position: relative;">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" style="font-size: 22px;">Home</a>
    </div> 
      
      <ul class="nav navbar-nav navbar-right" style="font-size: 14px;"><?php
      if(isset($_SESSION['user'])=="")
      {

      }
      else{?>
            
            <li class="active"><a href="profile.php"><?php echo $_SESSION['user'];?></a></li>
            <li role="separator" class="divider"></li>
            <li><a data-toggle="modal" id="logout" href="#signout" title="Logout"><span class="glyphicon glyphicon-off"></span> Logout &nbsp;&nbsp;</a></li> 
  <?php  }
    ?>
      </ul> 
</nav>
<div class="col-md-6" id="register">
	<form id="reg-form" method="POST" class="form-horizontal login">
<div id="err"></div><table>
<tr>
  <td><label>Username: </label></td>
  <td><input id="uname" class="input" type="text" name="uname" placeholder="username must be within 20 characters" /></td>
  <td> &nbsp;*</td>
</tr>
<tr>
  <td><label>Password: </label></td>
  <td><input id="pwd" class="input" type="password" name="pwd" placeholder="Enter password min. 6 characters" /></td>
  <td> &nbsp;*</td>
</tr>
<tr>
  <td><label>Confirm password:</label></td>
  <td><input id="confpwd" class="input" type="password" name="confpwd" placeholder="Must be matched with password"/></td>
  <td> &nbsp;*</td>
</tr>
<tr>
  <td><label>Full name: </label></td>
  <td><input id="fullname" class="input" type="text" name="fullname" placeholder="a-z A-Z . are allowed"/></td>
</tr>
<tr>
  <td><label>Email:</label></td>
  <td><input type="email" id="email" class="input"  name="email" placeholder="Enter a valid email" /></td>
  <td> &nbsp;*</td>
</tr>
<tr>
  <td><label>Date of Birth: </label></td>
  <td><input id="dob" class="input" type="date" name="dob" placeholder="YYYY-MM-DD" /></td>
</tr>
<tr>
  <td><label>Gender: </label></td>
  <td>
    <label id="gndr" class="radio-inline"><input type="radio" name="gender" value="Male" placeholder="Male">Male</input></label> &nbsp;&nbsp; 
    <label id="gndr" class="radio-inline"><input type="radio" name="gender" value="Female" placeholder="Female">Female</input></label>
  </td>
</tr>
<tr>
  <td><label>Country: </label></td>
  <td><select name="country" class="input" ><option selected hidden></option><?php foreach ($countries as $value) { echo '<option  id="country">'.$value.'</option>'; }?></select></td>
</tr>
<tr>
<td align="right"><label><input type="checkbox" name="iagree" value="I Agree">&nbsp;I Agree</input></label> &nbsp;&nbsp;&nbsp;</td>
  <td><center><button type="submit" class="btn btn-primary" id="btn"> Signup</button>
  <input id="reset" class="btn btn-default" type="reset" value="Reset" /></center></td>
  <td></td>
</tr>
  </table>* means required
</form>
</div>
<!-- Login Form -->
<div class="col-md-3">
  <form autocomplete="off" id="log-form" class="login" method="POST">
  <div id="logerr"></div>
    <div class="form-group">
      <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
      <input type="text" class="input" name="usrname" placeholder="Enter username" required/>
    </div>

    <div class="form-group">
      <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
      <input type="password" class="input" name="psw" placeholder="Enter password" required/>
    </div>

    <div class="checkbox">
      <label><input type="checkbox" value="" checked>Remember me</label>
    </div>
      <button type="submit" class="btn btn-success btn-block" name="login" id="logginin"><span class="glyphicon glyphicon-log-in"></span> Login</button>
  </form>
</div>
<!-- Login Form -->
</body>
<script type="text/javascript">
$("#logerr").hide();
$("#logout").click(function(){
    window.location.href="logout.php";
});
    $("#logginin").click(function(e){
 //     e.preventDefault();
      $("#log-form").validate({
        rules:
        {
            usrname: {
                required: true,
                minlength: 4
            },
            psw: {
                required: true,
                minlength: 6
            }
        },
        messages:
        {
            usrname: "Enter a Valid Username",
            psw:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 6 Characters"
            }
        },
        submitHandler: loginNow
      });

      function loginNow(){
      var data = $("#log-form").serialize();
      $.ajax({
        type: "POST",
        url: "login.php",
        data: data,
        success: function(data){
          if(data=="OK"){
           window.location.href="../index.php";
          }
          else if(data=="failed"){
            $("#logerr").addClass("alert alert-danger").fadeIn().html('<span class="glyphicon glyphicon-remove-sign"><span> Username & Password Missmatch').fadeOut(3000);
          }
          else{
            $("#logerr").addClass("alert alert-danger").fadeIn().html('<span class="glyphicon glyphicon-remove-sign"><span> '+data).fadeOut(7000);
          }
        },
        error: function(){
          $("#logerr").addClass("alert alert-danger").fadeIn().html('<span class="glyphicon glyphicon-remove-sign"><span> Opps something happened').fadeOut(3000);
        }
      });
    }
    });

    </script>
<script type="text/javascript">
  document.querySelector('#reset').onclick = function(){
  swal({
    title: "Success",
    text: "Your request proccessed",
    type: "success",
    timer: 1100,
    showConfirmButton: false
  });
};

</script>
</html>