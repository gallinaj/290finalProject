<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once 'recipeHeader.php';

if(isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == "" || $password == "") {
		echo "Not all fields were entered.";
	}
	else {
		if(!($stmt = $mysqli->prepare("SELECT * FROM recipe_members WHERE username='$username' AND password='$password'"))) {
			echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if (!($result = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if($result->num_rows == 0) {
			echo "<span class=\"error\">Username/Password invalid</span>";
		}
		else {
			if(!($stmt = $mysqli->prepare("SELECT id FROM recipe_members WHERE username='$username'"))) {
				echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
			}
			if(!$stmt->execute()) {
				echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
			}
			if (!($result = $stmt->get_result())) {
				echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			while($row = $result->fetch_assoc()) {
				$id_result = $row["id"];
			}
			
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['mem_id'] = $id_result;
			
			//echo "You are now logged in, " . $username . ". Please <a href=\"recipeshtml.php\">click here</a> to continue.";
			//echo "<p>You are now logged in, " . $username . "</p>";
			//echo "<p>You are now logged in, " . $id_result . "</p>";

			echo "<br />";
			echo "Welcome, " . $username . "<br />";
			echo "<p>Please <a href=\"recipeshtml.php\">click here</a> to continue.</p>";
			echo "<a href=\"recipe_logout.php\"><input type=\"button\" value=\"Logout\"></a>";
			//echo "<form id=\"login\" method=\"POST\" action=\"recipeshtml.php\">";
			//echo "Please click <input type=\"submit\" value=\"here\"> to log in";
		}

		$stmt->close();	
	} 
}

if(!$loggedIn) {
	echo "<form id=\"login\" method=\"POST\" action=\"recipe_login.php\">";
		echo "<span>Enter username </span><input type=\"text\" name=\"username\"><br />";
		echo "<span>Enter password </span><input type=\"password\" name=\"password\"><br />";
		echo "<input type=\"submit\" value=\"Login\"><br />";
	echo "</form>";
	
	echo "<p>If you haven't created an account, click <a href=\"recipe_signup.php\">here</a>.</p>";
	
}
else {
	echo "Please <a href=\"recipeshtml.php\">click here</a> to continue.";

}
?>

			</fieldset>
		</div>
	</body>
</html>


<!---<!DOCTYPE html>
<html>
	<head>
		<title>Login Screen</title>
		<link rel="stylesheet" type="text/css" href="recipes.css">

	</head>
	<body>
		<div id="login">
			<fieldset>
				<h1>Welcome to the Recipe Box!</h1>--->