<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

if(isset($_GET['action']) && $_GET['action'] == 'logout') {
	#Empties session array
	$_SESSION = array();
	session_destroy();
	header("location: recipe_login.php");
	die();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Recipe Box</title>
		<script type="text/javascript" src="recipes.js" ></script>
		<link rel="stylesheet" type="text/css" href="recipes.css">
	</head>
  
	<body>
		<?php
			#Starts a new session or resumes a previous one
			if(session_status() == PHP_SESSION_ACTIVE) {
				#No username was entered
				if(!isset($_SESSION['username']) XOR isset($_POST['username'])) {
					echo "A username must be entered. Click ";
					echo "<a href=\"http://web.engr.oregonstate.edu/~gallinaj/cs290Final/recipe_login.php\">here</a>";
					echo " to return to the login screen.<br />";
				}
				
				/*if(isset($_SESSION['username']) == null) {
					echo "A username must be entered. Click ";
					echo "<a href=\"http://web.engr.oregonstate.edu/~gallinaj/cs290Final/recipe_login.php\">here</a>";
					echo " to return to the login screen.<br />";
				}				*/
				
				
				if(isset($_SESSION['username']) || isset($_POST['username'])) {
					
					#Write to session array
					#Username was entered
					if(isset($_POST['username'])) {
						$_SESSION['username'] = $_POST['username'];
					}
					#User has not visited session before
					if(!isset($_SESSION['visits'])) {
						$_SESSION['visits'] = 0;
					}
					#Read from session array
					echo "Hello " . $_SESSION['username'] . "!";

					echo "Click <a href=\"http://web.engr.oregonstate.edu/~gallinaj/cs290Final/recipes_html.php?action=logout\">here</a> ";
					echo "to logout.";

					echo "<div id=\"addRecipe\">";
						echo "<form id=\"addForm\">";
							echo "<fieldset>";
								echo "<legend>Add Recipe</legend>";
								echo "<span>Recipe Name </span><input type=\"text\" name=\"name\"><br />";
								echo "<span>Recipe Type </span><select id=\"type\" name=\"category\">";
									echo "<option value=\"\">Select a type</option>";
									echo "<option value=\"main dish\">Main Dish</option>";
									echo "<option value=\"side dish\">Side Dish</option>";
									echo "<option value=\"soup\">Soup</option>";
									echo "<option value=\"salad\">Salad</option>";
									echo "<option value=\"dessert\">Dessert</option>";
									echo "<option value=\"Beverage\">Beverage</option>";
									echo "<option value=\"Poop\">\"Soup\"</option>";
								echo "</select><br />";
								echo "<span>Main Ingredient </span><input type=\"text\" name=\"mainIngredient\"><br />";
								echo "<span>Where is it? </span><select id=\"location\" name=\"location\">";
									echo "<option value=\"\">Select</option>";
									echo "<option value=\"website\">Website</option>";
									echo "<option value=\"magazine\">Magazine</option>";
								echo "</select><br />";
								echo "<input id=\"addButton\" type=\"button\" name=\"addButton\" value=\"Add Recipe\">";
							echo "</fieldset>";
						echo "</form>";
					echo "</div>";
				
					echo "<div id=\"filters\">";
						echo "<fieldset>";
							echo "<legend>Group Recipes by...</legend>";
							echo "<table>";
								echo "<tr>";
									echo "<td>Recipe Type</td>";
									echo "<td><input id=\"sortOnType\" type=\"button\" name=\"sortOnType\" value=\"Sort\"></td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>Main Ingredient</td>";
									echo "<td><input id=\"sortOnIng\" type=\"button\" name=\"sortOnIng\" value=\"Sort\"></td>";
								echo "</tr>";
							echo "</table>";
						echo "</fieldset>";
						echo "<fieldset>";
							echo "<legend>Filter Recipes by...</legend>";
							echo "<table>";
								echo "<tr>";
									echo "<td>Recipe Type</td>";
									echo "<td id=\"typeRecipe\"><select name=\"category\">";
										echo "<option value=\"\">Select a type</option>";
										echo "<option id=\"mainDish\" value=\"main dish\">Main Dish</option>";
										echo "<option id=\"sideDish\" value=\"side dish\">Side Dish</option>";
										echo "<option value=\"soup\">Soup</option>";
										echo "<option value=\"salad\">Salad</option>";
										echo "<option value=\"dessert\">Dessert</option>";
										echo "<option value=\"beverage\">Beverage</option>";
										echo "<option value=\"Poop\">\"Soup\"</option>";
									echo "</select></td>";
									echo "<td><input id=\"filterOnType\" type=\"button\" name=\"filterOnType\" value=\"Filter\"></td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>Main Ingredient</td>";
									echo "<td><input type=\"text\" id=\"filterMainIng\"></td>";
									echo "<td><input id=\"filterOnIng\" type=\"button\" name=\"filterOnIng\" value=\"Filter\"></td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td><input id=\"clearFilter\" type=\"button\" name=\"sortOnIng\" value=\"Clear Filters\"></td>";
								echo "</tr>";
							echo "</table>";

/*							<!---<form method="POST">
								<select id="typeRecipe">
									<option value="">Select a type</option>
									<option id="mainDish" value="main dish">Main Dish</option>
									<option value="side dish">Side Dish</option>
									<option value="soup">Soup</option>
									<option value="salad">Salad</option>
									<option value="dessert">Dessert</option>	
									<option value="Beverage">Beverage</option>
									<option value="Poop">"Soup"</option>
								</select>
								<input id="filterOnType" type="submit" value="Filter By Category" />
							</form>--->*/
							
						echo "</fieldset>";
					echo "</div>";
					
					echo "<div id=\"recipeList\">";
						echo "<fieldset>";
							echo "<legend>Recipe List</legend>";
						
						echo "</fieldset>";
					echo "</div>";
				echo "</body>";
			echo "</html>";
					
				}
			}
		?>
		
