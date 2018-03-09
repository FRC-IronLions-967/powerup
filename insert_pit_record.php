<?php
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
require_once 'db.php';
$timestamp = "NOW()";
$team = trim(mysqli_real_escape_string($conn, $_POST['team']));
$event_code = trim(mysqli_real_escape_string($conn, $_POST['event_code']));
$scout_name = trim(mysqli_real_escape_string($conn, $_POST['scout_name']));
$orient = trim(mysqli_real_escape_string($conn, $_POST['orient']));
$drivetype = trim(mysqli_real_escape_string($conn, $_POST['drivetype']));
$transmission = trim(mysqli_real_escape_string($conn, $_POST['transmission']));
$driveMotors = trim(mysqli_real_escape_string($conn, $_POST['driveMotors']));
$weight = trim(mysqli_real_escape_string($conn, $_POST['weight']));
$motors_type = trim(mysqli_real_escape_string($conn, $_POST['motors_type']));
$floor_pickup = trim(mysqli_real_escape_string($conn, $_POST['floor_pickup']));
$portal_receive = trim(mysqli_real_escape_string($conn, $_POST['portal_receive']));
$portal_deliver = trim(mysqli_real_escape_string($conn, $_POST['portal_deliver']));
$place_switch = trim(mysqli_real_escape_string($conn, $_POST['place_switch']));
$place_scale = trim(mysqli_real_escape_string($conn, $_POST['place_scale']));
$climb_solo = trim(mysqli_real_escape_string($conn, $_POST['climb_solo']));
$climb_partner = trim(mysqli_real_escape_string($conn, $_POST['climb_partner']));
$climb_assist = trim(mysqli_real_escape_string($conn, $_POST['climb_assist']));
$auto_baseline = trim(mysqli_real_escape_string($conn, $_POST['auto_baseline']));
$auto_switch = trim(mysqli_real_escape_string($conn, $_POST['auto_switch']));
$auto_scale = trim(mysqli_real_escape_string($conn, $_POST['auto_scale']));
$multi_auto = trim(mysqli_real_escape_string($conn, $_POST['multi_auto']));
$start_center = trim(mysqli_real_escape_string($conn, $_POST['start_center']));
$start_left = trim(mysqli_real_escape_string($conn, $_POST['start_left']));
$start_right = trim(mysqli_real_escape_string($conn, $_POST['start_right']));
$build_appearance = trim(mysqli_real_escape_string($conn, $_POST['build_appearance']));
$wiring_appearance = trim(mysqli_real_escape_string($conn, $_POST['wiring_appearance']));
$pit_comments = trim(mysqli_real_escape_string($conn, $_POST['pit_comments']));
$language = trim(mysqli_real_escape_string($conn, $_POST['language']));
$open_source = trim(mysqli_real_escape_string($conn, $_POST['open_source']));

$fields = "timestamp, team,event_code,scout_name,orient,drivetype,transmission,driveMotors,weight,motors_type,floor_pickup,portal_receive,portal_deliver,place_switch,place_scale,climb_solo,climb_partner,climb_assist,auto_baseline,auto_switch,auto_scale,multi_auto,start_center,start_left,start_right,build_appearance,wiring_appearance,pit_comments,language,open_source";
$values = "$timestamp, '$team','$event_code','$scout_name','$orient','$drivetype','$transmission','$driveMotors','$weight','$motors_type','$floor_pickup','$portal_receive','$portal_deliver','$place_switch','$place_scale','$climb_solo','$climb_partner','$climb_assist','$auto_baseline','$auto_switch','$auto_scale','$multi_auto','$start_center','$start_left','$start_right','$build_appearance','$wiring_appearance','$pit_comments','$language','$open_source'";

$sql="REPLACE INTO pit ($fields) VALUES ($values)";

if(mysqli_query($conn, $sql)){
	echo "Pit Scouting record saved successfully.";
} 
else {
	echo "<br>Error:<br>".$sql."<br>".mysqli_error($conn);
}

mysqli_close($conn);

?>