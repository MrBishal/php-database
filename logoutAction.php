<!DOCTYPE html>
<html>
<head>
	<title>Logout Form Action</title>
</head>
<body>

	<h1>Logged out Successfully</h1>
	<?php
		session_destroy();
		header('Location: login.html');
		exit;
	?>



</body>
</html>