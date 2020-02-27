<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<input type="button" value="play" id="play">
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	$(function(){
		$('#play').click(function(){
			var snd='<audio autoplay=true><source src="ping.mp3"></audio>';
			$('body').append(snd);
		});
	})
</script>
</html>