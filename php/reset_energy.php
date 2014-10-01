<?php

include('db_connect.php');
$query = mysqli_query($db,"SELECT * FROM user WHERE id='".$_POST['account']."'");
while($i=mysqli_fetch_array($query)){
	$maxEnergy = $i['max_energy'];
	$id = $i['id'];
}
$query = mysqli_query($db,"UPDATE user SET current_energy='".$maxEnergy."' WHERE id='".$id."'");
$query = mysqli_query($db,"UPDATE user SET energy_update=null WHERE id='".$id."'");

?>