<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kamal</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="topnav">
  <h2><?php session_start(); echo $_SESSION['username']; ?></h2>
  <div class="topnav-right">
<form name="View" method="post" >
<input type="submit" name="Logout" value="Logout" style="float: right;" />
<input type="submit" name="Friends" value="Friends" style="float: right;"/>
  </form>
  </div>
</div>
<div class="flex-container">

  <div class="flex-child magenta">
    <h3>Updates</h3>
    <?php  
    	$databaseHost = 'localhost';
		$databaseName = 'kamal';
		$databaseUsername = 'root';
		$databasePassword = '';
		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
		$uu = $_SESSION['username'];
		$query = 'SELECT * from login where uname = "'.$uu.'"';
		$d =  mysqli_query($mysqli, $query);
		$d=mysqli_fetch_array($d);
		$d= $d['uname'];
		$cons = "friends";
		$sql = "Select DISTINCT uname from updates where uname IN"."(SELECT uname FROM login where (uname IN (Select uname1 from friends where Friend_status =".'"'.$cons.'"'." and (uname1=".'"'.$d.'"'." or uname2=".'"'.$d.'"'.")) OR uname IN (Select uname2 from friends where Friend_status =".'"'.$cons.'"'." and (uname1=".'"'.$d.'"'." or uname2=".'"'.$d.'"'."))) and uname!=".'"'.$d.'")';
		// echo $sql;
		
		$result = mysqli_query($mysqli,$sql);

		  while($res = mysqli_fetch_array($result)) {  

			echo 'Updates from'.$res['uname']."<br>";
			echo '<div class="updated">';	
			  	
			$sql2 = "Select * from updates where uname=".'"'.$res['uname'].'"';
			$result2 = mysqli_query($mysqli,$sql2);
		  	while($res2 = mysqli_fetch_array($result2)){
					echo $res2['update_msg']."<br>";
		  	}
				echo "</div>";

      
  }

    ?>
  </div>
  
  <div class="flex-child green">
    <h3>Post updates</h3>
    <form method="post" >
<div class="up">
<textarea  name="updatepost" rows="5"  style="resize: none;" placeholder="Type Your status update here"></textarea><br>
<input type="submit" name="updatebutton" value="Post"/>
    </div></form>

  </div>
<?php 
		
		 
		
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['updatepost']) and isset($_POST['updatebutton'])){
				echo "check";
				updatepost();
			}
			if(isset($_POST['Logout'])){
					session_destroy();
					header("location:index.php");
			}
			if(isset($_POST['Friends'])){
					echo "Friends";
					header("location:friends.php");
			}
			# code...
			
			
		}
		
		function updatepost(){
			$databaseHost = 'localhost';
		$databaseName = 'kamal';
		$databaseUsername = 'root';
		$databasePassword = '';
		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

		$uname = $_SESSION['username']; 

			$updatemsg = mysqli_real_escape_string($mysqli, $_POST['updatepost']);	
			
			$result = mysqli_query($mysqli, "INSERT INTO updates(uname,update_msg) VALUES('$uname','$updatemsg')");
			echo '<script>alert("Post updated")</script>';
		}
 ?>  
</div>
</body>
</html>