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

	//Load the game
	function loadGame() {
		echo 'GAME';
		//Connect to database
		include('php/db_connect.php');
		$query = mysqli_query($db,"SELECT * FROM user WHERE user='admin'");
		while($i=mysqli_fetch_array($query)) {
			$timestamp = $i['energy_update'];
			$maxEnergy = $i['max_energy'];
			$currentEnergy = $i['current_energy'];
			$id = $i['id'];
		}

		include('php/timezone.php');
		$currentTime = time();
		$timestamp = strtotime($timestamp);
		$timeDiff = $currentTime - $timestamp;
		$missingEnergy = $maxEnergy - $currentEnergy;
		$energyIntervals = $missingEnergy * 1200;
		$a = false;
		if($timeDiff >= $energyIntervals){$a=true;}
		if($a) {
			$currentEnergy=$maxEnergy;
			$query = mysqli_query($db,"UPDATE user SET current_energy='".$currentEnergy."' WHERE id='".$id."'");
			$query = mysqli_query($db,"UPDATE user SET energy_update=null WHERE id='".$id."'");
		} else {
			$currentEnergy = $currentEnergy + floor($timeDiff/1200);
			$timeLeft = $energyIntervals - $timeDiff;
			$timer[0] = floor($timeLeft/60);
			$timer[1] = $timeLeft - ($timer[0]*60);
			while($timer[0]>20) {
				$timer[0] -= 20;
			}
			$timer[1] = substr('0'.$timer[1],-2);
		}

		echo '<br><br>';
		echo $timestamp.'<br>';
		echo $currentTime.'<br>';
		echo $timeDiff.'<br>';
		echo $maxEnergy.'<br>';
		echo $currentEnergy.'<br>';
		echo $missingEnergy.'<br>';
		echo $energyIntervals.'<br>';
		echo $a.'<br>';

		?>
		<div class="info" account="<?php echo $id ?>"></div>
		<form action="php/logout.php" method="POST">
			<button type="submit">Logout</button>
		</form>
		<br>
		<button class="reset">Reset Timer</button><br>
		<button class="eminus">Minus Energy</button><br>
		<button class="ereset">Reset Energy</button><br>
		<!-- </form> -->
		<div class="timer"><?php echo $timer[0].':'.$timer[1] ?></div>
		<div class="energy"><?php echo $currentEnergy.'/'.$maxEnergy ?></div>
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