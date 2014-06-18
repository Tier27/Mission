    <div id="header-reservation">
    <div id="header-reservation-contents">
    <script>
	function TSI($obj, $index, $path) { return; var AI = parseInt($obj.src.substr($obj.src.length-5)); if (AI == $index) { NI = AI + 3; $obj.src=$path+"/SMI-"+NI+".png"; } else { $obj.src=$path+"/SMI-"+$index+".png"; } }
    </script>
	<div id="newid"></div>
        <div id="social-media">
            <ul>
		<?php for ($i=1;$i<4;$i++) { 
		$links = array('https://twitter.com/MissionBowling','https://www.facebook.com/missionbowlingclub', '#'); 
		echo "<li><a href=".$links[$i-1]."><img src='".get_template_directory_uri()."/img/SMI-$i.png' onmouseover='TSI(this, $i,\"img\");'></a></li>"; } ?>
            </ul>
        </div>
        <div id="header-reservation-lane">
            <p>Reserve a Lane</p>        
            <div class="select-box-alpha">
                <select>
                    <option>Sat 09/07 (36 openings)</option>
                    <option>Sun 09/08 (36 openings)</option>
                    <option>Mon 09/08 (36 openings)</option>
                    <option>Tue 09/10 (36 openings)</option>
                    <option>Wed 09/11 (36 openings)</option>
                    <option>Thu 09/12 (36 openings)</option>
                    <option>Fri 09/13 (36 openings)</option>
                    <option>Sat 09/14 (36 openings)</option>
                 </select>
            </div>
            <p>Lanes</p> 
            <div class="select-box-alpha-lanes">
                <select>
                    <option>1</option>
                    <option>2</option>
                 </select>
            </div>
            <input id="gobutton" type="submit" value="Go">
        </div>
         <div id="header-reservation-table">
            <p>Reserve a Table</p>

        <div class="select-box-beta">
            <select>
                <option>Sat Sep 7</option>
                <option>Sun Sep 8</option>
                <option>Mon Sep 9</option>
                <option>Tue Sep 10</option>
                <option>Wed Sep 11</option>
                <option>Thu Sep 12</option>
                <option>Fri Sep 13</option>
                <option>Sat Sep 14</option> 
            </select>
        </div>
	<div class="select-box-beta">
            <select>
                <option>6:00 pm</option>
                <option>6:15 pm</option>
                <option>6:45 pm</option>
                <option>7:00 pm</option>
                <option>7:15 pm</option>
                <option>7:45 pm</option>
            </select>
        </div>
        <input id="gobutton" type="submit" value="Go";>
        </div>
    </div>
    </div>
    <div class="clear"></div>
