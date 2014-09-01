<!DOCTYPE html>
<html>
	<head>
		<title>Roekath</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript" src="js/respond.min.js"></script>
	</head>
	<body>
		<?php

		if($_SESSION['login']==true) {
			loadGame();
		}
		else {
			loadHome();
		}

		function loadHome() {
			require('php/header.php');
			require('php/home.php');
			require('php/footer.php');
		}

		?>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>