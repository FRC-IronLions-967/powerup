<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

//database query
require_once('db.php');
$sql = "SELECT * FROM pit WHERE team={$_GET['team']}";
$result = mysqli_query($conn,$sql);
$array = mysqli_fetch_assoc($result);

echo json_encode($array);
mysqli_close($conn);
?>