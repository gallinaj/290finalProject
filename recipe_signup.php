<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'recipeHeader.php';
?>
			<p>Please enter a username and password to sign up.</p>
			<form id="login" method="POST" action="recipeshtml.php">
				<span>Enter username </span><input type="text" name="username"><br />
				<span>Enter password </span><input type="password" name="password"><br />
			
				<input id="signup" type="submit" value="Sign Up"><br />
			</form>

			<?php
			if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
			}
			function checkUser() {
				global $mysqli;
				$table=recipe_members;
				
				if (!($stmt = $mysqli->prepare("SELECT * FROM $table where username='$username'"))) {
					echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				if (!$stmt->execute()) {
					echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				if (!($result = $stmt->get_result())) {
					echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				
				if($result->num_rows) {
					echo "That username already exists";
				}
				else {
					if(!($stmt = $mysqli->prepare("INSERT INTO $table(username, password) VALUES(?,?)"))) {
						echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
					}
					if(!$stmt->bind_param("ss", $username, $password)) {
						echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
					}
					if(!$stmt->execute()) {
						echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
					}
					else {
						echo "Account created for " . $username;
						echo "Please login";
					}
				}
					
				$stmt->close();
			}
			
			
			?>
		</div>
	</body>
</html>