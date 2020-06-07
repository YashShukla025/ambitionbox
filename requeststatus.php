<?php 
session_start();
$uname=$_SESSION['username'];
$g = "friends";
$u =$_POST['id'];
echo $u."<br>";
list($id, $dec) = explode(',', $u);
echo $id."<br>".$dec."<br>";
if(dec == "Yes"){
$g = "friends";
}
else{
	$g = "rejected";
}

  	$databaseHost = 'localhost';
		$databaseName = 'kamal';
		$databaseUsername = 'root';
		$databasePassword = '';
		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
		$query = 'UPDATE friends SET Friend_status='.'"'.$g.'"'.'where uname1 ='.'"'.$id.'"'.'and uname2='.'"'.$uname.'"'.'or uname1 ='.'"'.$uname.'"'.'and uname2='.'"'.$id.'"';
		$result = mysqli_query($mysqli, $query);
		echo "Error: %s\n".mysqli_error($mysqli);

 ?>