<?php

if($_POST['action']=='use') {
	$db = mysqli_connect('localhost','root','pizza','roekath');
	$query = mysqli_query($db,"SELECT * FROM user WHERE id='".$_POST['account']."'");
	while($i=mysqli_fetch_array($query)) {
		$currentEnergy = $i['current_energy'];
	}
	if(($currentEnergy-$_POST['amount'])>=0) {
		$currentEnergy -= $_POST['amount'];
	}
	$query = mysqli_query($db,"UPDATE user SET current_energy='".$currentEnergy."' WHERE id='".$_POST['account']."'");
	if($query){echo 'ok';}
}

?>