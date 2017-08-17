<?php
session_start();
if ($_SESSION['auth'] != 1) {
	require('login.php');
}else{
	if ($_COOKIE['username'] !== "mike") {
		header('Location: view.php');
	}
	include 'config.php';
	if (empty($_POST['newpass'])) {
		$newpass = "";
	}else {
	$newuser = $_POST['newuser'];
	$newpass = sha1($_POST['newpass']);
	}
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_erro);
	}
	$stmt = $conn->prepare("INSERT INTO users (user,pass) VALUES (?,?)");
	$stmt->bind_param("ss", $newuser, $newpass);
		if($stmt->execute()) {
			echo "User added successfully.";
		}else{
			echo "Adding user failed.";
		}
	$stmt->close();
	$conn->close();
}


?>
<html>
<head></head>
<body>
<form action="user.php" method="POST">
Username: <input type="text" name="newuser"><br>
Password: <input type="password" name="newpass"><br>
<input type="submit" name="Add User">
</form>
</body>
</html>