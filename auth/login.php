<?php

include('dbcon.php');

if ($_POST){
  $un= mysqli_real_escape_string($conn,$_POST['usrname']);
  $pwd = mysqli_real_escape_string($conn, $_POST['psw']);
  

 $query = "SELECT * FROM person WHERE username='$un' AND pass='$pwd'";
 $res= mysqli_query($conn, $query) or die(mysqli_error($conn));
 $row=mysqli_fetch_array($res);
 $count=mysqli_num_rows($res);

 if($res)
{
    if($count == 1)
   {
    session_start();
    $_SESSION['user'] = $row['username'];
    echo "OK";
   }
   else{
    echo "failed";
   }
 }
 else{
  echo $res;
 }
}
?>