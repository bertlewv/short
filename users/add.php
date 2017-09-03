<?php
session_start();
function html() {
	?>
	<html>
	<head></head>
	<body>
	<form action="" method="POST">
	Username: <input type="text" name="newuser"><br>
	Password: <input type="password" name="newpass"><br>
	<input type="submit" name="Add User">
	</form>
	<a href=view.php>View Users</a>
	</body>
	</html>
	<?php
}
$options = [
        'cost' => 11,
];
if ($_SESSION['auth'] != 1) {
	require('../login.php');
}else{
	include '../config.php';
	if ($user !== $admin) {
		header('Location: add.php');
	}
	if (empty($_POST['newpass'])) {
		$newpass = "";
	}else {
	$newuser = $_POST['newuser'];
	$newpass = $_POST['newpass'];
	$hashpass = password_hash($newpass, PASSWORD_BCRYPT, $options);
	}
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_erro);
	}
	$stmt = $conn->prepare("INSERT INTO users (user,pass) VALUES (?,?)");
	$stmt->bind_param("ss", $newuser, $hashpass);
		if($stmt->execute()) {
			echo "User <font color=#09e853><b>".$newuser."</b></font> added successfully.";
			html();
		}else{
			echo "Adding user failed.";
			html();
		}
	$stmt->close();
	$conn->close();
}


?>
