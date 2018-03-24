<!doctype html>
<html>
	<head>
		<title>List Match Data</title>
	  	<link rel='stylesheet' href="w3.css">
	  	<link rel='stylesheet' href="w3-theme-red.css">
	  	<link rel='stylesheet' href="tablestylesheet.css">
	  	<meta name=viewport content="width=device-width">
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<style>
	  	th {
	  		text-align: left;
	  	}
	  	table {
		    border-collapse: collapse;
		}

		table, th, td {
		    border: 1px solid black;
		}
		
	  	</style>

	</head>
	
	<body class="w3-theme-d3">

  		<ul class="w3-navbar w3-theme-l3 w3-round-xxlarge w3-border-black">
    		<li><a href='index.html'>Match Scouting</a></li>
    		<li><a href="pitscouting.html">Pit Scouting</a></li>
    		<li><a href="schedule.php">Schedule</a></li>
    		<li><a href="teams.php">Team List</a></li>  
  		</ul>
  		<div class="w3-panel w3-theme-l3 w3-padding-large w3-round-xxlarge w3-border w3-border-black w3-text-white w3-margin-left w3-margin-right">
			<table><tr><th>Match</th><th>Team</th><th>Scout</th><th>Comments</th></tr>
			<?php
				require_once('db.php');
				$sql = "SELECT matchnum, team, scout_name, comments FROM matches ORDER BY matchnum DESC, team;";
				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					echo "<td>{$row['matchnum']}</td>";
					echo "<td>{$row['team']}</td>";
					echo "<td>{$row['scout_name']}</td>";
					echo "<td>{$row['comments']}</td>";
					echo "</tr>";
				}
			?>
			</table>

		</div>
	</body>
</html>
