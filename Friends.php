<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
<div class="topnav">
  <h2><?php session_start(); echo $_SESSION['username']; ?></h2>
  <div class="topnav-right">
<form name="View" method="post" >
<input type="submit" name="Logout" value="Logout" />
<input type="submit" name="Updates" value="Updates" />
  </form>
  <?php if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if(isset($_POST['updatepost']) and isset($_POST['updatebutton'])){
				updatepost();
			}
			if(isset($_POST['Logout'])){
					session_destroy();
					header("location:index.php");
			}
			if(isset($_POST['Updates'])){
					echo "Friends";
					header("location:view.php");
			}
			# code...
			
			
		} ?>
  </div>
</div>
<div class="flex-container">

  <div class="flex-child magenta">
    <h3>Friend Requests</h3>
    <?php 
    	$databaseHost = 'localhost';
		$databaseName = 'kamal';
		$databaseUsername = 'root';
		$databasePassword = '';
		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
		$uu = $_SESSION['username'];
		$g = "requested";
		$query  = 'SELECT * from friends where uname2='.'"'.$uu.'"and Friend_status='.'"'.$g.'"';
		$result = mysqli_query($mysqli, $query);
		 echo '<table>';
		 

		 while($res = mysqli_fetch_array($result)) {     
    		echo '<tr>';
		    echo "<td>".$res['uname1']."</td>";
		    echo '<td><input id="'.$res['uname1'].',Yes'.'" onClick="friendreqstat(this.id)" type="button" value="Yes"></td>';
		    echo '<td><input id="'.$res['uname1'].',No'.'" onClick="friendreqstat(this.id)" type="button" value="No"></td>';
		    echo "</tr>";  

		  }
		  echo "</table>";
      ?>

  </div>
  
  <div class="flex-child green">
    <h3>Friends</h3>

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
		$sql = "SELECT * FROM login where (uname IN (Select uname1 from friends where Friend_status =".'"'.$cons.'"'." and (uname1=".'"'.$d.'"'." or uname2=".'"'.$d.'"'.")) OR uname IN (Select uname2 from friends where Friend_status =".'"'.$cons.'"'." and (uname1=".'"'.$d.'"'." or uname2=".'"'.$d.'"'."))) and uname!=".'"'.$d.'"';
		$result = mysqli_query($mysqli, $sql);
		 echo '<table>';
		 

		 while($res = mysqli_fetch_array($result)) {     
    		echo '<tr>';

		    echo "<td>".$res['uname']."</td>";
		    echo "</tr>";  

		  }
echo "</table>";
      ?>

  </div>
    <div class="flex-child green">
    <h3>All Users</h3>
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
		$sql = "SELECT * FROM login where uname not IN (Select uname1 from friends where (Friend_status =".'"'.$cons.'"'.'OR Friend_status ="requested") and uname1='.'"'.$d.'"'." or uname2=".'"'.$d.'"'.") AND uname not IN (Select uname2 from friends where (Friend_status =".'"'.$cons.'"'.' OR Friend_status ="requested")and (uname1='.'"'.$d.'"'." or uname2=".'"'.$d.'"'.")) and uname!=".'"'.$d.'"';
		$result = mysqli_query($mysqli, $sql);
		 echo '<table>';
		 

		 while($res = mysqli_fetch_array($result)) {     
    		echo '<tr>';

		    echo "<td>".$res['uname']."</td>";
		    echo '<td><input id="'.$res['uname'].'" type="button" onClick="friendreq(this.id)"  value="+"></td>';
		    echo "</tr>";  

		  }

      ?>

  </div>

</div>
<script type="text/javascript">

		function friendreq(params){
			
			console.log('here')
		$.ajax({
		  type: "POST",
		  url: '/Kalam_academy/addfriends.php',
		  data: {'id' : params},
		  success: function(res){
		  	console.log(res);
		  	if(res){
		  		alert("friend request sent");
		  	}
		  }

		});
		refresh();
		}





		function friendreqstat(params){
				$.ajax({
		  type: "POST",
		  url: '/Kalam_academy/requeststatus.php',
		  data: {'id' : params},
		  success: function(data){
		  	console.log(data);
		  	alert("Status updated");
		  }

		});
		refresh();	
		}




		function refresh(){
			location.reload(true);
		}
</script>
</body>
</html>