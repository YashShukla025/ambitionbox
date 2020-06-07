<?php  
session_start();
$uname=$_SESSION['username'];
$g = "requested";
$u =$_POST['id'];

  	$databaseHost = 'localhost';
		$databaseName = 'kamal';
		$databaseUsername = 'root';
		$databasePassword = '';
		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
		$result = mysqli_query($mysqli, "INSERT INTO friends(uname1,uname2,Friend_status) VALUES('$uname','$u','$g')");
echo "lasan";

?>