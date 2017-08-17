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
	require('login.php');
}else{
	include 'config.php';
	?>
	<button type="button" onclick="window.location.href='new.php'">Add URL</button>
	<?php
	if ($user == $admin) {
		echo "<button type=button onclick=window.location.href='user.php'>Add USER</button>";
	}
	echo "<br>Hello ".$user."!<br>";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("SELECT * FROM links where user = ?");
	$stmt->bind_param("s", $user);
	$stmt->execute();
	$stmt->bind_result($short, $url, $view, $user, $date);
	print '<table border="1" cellspacing="0">';
	print '<th>Short</th><th>URL</th><th>User</th><th>Date Submitted</th><th>Delete</th>';
	while($stmt->fetch()) {
		print '<tr>';
		print '<td><a href="'.$path.$short.'" target="_blank">'.$short.'</a></td>';
		print '<td>'.$url.'</td>';
		print '<td>'.$user.'</td>';
		print '<td>'.$date.'</td>';
		print '<td align="center"><a href="delete.php?id='.$short.'"><img src="delete-icon.png"></a>';
		print '</tr>';
	}
	print '</table>';
	$stmt->close();
	$conn->close();
}
?>


</body>
</html>
