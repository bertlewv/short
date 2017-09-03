<!DOCTYPE html>
<html>
<body>
<head>
<style type="text/css">
a {
	color: #0962f2;
	text-decoration: underline;
	font-weight: bold;
}
</style>
<?php
session_start();
if ($_SESSION['auth'] != 1) {
	require('../login.php');
}else{
	include '../config.php';
	if ($user != $admin) {
		die("You are not an admin");
	}
	echo "<h2>USER MANAGEMENT</h2>";
	echo "<button onclick=window.location.href='add.php'>Add USER</button> ";
	echo "<button onclick=window.location.href='../view.php'>View URLs</button> ";
	echo "<button onclick=window.location.href='../logout.php'>LOGOUT</button> ";
	echo "<br>Hello ".$user."!<br>";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("SELECT * FROM users");
	//$stmt->bind_param("s", $user);
	$stmt->execute();
	$stmt->bind_result($user,$pass);
	print '<table border="1" cellspacing="0">';
	print '<th>User</th><th>Pass</th><th>Delete</th>';
	while($stmt->fetch()) {
		print '<tr>';
		print '<td>'.$user.'</td>';
		print '<td>'.$pass.'</td>';
		print '<td align="center"><a href="delete.php?id='.$user.'"><img src="../delete-icon.png"></a>';
		print '</tr>';
	}
	print '</table>';
	$stmt->close();
	$conn->close();
}
?>


</body>
</html>
