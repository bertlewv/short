<!DOCTYPE html>
<html>
<body>
<?php
include 'config.php';
if (!$user) {
	echo "You need to <a href=$url>log in</a>";
	die();
}
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
