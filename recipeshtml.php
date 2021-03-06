<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'recipeHeader.php';
?>
  
		</fieldset>
	</div>
	<div id="addRecipe">
		<form id="addForm">
			<fieldset>
				<legend>Add Recipe</legend>
				<span>Recipe Name </span><input type="text" name="name"><br />
				<span>Recipe Type </span><select id="type" name="category">
					<option value="">Select a type</option>
					<option value="main dish">Main Dish</option>
					<option value="side dish">Side Dish</option>
					<option value="soup">Soup</option>
					<option value="salad">Salad</option>
					<option value="dessert">Dessert</option>	
					<option value="Beverage">Beverage</option>
					<!---<option value="Poop">"Soup"</option>--->
				</select><br />
				<span>Main Ingredient </span><input type="text" name="mainIngredient"><br />
				<span>Where is it? </span><select id="location" name="location">
					<option value="">Select</option>
					<option value="website">Website</option>
					<option value="magazine">Magazine</option>
				</select><br />

				<input id="addButton" type="button" name="addButton" value="Add Recipe">
			</fieldset>
		</form>
	</div>
	
	<div id="filters">
		<fieldset>
			<legend>Group Recipes by...</legend>
			<table>
				<tr>
					<td>Recipe Type</td>
					<td><input id="sortOnType" type="button" name="sortOnType" value="Sort"></td>
				</tr>
				<tr>
					<td>Main Ingredient</td>
					<td><input id="sortOnIng" type="button" name="sortOnIng" value="Sort"></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Filter Recipes by...</legend>
			<table>
				<tr>
					<td>Recipe Type</td>
					<td ><select id="typeRecipe" name="category">
						<option value="">Select a type</option>
						<option id="mainDish" value="main dish">Main Dish</option>
						<option id="sideDish" value="side dish">Side Dish</option>
						<option value="soup">Soup</option>
						<option value="salad">Salad</option>
						<option value="dessert">Dessert</option>	
						<option value="beverage">Beverage</option>
						<option value="Poop">"Soup"</option>
					</select></td>
					<td><input id="filterOnType" type="button" name="filterOnType" value="Filter"></td>
				</tr>
				<tr>
					<td>Main Ingredient</td>
					<td><input type="text" id="filterMainIng"></td>
					<td><input id="filterOnIng" type="button" name="filterOnIng" value="Filter"></td>
				</tr>
				<tr>
					<td><input id="clearFilter" type="button" name="sortOnIng" value="Clear Filters"></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>View Entire Database</legend>
			<table>
				<!--<tr>
					<td>Recipe Type</td>
					<td><input id="sortAllOnType" type="button" name="sortAllOnType" value="Sort"></td>
				</tr>
				<tr>
					<td>Main Ingredient</td>
					<td><input id="sortAllOnIng" type="button" name="sortAllOnIng" value="Sort"></td>
				</tr>-->
				<tr>
					<td><input id="viewAll" type="button" name="viewAll" value="View All Recipes"></td>
				</tr>
			</table>
			
		</fieldset>
	</div>

	<div id="recipeList">
		<fieldset>
			<legend>Recipe List</legend>
		
		</fieldset>
	</div>
  
  </body>
</html>