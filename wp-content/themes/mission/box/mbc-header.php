<head>
  <?php wp_head(); ?>
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/header.css">
  <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/MBC/css/style.css">
  <meta charset='utf-8'> 
  <title>Mission Bowling Club</title>
</head>
<?php $pages = get_set_children_names(get_set_id('pages')); ?>
<body>
    <div id="header-reservation">
    <div id="header-reservation-contents">
    <script>
	var template_path = "<?php echo get_template_directory_uri(); ?>";
	function TSI($obj, $index, $path) { var AI = parseInt($obj.src.substr($obj.src.length-5)); if (AI == $index) { NI = AI + 3; $obj.src=template_path+"/MBC/"+$path+"/SMI-"+NI+".png"; } else { $obj.src=template_path+"/MBC/"+$path+"/SMI-"+$index+".png"; } }
    </script>
	<div id="newid"></div>
        <div id="social-media">
            <ul>
		<?php for ($i=1;$i<4;$i++) { 
		$links = array('https://twitter.com/MissionBowling','https://www.facebook.com/missionbowlingclub', '#'); 
		echo "<li><a href=".$links[$i-1]."><img src='".get_template_directory_uri()."/MBC/img/SMI-$i.png' onmouseover='TSI(this, $i,\"img\");'></a></li>"; } ?>
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
<div id="header">
    <div class="clear"></div>
    <div id="header-container">
    <div id="header-nav">
	<style> <?php echo '#header-nav a#'.$pagename.'-hn'; ?> { color: #b5121b; } </style>
        <ul>
	    	<?php foreach ($pages as $page) { $title = get_set_title(get_set_id($page)); ?>
		<a id="nav-tri-<?php echo $page; ?>" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><img src="<?php echo get_template_directory_uri(); ?>/MBC/img/lane-arrow.png"></a>
		<li><a class="header-link" id="<?php echo $page; ?>-hn" href="<?php echo bloginfo('wpurl').'/'.$page; ?>"><?php echo $title; ?></a></li>
		<?php } ?>
        </ul>
    </div>
    <div id="header-logo">
        <a href="<?php bloginfo('wpurl'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/MBC/imagene/uploads/<?php echo get_image_name('logo'); ?>"></a>
    </div>
    <div id="logistical-information" class="header-banner">
	<?php execute_set_function(get_set_id('logistical-information')); ?>
    </div>
    <?php print_breaks(3); ?>
    <div id='hours'>
	<?php execute_set_function(get_set_id('hours')); ?>
    </div>
</div>
<div class="clear"></div>
<div class="red-tape" style="display: inline-block; margin-top: -10px; margin-left: auto; margin-right: auto; width: 100%;">
<style> #left-tape { width: 53%; height: 37px; } </style>
<style> #right-tape { width: 37%; height: 37px; } </style>
<style> #club { width: 10%; height: 37px; } </style>
<img id="left-tape" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_r.png'><img id="club" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_c.png'><img id="right-tape" src='<?php echo get_template_directory_uri(); ?>/MBC/img/crop_r.png'>
</div>
</div>
</body>
</html>
</div>
