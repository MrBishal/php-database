<!DOCTYPE html>
<html>
<head>
	<title>Database Insert</title>
</head>
<body>

	<h1>Database Insert</h1>

	<?php 

	$hostname = "localhost";
	$username = "task_user_1";
	$password = "123";
	$dbname = "task";

	// Mysqli Object-Oriented
	echo "Mysqli Object-Oriented";
	echo "<br>";
	$conn1 = new mysqli($hostname, $username, $password, $dbname);

	if($conn1->connect_errno) {
		echo "1. Database Connection Failed!...";
		echo "<br>";
		echo $conn1->connect_error;
	}
	else {
		echo "1. Database Connection Successful!";

		$stmt1 = $conn1->prepare("insert into users (username, password) values (?, ?)");
		$stmt1->bind_param("ss", $p1, $p2);
		$p1 = "mno";
		$p2 = "789";
		$status = $stmt1->execute();
		if($status) {
			echo "Data Insert Successful!";
		}
		else {
			echo "Failed to Insert Data.";
			echo "<br>";
			echo $conn1->error;
		
		}

	$conn1->close();
	}
	
	?>

</body>
</html>