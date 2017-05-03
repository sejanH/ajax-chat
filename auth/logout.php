<?php

session_start();

if(!isset($_SESSION['user']))

{session_destroy();

 header("Location: auth.php");

}

else if(isset($_SESSION['user'])!="")

{session_destroy();

 header("Location: auth.php");

}



if(isset($_GET['logout']))

{

 session_destroy();

 unset($_SESSION['user']);

 header("Location: auth.php");

}

?>