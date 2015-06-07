<?php
session_start();
$_SESSION = array();
session_destroy;
header("location: index.php");
exit();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Redirecting</title>
	</head>
	<body>
	</body>
</html>	