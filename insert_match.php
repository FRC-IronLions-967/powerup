<?php
// ini_set('display_errors', 'On');
// error_reporting(E_ALL | E_STRICT);
require_once 'db.php';

try{
	$timestamp = "NOW()";
	$team = trim(mysqli_real_escape_string($conn, $_POST['team']));
	$event_code = trim(mysqli_real_escape_string($conn, $_POST['event_code']));
	$scout_name = trim(mysqli_real_escape_string($conn, $_POST['scout_name']));
	$matchnum = trim(mysqli_real_escape_string($conn, $_POST['matchnum']));
	$practice = trim(mysqli_real_escape_string($conn, $_POST['practice']));
	$baseline = trim(mysqli_real_escape_string($conn, $_POST['baseline']));
	$cap = trim(mysqli_real_escape_string($conn, $_POST['auto_incap']));
	$auto_pos = trim(mysqli_real_escape_string($conn, $_POST['auto_pos']));
	$auto_switch = trim(mysqli_real_escape_string($conn, $_POST['auto_switch']));
	$auto_scale = trim(mysqli_real_escape_string($conn, $_POST['auto_scale']));
	$switch_made = trim(mysqli_real_escape_string($conn, $_POST['switch_made']));
	$switch_miss = trim(mysqli_real_escape_string($conn, $_POST['switch_miss']));
	$scale_made = trim(mysqli_real_escape_string($conn, $_POST['scale_made']));
	$scale_miss = trim(mysqli_real_escape_string($conn, $_POST['scale_miss']));
	$oppscale_made = trim(mysqli_real_escape_string($conn, $_POST['oppscale_made']));
	$oppscale_miss = trim(mysqli_real_escape_string($conn, $_POST['oppscale_miss']));
	$vault_made = trim(mysqli_real_escape_string($conn, $_POST['vault_made']));
	$vault_miss = trim(mysqli_real_escape_string($conn, $_POST['vault_miss']));
	$climb = trim(mysqli_real_escape_string($conn, $_POST['climb']));
	$foul = trim(mysqli_real_escape_string($conn, $_POST['foul']));
	$techfoul = trim(mysqli_real_escape_string($conn, $_POST['techfoul']));
	$card = trim(mysqli_real_escape_string($conn, $_POST['card']));
	$defense = trim(mysqli_real_escape_string($conn, $_POST['defense']));
	$tele_incap = trim(mysqli_real_escape_string($conn, $_POST['tele_incap']));
	$comments = trim(mysqli_real_escape_string($conn, $_POST['comments']));
	
	$fields = "timestamp,team,event_code,scout_name,matchnum,practice,baseline,auto_pos,auto_switch,auto_scale,switch_made,switch_miss,scale_made,scale_miss,oppscale_made,oppscale_miss,vault_made,vault_miss,climb,foul,techfoul,card,defense,tele_incap,comments";
	$values = "'$timestamp','$team','$event_code','$scout_name','$matchnum','$practice','$baseline','$auto_pos','$auto_switch','$auto_scale','$switch_made','$switch_miss','$scale_made','$scale_miss','$oppscale_made','$oppscale_miss','$vault_made','$vault_miss','$climb','$foul','$techfoul','$card','$defense','$tele_incap','$comments'";
}
catch (Exception $e) {
	//Stop the page before deleting old records if the POST data isn't found
	die($fields."\n".$values."\nException:\n" . $e->getMessage());
}

//delete old versions of this team/matchnum combination
$sql="DELETE FROM matches WHERE matchnum='{$_POST['matchnum']}' AND team='{$_POST['team']}'";
mysqli_query($conn, $sql);

$sql="INSERT INTO matches ($fields) VALUES ($values)";

if(mysqli_query($conn, $sql)){
	echo "Match $matchnum, Team $team saved successfully.";
} 
else {
	echo mysqli_error($conn)."\n".$sql;
}

mysqli_close($conn);

?>