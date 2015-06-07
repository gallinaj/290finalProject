<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'recipeHeader.php';
?>

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
				
				<p>Log in to see your recipes.</p>
				<p>If you haven't created an account, click <a href="recipe_signup.php">here</a>.</p>
			
			<?php
				echo "<form id=\"login\" method=\"POST\" action=\"recipes_html.php\">";
					echo "<span>Enter username </span><input type=\"text\" name=\"username\"><br />";
					echo "<span>Enter password </span><input type=\"password\" name=\"password\"><br />";
			
					echo "<input type=\"submit\" value=\"Login\"><br />";
				echo "</form>";
			?>
			</fieldset>
		</div>
	</body>
</html>