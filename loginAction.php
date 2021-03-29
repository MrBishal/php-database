<!DOCTYPE html>
<html>
<head>
	<title>Login Form Action</title>
</head>
<body>

	<h1>Login Form Action</h1>

	<?php 
	session_start();

		if($_SERVER['REQUEST_METHOD'] == "GET") {
			
			if(empty($_GET['uname']) && empty($_GET['pword'])) {
				echo "Please fill up properly";
			} 
			else {
				
				$userName = $_GET['uname'];
				$password = $_GET['pword'];
				
				$SESSION['login_user']= $userName;
				$SESSION['password']= $password;
				
				$f = fopen("data.txt", "r");
				
				$data = fread($f, filesize("data.txt"));
				$data_filter = explode(",", $data);

				$json_decode = json_decode($data, true);

				
				if(($json_decode['userName']==$userName) && ($json_decode['password']==$password))
				{

					echo "Login Successful!!!<br>";
					echo $json_decode['userName'];
					echo"<br>";
					echo $json_decode['firstName'];
					echo"<br>";
					echo $json_decode['lastName'];
					echo"<br>";
					echo $json_decode['email'];
				}
				
				else
				{
					echo "Login Failed";
				}
				 
			}
		}
	?>
	
	<form action="logoutAction.php" method="POST">

		<input type="submit" value="Logout">

	</form>

</body>
</html>