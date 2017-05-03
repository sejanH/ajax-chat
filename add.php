<?php
require 'auth/dbcon.php';
if($_POST)
{
session_start();
	$usr = $_SESSION['user'];
	$to = $_GET['to'];
	$txt = str_replace("'", "\'", $_POST['name']);

if(!empty($txt) && !empty($to))
{
	$query = "INSERT INTO message(sender,reciepient,msg) values('$usr','$to','$txt')";
	if($usr!=$to)
	{
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
		if(!$result){
			echo $result;
		}
	else{
		echo 'Success';
		}
	}
	else{
		echo "Can't send yourself a message";
	}
}
else{
	if(empty($to)){
		echo "Select an user first";
	}
	elseif (empty($txt)) {
		echo "Textfield empty";
	}
}
}
?>