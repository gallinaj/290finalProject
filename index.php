<?php
require_once 'recipeHeader.php';

/***
Code assistance for this project from the following:

- http://www.phpro.org/tutorials/Introduction-to-PHP-and-MySQL.html#6.2 
- CS340 video on PHP and MySQL
- CS290 tutor sessions
- "Learning PHP, MySQL, JavaScript, & CSS" by Robin Nixon
- "PHP, MySQL, JavaScript, & HTML5" by Steven Suehring

***/

if($loggedIn) {
	echo "<p>";
	echo "Welcome, " . $username . "!";
	echo "</p>";

	echo "Please <a href=\"recipeshtml.php\">click here</a> to continue.";
}

?>

<!---<!DOCTYPE html>
<html>
	<head>
		<title>Recipe Box</title>
		<link rel="stylesheet" type="text/css" href="recipeStyle.css">
		<script type="text/javascript" src="recipes.js"></script>
	</head>

	<body>
		<div id="welcome">
			<fieldset>
				<h1>The Recipe Box</h1>
				<p>In order to access The Recipe Box, please create an account and/or log in!<p>
				<table>
					<tr>
						<td><a href="recipe_login.php"><input type="button" value="Log In"></a></td>
						<td><a href="recipe_signup.php"><input type="button" value="Create Account"></a></td>
					</tr>
				</table>-->
				
				
			</fieldset>
		</div>
	</body>
</html>

