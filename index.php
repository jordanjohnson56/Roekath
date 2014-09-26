<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Roekath!</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/control.js"></script>
</head>
<body lang="en">

	<?php
	//Turn off those annoying notices
	error_reporting(E_ALL & ~E_NOTICE);
	//Load custom functions
	require('php/functions.php');
	//Open up session
	session_start();
	//Check if user is logged in
	if(checkLogin()) {
		loadGame();
	} else {
		loadHome();
	}
	//Get database connection
	$db = dbConnect();

	function loadGame() {
		echo 'GAME';
		$query = mysqli_query($db,"SELECT * FROM user WHERE user='test'");
		while($i=mysqli_fetch_array($query)){$timer=$i['timer'];}
		$timer = strtotime($timer);
		$timer = date_add($timer,strtotime('20:00'));
		//TODO: Check current time, figure out if it is greater than $timer, do stuff
		?>
		<form action="php/logout.php" method="POST">
			<button type="submit">Logout</button>
		</form>
		<!-- <form action="php/timer.php" method="POST"> -->
			<button type="submit" class="reset">Reset Timer</button>
			<!-- <button type="submit" class="minus">Minus Timer</button> -->
		<!-- </form> -->
		<div class="timer"><?php echo '20:00' ?></div>
		<?php
	}

	function loadHome() {
		echo 'HOME';
		?>
		<form action="php/login.php" method="POST">
			<button type="submit">Login</button>
		</form>
		<?php
	}

	?>
</body>
</html>