<?php
require_once('db.php');
$sql = "SELECT scout_name, COUNT(*) as c FROM matches GROUP BY scout_name ORDER BY c DESC";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
	echo $row['scout_name'] . ": " . $row['c']."\n";
}
mysqli_close($conn);
?>