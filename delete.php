<!DOCTYPE html>
<html>
<body>
<meta http-equiv="refresh" content="1;url=view.php" />

<?php
include 'config.php';
if (!$user) {
	echo "You need to <a href=$path>log in</a>";
	die();
}
$id = $_GET['id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($stmt = $conn->prepare('DELETE FROM links WHERE short = ?')) {
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}else{
	die("Query failed!");
}

?>
Record deleted.
<br>Redirecting...

</body>
</html>
