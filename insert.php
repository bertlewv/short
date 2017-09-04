<!DOCTYPE html>
<html>
<body>

<?php
session_start();
if ($_SESSION['auth'] != 1) {
	require('login.php');
}else{
	include 'config.php';
	//Generate random 5 character string
	$short = substr(md5(microtime()),rand(0,26),5);
	$url = $_POST['url'];
	$view = 1;

	if (filter_var($url, FILTER_VALIDATE_URL)) {
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if ($stmt = $conn->prepare("INSERT INTO links (short, url, view, user, date) VALUES (?, ?, ?, ?, ?)")) {
			$stmt->bind_param("ssiss", $short, $url, $view, $user, $date);
			$stmt->execute();
			$stmt->close();
			$conn->close();
			echo "Your link has been shortened: <a href=".$path.$short." target=_blank>".$path.$short."</a>";
			echo "<br><br><a href=view.php>View URLs</a>";
		}
	}else {
		echo "$url is not a valid URL. Make sure to include http://";
?>
<br>
<button onclick="goBack()">Go Back</button>
<script>
function goBack() {
  window.history.back();
}
</script>
<?php
	}
}
?>
</body>
</html>
