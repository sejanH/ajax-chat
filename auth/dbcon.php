<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$db = "chat";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  die ("Failed to connect to MySQL: " . mysqli_connect_error());
  }
else{
	$person= "CREATE TABLE IF NOT EXISTS person(
	username varchar(30) PRIMARY KEY,
    pass varchar(60) NOT NULL,
    fullName varchar(60),
    email varchar(60) NOT NULL,
    DoB date,
    gender varchar(60),
    country varchar(60)
)";
$conn->query($person);
}
?>