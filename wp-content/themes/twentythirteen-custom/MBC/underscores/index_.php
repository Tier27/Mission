<!DOCTYPE HTML>
<html>
<head>
<script src="js/jquery.min.js"></script>
<script>
imgCounter=0;
function cycle() { if (imgCounter==3) { imgCounter=0; } 
imgCounter++;
image = document.getElementById('picture');
image.src='img/SMI-' + imgCounter + '.png'; 
image.style.visibility = 'visible';
setTimeout("cycle();", 1000); }
</script>
</head>
<body onload="cycle('picture');">
<img id="picture" src="" onload="fadeIn(this);" style="display:block"> 
</body>
</html>
