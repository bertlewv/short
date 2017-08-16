<!DOCTYPE html>
<html>
<body>

<?php
include 'config.php';
$id = $_GET['id'];

if (!$id) {
        header("Location: view.php");
        die();
} else {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
	if ($stmt = $conn->prepare("SELECT url FROM links WHERE short = ? LIMIT 1;")) {
		$stmt->bind_param("s",$id);
		if($stmt->execute()) {
			$stmt->bind_result($url);
			$stmt->store_result();
			$stmt->fetch();
			if ($stmt->num_rows > 0) {
				header("Location: $url");
				$stmt->close();
				$conn->close();
				die();
			}else{
				die("Invalid URL");
			}
		}
	}
}
?>

</body>
</html>

