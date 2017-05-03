<?php

include('dbcon.php');

if ($_POST){
  $un= mysqli_real_escape_string($conn,$_POST['uname']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  if(isset($_POST['gender']))
  {
    $gndr = mysqli_real_escape_string($conn, $_POST['gender']);
  }
  else{
    $gndr= null;
  }
  $loc_country = mysqli_real_escape_string($conn, $_POST['country']);
  
    $check = "select * from person where username='$un' or email='$email'";
    $count = mysqli_num_rows($conn->query($check));
    if($count==0)
    {
      $insert = "insert into person(username,pass,fullName,email,DoB,gender,country) values('$un','$pwd','$fullname','$email','$dob','$gndr','$loc_country')";
      $result = mysqli_query($conn,$insert);
      if($result)
      {
         echo "Registered";
            }
            else
            {
                echo "Query could not execute !";
            }
    }
    else{
      echo "1";
    }
}
?>