<!DOCTYPE HTML>
<html>
<head>
    <link rel='stylesheet' href="w3.css">
    <link rel='stylesheet' href="w3-theme-red.css">
    <link rel='stylesheet' href="style.css">
    <meta name=viewport content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="teamData.js"></script>
    <!-- <script src="report.js"></script> -->
    <style type="text/css">

        td, th{
            text-align:center;
            padding-left:3px;
            padding-right:3px;
    }

    </style>
</head>
<body class="w3-theme-d3">
<ul class="w3-navbar w3-theme-l3 w3-round-xxlarge w3-border-black">
    <li><a href="index.html">Match Scouting</a></li>
    <li><a href="pitscouting.html">Pit Scouting</a></li>
    <li><a href="schedule.php">Schedule</a></li>
</ul>
<div id="linknum" style="display:none;"><?php echo $_GET['team']; ?></div>
<div class="w3-panel w3-theme-l3 w3-padding-large w3-round-xxlarge w3-border w3-border-black w3-text-white">
    <p class="status">Status info will be displayed here.</p>
    <label for="team">Team Number</label><br>
    <select id="team" value = "167" name="team">
        <option value="167">167</option>
        <option value="525">525</option>
        <option value="967">967</option>
    </select><br>

    <p><img src="pics/nopic.jpg" alt="No picture" id="robot_picture" style='max-width: 300px'></p>

    <p>
    <!--
    <strong>General:</strong>
    <span id="height"></span>
    <span id="weight"></span>
    <br>
    -->
    <strong>Drive: </strong>
    <span id="drivetype"></span>
    <span id="transmission"></span>
    <span id="orient"></span>
    <span id="driveMotors"></span>
    <span id="speed"></span>
    <span id="motors_type"></span>
    <br>
    <strong>Floor Pickup: </strong><span id="floor_pickup">?</span><br>
    <strong>Climber: </strong><span id="climb_solo">?</span><br>
    <strong>Cubes to Exchange</strong><span id="portal_deliver">?</span><br>
    <strong>Place on Scale: </strong><span id="place_scale">?</span><br>
    </p>
  
    <p>
    <strong>Matches Played: </strong><span id="numberOfMatches">?</span><br>
    <strong>Auto Switch:</strong> <span id="auto_switch_pct"></span><br>
    <strong>Auto Scale:</strong> <span id="auto_scale_pct"></span><br>
    <strong>Min/Avg/Max Blocks:</strong> 
    <span id="min_blocks">?</span> / <span id="avg_blocks">?</span> / <span id="max_blocks">?</span><br>
    <strong>Climbs:</strong> <span id="climb_pct"></span><br>
    </p>

    <div id="mtable">Match Info Table</div>
    <div id="mcomments">Match Comments Table</div>

    </div>
<script>

function lookupMatchData(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 & this.status == 200){
            matches = JSON.parse(xhr.responseText);
            document.getElementById('numberOfMatches').innerHTML = matches.length;

            var auto_switch_made = 0;
            var auto_switch_tries = 0;
            var auto_scale_tries = 0;
            var auto_scale_made = 0;
            var climbs = 0;
            var climb_fail = 0;
            var blocks = [];
            var total_blocks = 0;
            var all_matches_blocks = 0;

            //Loop 1st time for overall stats
            for (i=0; i < matches.length; i++){
                if (matches[i]['auto_switch']) {auto_switch_tries += 1;}
                if (matches[i]['auto_switch'] > 0){auto_switch_made += 1;}
                if (matches[i]['auto_scale']) {auto_scale_tries += 1;}
                if (matches[i]['auto_scale'] > 0){auto_scale_made += 1;}
                if (matches[i]['climb'].includes('x')){climb_fail += 1};
                if (matches[i]['climb'].includes('1')){climbs += 1};
                total_blocks = parseInt(matches[i]['switch_made']) + parseInt(matches[i]['scale_made']) + parseInt(matches[i]['oppscale_made']) + parseInt(matches[i]['vault_made']);
                all_matches_blocks += total_blocks;
                blocks.push(total_blocks);

            }
            var bmin = Math.min.apply(null,blocks);
            var bmax = Math.max.apply(null,blocks);
            var bavg = Math.round(10*all_matches_blocks/matches.length)/10;
            document.getElementById('min_blocks').innerHTML = bmin;
            document.getElementById('avg_blocks').innerHTML = bavg;
            document.getElementById('max_blocks').innerHTML = bmax;
            document.getElementById('auto_switch_pct').innerHTML = auto_switch_made+" of "+auto_switch_tries;
            document.getElementById('auto_scale_pct').innerHTML = auto_scale_made+" of "+auto_scale_tries;
            document.getElementById('climb_pct').innerHTML = climbs +" of "+ (climbs + climb_fail);

            //Loop 2nd time for each match stats
            var t = "";
            var SW = "";
            var SC = "";
            var OP = "";
            var EX = "";
            var Clim = "";
            var Foul = 0;
            t += "<table>";
            t += '<tr><td></td><td colspan="4" style="text-align: left;">Autonomous</td><td colspan="6" style="text-align: left;">Teleoperated</td></tr>';
            t += "<tr><th>M#</th><th>P</th><th>B</th><th>SW</th><th>SC</th><th>SW</th><th>SC</th><th>OP</th><th>EX</th><th>CL</th><th>FO</th></tr>";
            for(i = 0; i < matches.length; i++){
                t += "<tr>";
                t += "<td>"+matches[i]['matchnum']+"</td>";
                t += "<td>"+matches[i]['auto_pos']+"</td>";
                t += "<td>"+matches[i]['baseline']+"</td>";
                t += "<td>"+matches[i]['auto_switch']+"</td>";
                t += "<td>"+matches[i]['auto_scale']+"</td>";
                SW = matches[i]['switch_made']+"/"+(parseInt(matches[i]['switch_made']) + parseInt(matches[i]['switch_miss']));
                SC = matches[i]['scale_made']+"/"+(parseInt(matches[i]['scale_made']) + parseInt(matches[i]['scale_miss']));
                OP = matches[i]['oppscale_made']+"/"+(parseInt(matches[i]['oppscale_made']) + parseInt(matches[i]['oppscale_miss']));
                EX = matches[i]['vault_made']+"/"+(parseInt(matches[i]['vault_made']) + parseInt(matches[i]['vault_miss']));
                SW = (SW == "0/0") ? "-" : SW;
                SC = (SC == "0/0") ? "-" : SC;
                OP = (OP == "0/0") ? "-" : OP;
                EX = (EX == "0/0") ? "-" : EX;
                t += "<td>"+SW+"</td>";
                t += "<td>"+SC+"</td>";
                t += "<td>"+OP+"</td>";
                t += "<td>"+EX+"</td>";
                t += "<td>"+matches[i]['climb']+"</td>";
                Foul = parseInt(matches[i]['foul'])*5 + parseInt(matches[i]['techfoul'])*25;
                Foul = (Foul == 0) ? "-" : Foul;
                t += "<td>"+Foul+"</td>";
                
                t += "</tr>";
            }
            t += "</table>";
            document.getElementById('mtable').innerHTML = t;

            //3rd loop for comments and other categories
            var ct = "";
            ct += "<table><tr><th>M#</th><th>Comments</th></tr>\n";
            for (i=0;i<parseInt(matches.length);i++){
                other = "";
                if(matches[i]["comments"].length>0){
                    other = "";
                    if (matches[i]['tele_incap'] == 1){other += "Incapacitated. ";}
                    if (matches[i]['defense'] == 1){other += "Played Defense. ";}
                    if (matches[i]['card'] == 1){other += "Yellow/Red Card. ";}
                    ct+= "<td>"+matches[i]["matchnum"]+"</td>";
                    ct+= "<td style='text-align:left;'>"+other.trim()+matches[i]["comments"]+" -"+matches[i]["scout_name"]+"</td>";
                    ct+= "</tr>";
                }
            }
            ct+="</table>";
            document.getElementById('mcomments').innerHTML = ct;
        }
    }
    xhr.open('GET', 'get_team_matches.php?team=' + document.getElementById('team').value);
    xhr.send();

}

function lookupTeamData(){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 & this.status == 200){
            if (xhr.responseText != 'null'){
                status("Data found for team " + document.getElementById('team').value);
                var data = JSON.parse(xhr.responseText);
                document.getElementById('drivetype').innerHTML = data['drivetype'];
                document.getElementById('transmission').innerHTML = data['transmission'];
                document.getElementById('orient').innerHTML = data['orient'];
                document.getElementById('driveMotors').innerHTML = data['driveMotors'];
                document.getElementById('motors_type').innerHTML = data['motors_type'];
                document.getElementById('floor_pickup').innerHTML = data['floor_pickup'];
                document.getElementById('climb_solo').innerHTML = data['climb_solo'];
                document.getElementById('portal_deliver').innerHTML = data['portal_deliver'];
                document.getElementById('place_scale').innerHTML = data['place_scale'];
            }
            else {
                status("No data found.");
            }
        }
        else {
            status("Looking for team " + document.getElementById('team').value + " data...");
        }
    };

    xhr.open('GET', 'pit_team_get.php?team=' + document.getElementById('team').value);
    xhr.send();
}

function lookupPicture(){
    //use the PHP get file
}

function updateTeams(arr){
    var teamList = [];
    for (i = 0; i < teamData.length; i++){
        teamList.push({num: parseInt(teamData[i]["team_number"]), nick: teamData[i]["nickname"]});
    }

    teamList.sort(function comp(a, b){return parseInt(a['num'])-parseInt(b['num'])});

    var choices = '';
    for(i = 0; i < teamList.length; i++){
        var num = teamList[i]['num'];
        var nick = teamList[i]['nick']
        choices += '<option value="'+num+'">'+num+' - '+nick.substring(0,22)+'</option>\n';
    }
    document.getElementById('team').innerHTML = choices;
}

function status(m){
    document.getElementsByClassName('status')[0].innerHTML = m;
    // document.getElementsByClassName('status')[1].innerHTML = m;
}

document.addEventListener("DOMContentLoaded", function() {
    //Document ready function
    updateTeams(teamData);
    // $("#team").val($('#linknum').html());
    if (parseInt(document.getElementById('linknum').innerHTML) > 0){    
        document.getElementById('team').value = parseInt(document.getElementById('linknum').innerHTML); 
    }
    else {
        //no GET value specified
    }

    document.getElementById('team').addEventListener("change", function(){
        lookupTeamData();
        lookupMatchData();
        document.getElementById('robot_picture').src = "pics/"+document.getElementById('team').value+".jpg";
    });

    if (parseInt(document.getElementById('linknum').innerHTML) > 0){    
        lookupTeamData();
        lookupMatchData();
    }

}); //end document ready function

</script>
</body>
</html>