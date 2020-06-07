<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<style type="text/css">
		body{
			background-color: #75DA8B;
		}
		.modal{
			 background-color: lightgrey;
  width: 300px;

		}
	</style>
</head>
<body>

<!-- Login Form -->

<form name="Login" method="post" >
	<table align="center">
		<tr><td><input type="text" name="uname" placeholder="Username" required /></td></tr>
		<tr><td><input type="password" name="pass" placeholder="Password" required /></td></tr>
		<tr><td><input type="submit" name="Signin" value="Sign In" /></td><td><input type="submit" name="Register" value="Register" /></td></tr>
	</table>
  </form>
  
<?php
// PHP for switching between Signin and Register


if($_SERVER['REQUEST_METHOD'] == "POST")
    {	
    	if(isset($_POST['Register']))
        {
        	register();
        }
        elseif (isset($_POST['Signin'])) {
        	login();
        }
    }
    function Register()
    {	
    	
    	// dbase connection
  		$mysqli = connection();  	


		// textinput
		$uname=mysqli_real_escape_string($mysqli, $_POST['uname']);
		$pass=mysqli_real_escape_string($mysqli, $_POST['pass']); 

        $result = mysqli_query($mysqli, "SELECT * from login where uname='$uname' ");
 		$res = mysqli_num_rows($result);
		if ($res ==0) {
		echo '<script>alert("You are registered")</script>';	
		$result = mysqli_query($mysqli, "INSERT INTO login(uname,pass) VALUES('$uname','$pass')");
		session_start();
		$_SESSION['username']= $uname;
		header("location:view.php");
	}
		 else {
		echo '<script>alert("username not available please enter other username")</script>';}

    }
    function login()
    {
    	

    	// dbase connection
    $mysqli = connection();
		// textinput
		$uname=mysqli_real_escape_string($mysqli, $_POST['uname']);
		$pass=mysqli_real_escape_string($mysqli, $_POST['pass']);
        
		$result = mysqli_query($mysqli, "SELECT * from login where uname='$uname' AND pass='$pass'");
		$res = mysqli_num_rows($result);
		if ($res ==1) {
				echo '<script>alert("Login Succes")</script>';
		session_start();
		$_SESSION['username']= $uname;
		
		header("location:view.php");
}
else
echo '<script>alert("Wrong user name or password")</script>';
    }
    function connection(){
    	    	$databaseHost = 'localhost';
$databaseName = 'kamal';
$databaseUsername = 'root';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
return $mysqli;
    }



?>
      
	

</div>	
</div>
</body>
</html>