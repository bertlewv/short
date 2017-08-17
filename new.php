<!DOCTYPE html>
<html>
<body>
<?php
session_start();
if ($_SESSION['auth'] != 1) {
	require('login.php');
}else {
	include 'config.php';
?>

<form action="insert.php" method="POST">
URL to Shorten: <input type="text" name="url"><br>
<input type="Submit">
</form>
<form action="javascript:history.back()">
<input type="submit" value="Cancel">
</form>

</body>
</html>
<?php
}
?>
