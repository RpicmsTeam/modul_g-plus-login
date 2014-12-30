<?php
	$email = $_GET['email'];
	if (!$email) {
		echo "ERROR!";
	}else{
		echo $email;
	}
?>