<html>

	<head><link rel="stylesheet" type="text/css" href="main.css"></head>

	<div>
		<center><h1>Add a new Location</h1></center>
	</div>

	<?php  


	?>

	<form>
		<h3>POI location name: </h3><br>
		<input type = "text" name = "newLocation"><br>

		<select name="City" required>
		<?php 
			$conn = mysql_connect("localhost","compuser","yeahsure");
			mysql_select_db("4400DatabaseProject",$conn);
			echo mysql_error();

			if (!$conn) {
				echo "Unable to connect to DB: " .mysql_error();
				exit;
			}

			$theQuery = "select city FROM 'CityState'";
			$theResponse = mysql_query($theQuery);

			while($row  = mysql_fetch_assoc($theResponse)) {
				echo "<option>".$row["city"]."</option>";
			}
		?>
			
		</select>	

		<br>
		<br>

		<select name = "State" required> 
		<?php 
			$conn = mysql_connect("localhost","compuser","yeahsure");
			mysql_select_db("4400DatabaseProject",$conn);
			echo mysql_error();

			if (!$conn) {
				echo "Unable to connect to DB: " .mysql_error();
				exit;
			}

			$theQuery = "select state FROM 'CityState'";
			$theResponse = mysql_query($theQuery);

			while($row  = mysql_fetch_assoc($theResponse)) {
				echo "<option>".$row["state"]."</option>";
			}
		?>
		</select>


		<h3>Zip code: </h3><br>
		<input type = "text" name = "zipCode">
		<br>
		<br>
		<input type="submit" value="Submit">
		<input type="reset">
		<br>
		<p id = 'errorMsg'></p>
		<script>
        document.getElementById('errorMsg').innerHTML = localStorage.getItem("didFail");
        localStorage.setItem("didFail","");
    	</script>	


	</form>	


	<form action="index.html">
		<input type="submit" name="Log out">
	</form>

</html>