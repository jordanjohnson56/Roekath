<?php

if($_POST['action']=='use') {
	include('db_connect.php');
	$query = mysqli_query($db,"SELECT * FROM user WHERE id='".$_POST['account']."'");
	while($i=mysqli_fetch_array($query)) {
		$currentEnergy = $i['current_energy'];
	}
	echo $currentEnergy.' ';
	echo $_POST['amount'].' ';
	echo $currentEnergy - $_POST['amount'].' ';
	if(($currentEnergy-$_POST['amount'])>=0) {
		$currentEnergy -= $_POST['amount'];
	}
	$query = mysqli_query($db,"UPDATE user SET current_energy='".$currentEnergy."' WHERE id='".$_POST['account']."'");
	include('timezone.php');
	$timer = ($_POST['timer'][0]*60)+$_POST['timer'][1];
	$timer = 1200 - $timer;
	$timestamp = strtotime($timer.' seconds ago');
	echo $timer.' seconds ago ';
	$dbFormat = date('Y-m-d H:i:s',$timestamp);
	echo $dbFormat.' ';
	$query = mysqli_query($db,"UPDATE user SET energy_update='".$dbFormat."' WHERE id='".$_POST['account']."'");
	if($query){/*echo 'ok';*/}
}

?>