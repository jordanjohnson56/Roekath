<?php

if($_POST['action']=='use') {
	include('db_connect.php');
	$query = mysqli_query($db,"SELECT * FROM user WHERE id='".$_POST['account']."'");
	while($i=mysqli_fetch_array($query)) {
		$currentEnergy = $i['current_energy'];
	}
	if(($currentEnergy-$_POST['amount'])>=0) {
		$currentEnergy -= $_POST['amount'];
	}
	$query = mysqli_query($db,"UPDATE user SET current_energy='".$currentEnergy."' WHERE id='".$_POST['account']."'");
	$dbFormat = date('Y-M-D H:i:s',time());
	$query = mysqli_query($db,"UPDATE user SET energy_update='".$dbFormat."' WHERE id='".$id."'");
	if($query){echo 'ok';}
}

?>