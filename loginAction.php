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

				$hostname = "localhost";
				$dbusername = "task_user_1";
				$dbpassword = "123";
				$dbname = "task";

				// Mysqli Object-Oriented
				echo "Mysqli Object-Oriented";
				echo "<br>";
				$conn1 = new mysqli($hostname, $dbusername, $dbpassword, $dbname);

				if($conn1->connect_errno) {
					echo "Database Connection Failed!...";
					echo "<br>";
					echo $conn1->connect_error;
				}
				else{
					echo "Database Connection Successful!  ";
					echo "<br>";


					$stmt = $conn1->prepare("select username, password from user where username = ? and password = ?");
					$stmt->bind_param("ss", $userName , $password);
					$stmt->execute();
					$res2 = $stmt->get_result();
					$user = $res2->fetch_assoc();

					if(isset($user)){
						echo "<br>";
						echo "Login Successful";
						echo "<br>";
						echo "username: " . $user['username'];
						echo "<br>";
						echo "password: " . $user['password'];
						echo "<br>";
						echo "<br>";

					}
					
					}
					$conn1->close();
				
				
				/*
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
				*/
			}
		}
	?>
	
	<form action="logoutAction.php" method="POST">

		<input type="submit" value="Logout">

	</form>

</body>
</html>