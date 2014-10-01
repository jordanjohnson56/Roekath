<?php

include('db_connect.php');
$query = mysqli_query($db,"SELECT * FROM user WHERE id='".$_POST['account']."'");
while($i=mysqli_fetch_array($query)) {
	$currentEnergy = $i['current_energy'];
	$id = $i['id'];
}
$currentEnergy++;
$query = mysqli_query($db,"UPDATE user SET current_energy='".$currentEnergy."' WHERE id='".$id."'");

?>