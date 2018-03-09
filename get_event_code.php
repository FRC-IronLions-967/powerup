<?php
$raw_data =substr(file_get_contents("eventData.js"),16);
$event_data = json_decode($raw_data, true);
echo = $event_data['event_code'];
//echo "mokc2";
?>