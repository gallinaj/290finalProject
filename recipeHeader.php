<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gallinaj-db", $myPassword, "gallinaj-db");

if($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
	if(isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$loggedIn = TRUE;
	}
	else {
		$loggedIn = FALSE;
	}
	
	echo "<!DOCTYPE html>";
	echo "<html>";
		echo "<head>";	
			echo "<title>Recipe Box</title>";
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"recipeStyle.css\">";
			echo "<script type=\"text/javascript\" src=\"recipes.js\"></script>";
		echo "</head>";
		
		echo "<body>";
			echo "<div id=\"welcome\">";
				echo "<fieldset>";
					echo "<h1>The Recipe Box</h1>";
					
					if($loggedIn) {
						echo "You are logged in, " . $username;
						echo "<a href=\"recipe_logout.php\"><input type=\"button\" value=\"Logout\"></a>";
					}
					/*else {
						echo "<a href=\"recipe_signup.php\"><input type=\"button\" value=\"Create Account\"></a>"; 
						echo "<a href=\"recipe_login.php\"><input type=\"button\" value=\"Log In\"></a><br />"; 
						
						echo "In order to access The Recipe Box, please create an account and/or log in!";
						
					}*/
					
					
	
}
?>