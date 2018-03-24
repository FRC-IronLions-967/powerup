<head>
<link rel='stylesheet' href="w3.css">
<link rel='stylesheet' href="w3-theme-red.css">
<link rel='stylesheet' href="tablestylesheet.css">
<meta name=viewport content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
th {
	text-align: left;
}
td.mid {
	text-align: center;
}
</style>

</head>

<body class="w3-theme-d3">
<?php
require_once('db.php');
$sql = "SELECT scout_name, COUNT(*) as c, SUM(LENGTH(comments)) as s FROM matches GROUP BY scout_name ORDER BY c DESC";
//select SUM(LENGTH(comments)) as s FROM matches GROUP BY scout_name
$result = mysqli_query($conn,$sql);
?>
<div class="w3-panel w3-padding-large w3-round-xxlarge w3-border">
<p><a href="index.html">Match Scouting</a></p>
<table>
<tr><th>Scout</th><th>Matches</th><th>Comments</th><th>C per M</th></tr>
<?php
while($row = mysqli_fetch_assoc($result)){
	$c_per_m = round(intval($row['s']) / intval($row['c']));
	echo "<tr>";
	echo "<td>{$row['scout_name']}</td>";
	echo "<td class='mid'>{$row['c']}</td>";
	echo "<td class='mid'>{$row['s']}</td>";
	echo "<td class='mid'>$c_per_m</td>";

	echo "</tr>";
}
mysqli_close($conn);
?>
</div>
</table>
</body>