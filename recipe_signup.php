<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'recipeHeader.php';

if(isset($_SESSION['username'])) {
	session_destroy();
}

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($username == "" || $password == "") {
		echo "Not all fields were entered.";
	}
	else {
		if (!($stmt = $mysqli->prepare("SELECT * FROM recipe_members where username='$username'"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if (!($result = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if($result->num_rows) {
			echo "I'm sorry, that username already exists. Please try another one.";
		}
		else {
			if(!($stmt = $mysqli->prepare("INSERT INTO recipe_members(username, password) VALUES(?,?)"))) {
				echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
			}
			if(!$stmt->bind_param("ss", $username, $password)) {
				echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
			}
			if(!$stmt->execute()) {
				echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
			}
			else {
				echo "Account created for " . $username . "<br />";
				echo "Please <a href=\"recipe_login.php\">click here</a> to login.";
			}
		}
	} 
}
?>
			
			<p>Please enter a username and password to sign up.</p>
			<form id="login" method="POST" action="recipe_signup.php">
				<span>Enter username </span><input type="text" name="username"><br />
				<span>Enter password </span><input type="password" name="password"><br />

				<input id="signup" type="submit" value="Sign Up"><br />

			</form>			
		</div>
	</body>
</html>