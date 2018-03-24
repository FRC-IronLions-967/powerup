<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

//load field names

$field_list_display = file('pit_field_list.txt', FILE_IGNORE_NEW_LINES);

//database query
require_once('db.php');
$sql = "SELECT team, orient, drivetype, driveMotors, motors_type, transmission, weight, floor_pickup, portal_receive, portal_deliver, place_switch, place_scale, climb_solo, climb_partner, climb_assist, auto_baseline, auto_switch, auto_scale, multi_auto, start_center, start_left, start_right, build_appearance, wiring_appearance, pit_comments, language, open_source FROM pit ORDER BY team";
//$sql = "SELECT $fields, timestamp FROM pit GROUP BY team ORDER BY team, MIN(timestamp)";

$result = mysqli_query($conn,$sql);
$filename = 'pitscouting.csv';
$f = fopen('php://memory', 'w'); 

//header rows
//change first header row, because starting a CSV with "ID" makes excel throw a filetype error (??)
//No more id field, so this is all unnecessary. Keeping here for future reference.
// $field_list_display[0] = "pit_ID";
fputcsv($f, $field_list_display);
//data rows
while ($row=mysqli_fetch_assoc($result)){
	fputcsv($f,$row);
}
fseek($f, 0);
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.$filename.'";');
fpassthru($f);

mysqli_close($conn);
?>