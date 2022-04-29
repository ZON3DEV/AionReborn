<html>
<head>
<style>
	body {font:14px Verdana; color:#336699; background:#f5f5f5; margin-top:100px;}
	.box {width:400px; text-align:center; background:#fff; border:solid 1px #E5E5E5; padding:10px 0 0; margin:auto; margin-bottom:20px;}
	#time, #next, #remain {margin-bottom: 10px;}
	.hms {font: 24px Trebuchet MS;}
	.red {font: 18px Trebuchet MS; color: #CC0000;}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function restimer() {
  $.getJSON("http://aion-rich.ru/public_html/timer/timer.php", function(data) {
		$('#time').html(data.time);
		$('#next').html(data.next);
		$('#remain').html(data.remain);
	});
	setTimeout(restimer, 1000);
});
</script>

</head>
<body>
<div class="box">
	<div>Текущее время <div id="time" class="hms"></div></div>
	<div>Ближайший рестарт <div id="next" class="hms"></div></div>
	<div>Осталось <div id="remain" class="hms"></div></div>
</div>
</body>
</html>