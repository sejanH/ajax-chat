<?php
require 'auth/dbcon.php';
session_start();
$me = $_SESSION['user'];
date_default_timezone_set('Asia/Dhaka');
if($_GET['to']!='null')
{
	$to = $_GET['to'];

	$query =    "SELECT * FROM message 
				where (sender='$me' AND reciepient='$to') 
				OR 
				(sender='$to' AND reciepient='$me') 
				order by sentAt DESC Limit 15"; 


  	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

	if($result && mysqli_num_rows($result)>0){
		$dattTime = new DateTime(); 
		echo "<table class='table table-responsive table-striped'><tr><th>Sender</th><th>Message</th><th>Time</th>";
	
		while ($row = mysqli_fetch_array($result)) {
			$dateTime2 = new DateTime($row[3]);
			$interval = date_diff($dateTime2,$dattTime);
			$hours = $interval->h + ($interval->d*24);
			if($hours<24)
			{
				echo "<tr><td style='font-size:11px'>".$row[0]."</td><td>".str_replace("\n", "<br/>", $row[2])."</td><td style='font-size:10px'>".$interval->h." hour ".$interval->i." min ago</td></tr>";
			}
			else{
				echo "<tr><td style='font-size:11px'>".$row[0]."</td><td>".$row[2]."</td><td style='font-size:10px'>".$interval->d." days ".$interval->h." hour ago</td></tr>";
			}
		}
		echo "</table>";
	}
	else{
		echo "<span class='alert alert-info'>No Messages Found</span>";	
	}
}
else{
	echo "<span class='alert alert-info'>Select a user</span>";echo $_GET['to'];	
}
?>

 