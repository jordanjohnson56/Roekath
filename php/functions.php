<?php

function checkLogin() {
	if(isset($_SESSION['login'])) {
		if($_SESSION['login']) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

?>