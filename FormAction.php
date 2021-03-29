<!DOCTYPE html>
<html>
<head>
	<title>Registration Form Action</title>
</head>
<body>

	<h1>Registration Form Action</h1>

	<?php 

		if($_SERVER['REQUEST_METHOD'] == "POST") {
			
			if(empty($_POST['fname']) && empty($_POST['lname']) && empty($_POST['gender']) && empty($_POST['email'])
				&& empty($_POST['uname']) && empty($_POST['pword']) && empty($_POST['remail'])) {
				echo "Please fill up the form properly";
			} 
			else {
				$firstName = $_POST['fname'];
				$lastName = $_POST['lname'];
				$gender = $_POST['gender'];
				$email = $_POST['email'];
				$userName = $_POST['uname'];
				$password = $_POST['pword'];
				$recoveryEmail = $_POST['remail'];

				$arr1 = array('firstName' => $firstName, 'lastName' => $lastName, 'gender' => $gender , 'email' => $email, 'userName' => $userName, 'password' => $password , 'recoveryEmail' => $recoveryEmail);
				$json_encoded_1 = json_encode($arr1);

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
				else {
				echo "Database Connection Successful!  ";
				echo "<br>";

				$stmt1 = $conn1->prepare("insert into user (firstname, lastname, gender, email, username, password, recoveryemail) values (?, ?, ?, ?, ?, ?, ?)");
				$stmt1->bind_param("sssssss", $firstName, $lastName, $gender, $email, $userName, $password, $recoveryEmail);

				$status = $stmt1->execute();
				if($status) {
				echo "Data Insert Successful!";
				echo "<br>";
				}
				else {
				echo "Failed to Insert Data.";
				echo "<br>";
				echo $conn1->error;
		
				}

				$conn1->close();
				}

				
				$f1 = fopen("data.txt", "w");
				fwrite($f1, $json_encoded_1 . "\n");
				fclose($f1);

				$f2 = fopen("data.txt", "r");
				$read = fread($f2, filesize("data.txt"));

				$json_decode = json_decode($read, true);
				

				echo $json_decode['firstName'];
				echo "<br>";
				echo $json_decode['lastName'];
				echo "<br>";
				echo $json_decode['gender'];
				echo "<br>";
				echo $json_decode['email'];
				echo "<br>";
				echo $json_decode['userName'];
				echo "<br>";
				echo $json_decode['password'];
				echo "<br>";
				echo $json_decode['recoveryEmail'];
			}
		}
	?>

</body>
</html>