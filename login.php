<?php
include 'config.php';
$name = $_POST['name'];
$pass = sha1($_POST['pass']);
function boop() {
	?>
	<html>
	<head></head>
	<body>
	<center>
	You need to login.
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Username: <input type="text" name="name" value="<?php echo $_COOKIE['username']; ?>">
	<p>
	Password: <input type="password" name="pass">
	<p>
	<input type="submit" name="submit" value="Log In">
	</form>
	</center>
	</body>
	</html>
	<?php
}
if (isset($name) && isset($pass)) {
	//if (empty($name)) {
	//	die("ERROR: YOU DIDN'T ENTER A USERNAME YOU TWAT!");
	//}
	//if (empty($pass)) {
	//	die("ERROR: YOU DIDN'T ENTER A PASSWORD YOU IDIOT!");
	//}
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$stmt = $conn->prepare("SELECT user FROM users WHERE user = ? and PASS = ?");
	$stmt->bind_param("ss", $name, $pass);
	if($stmt->execute()) {
		$stmt->bind_result($rawr);
		$stmt->store_result();
		$stmt->fetch();
		if ($stmt->num_rows < 1) {
			/*Denied */
			echo "<center>Valid authentication credentials not provided</center>";
			boop();
		}else {
			//if ($name == "mike" && $pass == "mike" ) {
			session_start();
			$_SESSION['auth'] = 1;
			setcookie("username", $_POST['name'], time()+(84600*30));
			header('Location: view.php');
			exit;
		}
	}
}else {
	boop();
}
